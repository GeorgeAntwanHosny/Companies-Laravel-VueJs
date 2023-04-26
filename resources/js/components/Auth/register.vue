<template>
    <div class="flex items-center justify-center pt-4">
       <div
           class=" flex-1 block max-w-l max-w-sm rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">

       <form>

                <!--name input-->
                <div class="relative mb-6" data-te-input-wrapper-init>
                    <input
                        v-model="formData.name"
                        type="text"
                        class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                        id="exampleInput123"
                        aria-describedby="emailHelp123"
                        placeholder="First name" />
                    <label
                        for="emailHelp123"
                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary"
                    >name
                    </label>
                </div>


            <div class="text-sm text-red-500 pb-6" v-if="errors?.name">
                <p>  {{errors?.name[0]}}</p>
            </div>
            <!--Email input-->
            <div class="relative mb-6" data-te-input-wrapper-init>
                <input
                    v-model="formData.email"
                    type="email"
                    class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                    id="exampleInput125"
                    placeholder="Email address" />
                <label
                    for="exampleInput125"
                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200"
                >Email address
                </label>
            </div>
            <div class="text-sm text-red-500 pb-6" v-if="errors?.email">
                <p>  {{errors?.email[0]}}</p>
            </div>
            <!--Password input-->
            <div class="relative mb-6" data-te-input-wrapper-init>
                <input
                    v-model="formData.password"
                    type="password"
                    class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200   [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                    id="exampleInput126"
                    placeholder="Password" />
                <label
                    for="exampleInput126"
                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200"
                >Password
                </label>
            </div>
            <div class="text-sm text-red-500 pb-4" v-if="errors?.password">
                <p>  {{errors?.password[0]}}</p>
            </div>



            <!--Submit button-->
            <button
                @click.prevent="register"
                :disabled="loading"
                type="submit"
                class="inline-block w-full rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]"
                data-te-ripple-init
                data-te-ripple-color="light">
                <pulse-loader :loading="loading" :color="color" :size="size"></pulse-loader>
                {{loading?'':'Sign up'}}

            </button>
            <!--Login link-->
            <p class="mt-6 text-center text-neutral-800 dark:text-neutral-200">
                you are a member?
                <router-link
                    :to="{name:'auth.login'}"
                    class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
                >Login</router-link
                >
            </p>
        </form>
    </div>
    </div>
</template>

<script setup>
import userStore from '../../store/userStore';
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
import {onMounted, reactive,computed} from "vue";
// Initialization for ES Users
import {
    Ripple,
    Input,
    initTE,
} from "tw-elements";
const color='white';
const size='10px';
const formData =reactive({});
const userState = userStore;
const loading = computed(() => userState.state.loading)
const errors = computed(() => userState.state.error);
import {useRouter} from 'vue-router';

const router = useRouter();
const authType = 'register';
const register = () => userState.dispatch('AuthUser', {formData, router,authType});

onMounted(() => {
    initTE({  Ripple, Input });
});

</script>

<style scoped>

</style>
