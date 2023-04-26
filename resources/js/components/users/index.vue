<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                        <tr>
                            <th scope="col" class="px-6 py-4">#</th>
                            <th scope="col" class="px-6 py-4">Name</th>
                            <th scope="col" class="px-6 py-4">Email</th>
                            <th scope="col" class="px-6 py-4">Created at</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="user in users"
                            :key="user.id"
                            class="border-b transition duration-300 ease-in-out hover:bg-blue-400/10 dark:border-neutral-500 dark:hover:bg-blue-400/10">
                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{user.id}}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ user.name }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{user.email}}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{formatDate(new Date(user.created_at))}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import useUsers from '../../composables/user';
export default {
    name: "index",
    setup(){
        const {getUsers, users} =useUsers();
         getUsers();
        function formatDate(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }
       return {
           users,
           getUsers,
           formatDate
       }
    }
}
</script>

<style scoped>

</style>
