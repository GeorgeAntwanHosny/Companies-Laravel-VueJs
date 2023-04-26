import { createRouter, createWebHistory } from 'vue-router';

import CompaniesIndex from '../components/companies/index.vue';
import CompaniesEdit from '../components/companies/edit.vue';
import CompaniesCreate from '../components/companies/create.vue';
import Login from '../components/Auth/login.vue';
import Register from '../components/Auth/register.vue';
import userStore from '../store/userStore';
import UsersIndex from '../components/users/index.vue';
const routes = [
    {
        path: '/dashboard',
        name: 'companies.index',
        component: CompaniesIndex
    },
    {
        path: '/companies/:id/edit',
        name: 'companies.edit',
        component: CompaniesEdit,
        props:true,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/companies/create',
        name:"companies.create",
        component: CompaniesCreate,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/login',
        name: 'auth.login',
        component: Login,
        meta: {
            requiresGuest: true
        }
    },
    {
        path: '/register',
        name: 'auth.register',
        component: Register,
        meta: {
            requiresGuest: true
        }
    },
    {
        path: '/users',
        name: 'users.index',
        component: UsersIndex,

    },
    {
        path: "/404",
        name: "notExists",
        component: () =>
            import(/* webpackChunkName: "NotFound" */ "../Shared/NotFound.vue"),
    },
    {
        path: "/:catchAll(.*)",
        name: "notFound",
        component: () =>
            import(/* webpackChunkName: "NotFound" */ "../Shared/NotFound.vue"),
    },
];
const router =createRouter({
    history: createWebHistory(),
    routes
});
router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (!userStore.getters.isAuthenticated) {
            next({
                name: 'auth.login',
                query: { redirect: to.fullPath },
            });
        } else {
            next();
        }
    }else if(to.matched.some((record) => record.meta.requiresGuest)){
        if (userStore.getters.isAuthenticated) {
            next({name: 'companies.index'});
        } else {
            next();
        }
    } else {
        next();
    }
});
export default router;

