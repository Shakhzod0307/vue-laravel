<template>
    <button @click="Logout"
            class="bg-red-500 hover:bg-red-700 text-white
                    font-bold py-2 px-4 rounded transition-colors duration-300"
    >Logout</button>
</template>
<script setup>
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();

const Logout = async ()=>{
    try{
        await axios.post('/api/logout',null,{
            headers:{
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        });
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        await router.push('/login')
    }catch (error){
        console.log('Error logging out: ',error)
    }
}

</script>
