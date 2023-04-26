import {reactive, ref} from 'vue'
import axios from "axios";
import { useRouter } from 'vue-router';

export default function useUsers(){
    let userData = ref({});
    const users =ref({});
    const router = useRouter();
    const errors = ref({});

    const loginUser =async (data) => {
        errors.value = '';

        try {
            console.log(data);
            let response = await axios.post('/api/auth/login', data);
            setUser(response.data.data.user);
            console.log(getUser());
            await router.push({name: 'companies.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    };
    const setUser = (data)=>{
        userData.value =data;
    }
    const getUser =()=>{

        return userData.value;
    }
    const registerUser =async (data) => {
        errors.value = '';
        try {
            console.log(data);
            let response = await axios.post('/api/auth/register', data);
            userData.value = response.data;

            await router.push({name: 'companies.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }
    const getUserData =()=>{
         return userData.value;
    }
    const getUsers = async () => {
        let response = await axios.get('/api/users');
        users.value = response.data.users;
    }
    return {

        errors,
        getUser,
        getUserData,
        loginUser,
        registerUser,
        getUsers,
        users

    }
};
