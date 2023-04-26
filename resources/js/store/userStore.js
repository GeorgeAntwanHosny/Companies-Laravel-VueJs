// store.js
import Vuex from 'vuex';
import axios from "axios";

const userStore = new Vuex.Store({

    state: {
        userData: JSON.parse(localStorage.getItem('userData'))?? null,
        loading: false,
        error: null
    },
    mutations: {
        setUserData(state, payload) {
            state.userData = payload;
        },
        setLoading(state, payload) {
            state.loading = payload;
        },
        setError(state, payload) {
            state.error = payload;
        }
    },
    getters:{
        getUserData: (state)=>{
            return state.userData?? null;
        },
        isAuthenticated:(state)=> {
            return state.userData !== null;
        },
    },
    actions: {
        AuthUser({commit, state}, payload) {
            const {formData, router, authType,redirectPath} = payload;
            commit('setLoading', true);
            axios.post(`/api/auth/${authType}`, formData)
                .then(response => {
                    commit('setUserData', response.data.data.user);
                    localStorage.setItem('userData', JSON.stringify(state.userData));
                    commit('setLoading', false);
                    router.push(redirectPath??{name: 'companies.index'})
                })
                .catch(error => {
                    if (error.response?.status === 422) {
                        commit('setError', error.response.data.errors);
                    } else {
                        commit('setError', error.message);
                    }
                    commit('setLoading', false);
                });
        },
        logout({commit, state, getters}, payload) {
            const {router} = payload;
            try {
                commit('setLoading', true);
                const userData = getters.getUserData;
                axios.get('/api/auth/logout', {
                    headers: {
                        'Authorization': `Bearer ${userData.access_token}`
                    }
                })
                    .then(response => {
                        localStorage.removeItem('userData')
                        commit('setUserData', null);
                    });

                commit('setLoading', false);
                router.push({name: 'companies.index'})
            } catch (error) {
                if (error.response?.status === 401) {
                    commit('setError', error.response.data.errors);
                } else {
                    commit('setError', error.message);
                }
                commit('setLoading', false);
            }
        }
    }
});
export default userStore;
