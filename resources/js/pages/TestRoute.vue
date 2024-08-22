<template>
    <router-link to="/">Home</router-link>
    <div>
        <h1>Add new user</h1>
        <form @submit.prevent="FormData">
            <label for="f_name">First Name: </label>
            <input type="text" v-model="first_name" id="f_name" name="f_name"><br>
            <label for="l_name">Last Name: </label>
            <input type="text" v-model="last_name" id="l_name" name="l_name"><br>
            <label for="email">Email: </label>
            <input type="email" v-model="email" id="email" name="email"><br>
            <label for="password">Password: </label>
            <input type="password" v-model="password" id="password" name="password"><br>
            <button type="submit">Submit</button>
        </form>
    </div>
    <div>
        <h1>Here is users page</h1>
<!--        <button @click.prevent="getValue">Trigger Endpoint</button>-->
        <p v-if="response">
            <ul v-for="(name ,index) in response" :key="index">
                <li >
                    First Name: {{ name.f_name}}<br>
                    Last Name: {{ name.l_name}}<br>
                    Email: {{ name.email}}
                </li>
            </ul>
        </p>
        <p v-else>No user found</p>
    </div>
</template>

<script setup>
import axios from "axios"
import {ref, onMounted} from "vue"
const response = ref();
const first_name = ref("");
const last_name = ref("");
const email = ref("");
const password = ref("");
const getValue = async () => {
    try {
        const {data} = await axios.get("/api/users");
        response.value = data;
    } catch (error) {
        // Do something with the error
        console.log(error);
    }
};
const FormData = async ()=>{
    try{
        const Data = {
            f_name : first_name.value,
            l_name : last_name.value,
            email : email.value,
            password : password.value,
        }
        await axios.post("/api/user/post",Data);
        await getValue();
        first_name.value = "";
        last_name.value = "";
        email.value = "";
        password.value = "";
    }catch (error){
        console.log(error)
    }
};
onMounted(()=>{
    getValue();
})
</script>
