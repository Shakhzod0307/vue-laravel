<template>
    <router-link to="/">Home</router-link>
    <div>
        <h1>Here is test page</h1>
<!--        <button @click.prevent="getValue">Trigger Endpoint</button>-->
        <p v-if="response">
            <ul>
                <li v-for="(name ,index) in response" :key="index">
                    {{index+1}} {{ name}}
                </li>
            </ul>
        </p>
        <p v-else>No data found</p>
    </div>
</template>

<script setup>
import axios from "axios"
import {ref, onMounted} from "vue"
const response = ref();

const getValue = async () => {
    try {
        const {data} = await axios.get("/api/users");
        response.value = data;
    } catch (error) {
        // Do something with the error
        console.log(error);
    }
};
onMounted(()=>{
    getValue();
})
</script>
