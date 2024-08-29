<template>
<!--    <h1>hello</h1>/-->
    <div>


    <router-link
        to="/users"
        class="text-blue-500 hover:text-green-500 font-semibold  hover:no-underline transition duration-300"
    >
        Link to the users page
    </router-link>
    <router-link to="/count"
                 class="text-blue-500 hover:text-green-500 font-semibold
                 hover:no-underline transition duration-300 m-20">
        Link to the count page
    </router-link>
    <router-link to="/image"
                 class="text-blue-500 hover:text-green-500 font-semibold
                 hover:no-underline transition duration-300">
        Link to the image store page
    </router-link>
    <hr>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 p-4 md:p-12 w-full p-4">
        <div v-for="(user, index) in response" :key="index"   class="p-6 bg-gray-100">
            <a :href="`/user/${user.id}`" class="text-center text-2xl">
                {{user.f_name}} {{user.l_name}}
            </a>
            <p class="mt-2 text-gray-800 text-center">
               {{user.email}}
            </p>
        </div>
    </div>

</template>
<script setup>
import {onMounted, ref} from "vue";
import axios from "axios";
const response = ref();
const GetUsers = async()=>{
    try{
        const users = await axios.get('/api/dashboard',{
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`,
                'Content-Type': 'multipart/form-data',
            }
        });
        response.value = users.data.data;
        console.log('Users:', users.data.data);
    }catch (error){
        console.log(error)
    }
}
onMounted(()=>{
    GetUsers();
})
</script>
