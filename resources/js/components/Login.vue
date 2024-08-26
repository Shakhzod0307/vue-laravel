<template>
    <div class="text-2xl text-center">
        Join us now
    </div>
    <div class="mt-2 text-xl mb-2 text-center">
        This is a login page
    </div>
    <div class="p-5 m-5">
        <form @submit.prevent="LoginSubmit">
            <div class="mb-3 pt-0 text-center">
                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="email">Email:</label>
                <input type="text"
                       v-model="email"
                       :class="{ 'border-red-500': showErrorEmail }"
                       placeholder="Email"
                       class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative
bg-white rounded text-sm border border-blueGray-300 outline-none focus:outline-none focus:ring w-1/2"
                       id="email"
                       required/>
            </div>
            <div class=" pt-0 text-center">
                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="password">Password:</label>
                <input type="password"
                       v-model="password"
                       :class="{ 'border-red-500': showErrorPassword }"
                       placeholder="Password" class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative
bg-white rounded text-sm border border-blueGray-300 outline-none focus:outline-none focus:ring w-1/2"
                       id="password"
                       required/>
            </div>
            <div class="mt-3 pt-0 text-center">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Login
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref } from "vue";
import axios from 'axios';

const email = ref('');
const password = ref('');
const showErrorEmail = ref(false);
const showErrorPassword = ref(false);

const LoginSubmit = async () => {
    // Validate inputs
    showErrorEmail.value = !email.value;
    showErrorPassword.value = !password.value;

    if (showErrorEmail.value || showErrorPassword.value) {
        return;
    }

    try {
        // Make the login request
        const response = await axios.post('/api/login', {
            email: email.value,
            password: password.value
        });

        // Access token and user data
        const token = response.data.authorisation.token;
        const user = response.data.user;

        if (token) {
            localStorage.setItem('token', token);
            localStorage.setItem('user', JSON.stringify(user));
            window.location.href = '/test';
        } else {
            console.error('Token not received');
        }
    } catch (error) {
        console.error('Login failed:', error);
    }
};
</script>
