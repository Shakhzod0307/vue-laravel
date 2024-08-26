<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md p-8 space-y-6 bg-white rounded shadow">
            <h2 class="text-2xl font-bold text-center text-gray-700">Login</h2>
            <form @submit.prevent="LoginSubmit" >
                <div>
                    <label for="email" class="block mb-3 text-sm font-medium text-gray-700">Email Address</label>
                    <input class="w-full px-3 py-2 mt-1 border rounded focus:outline-none focus:ring"
                        type="email"
                        id="email"
                        v-model="email"
                        :class="{ 'border-red-500': showErrorEmail }"
                        placeholder="example@example.com"
                        required
                    />
                </div>

                <div>
                    <label for="password" class="block text-sm mt-4 mb-3 font-medium text-gray-700">Password</label>
                    <input
                        class="w-full px-3 py-2 mt-1 border rounded focus:outline-none focus:ring"
                        type="password"
                        id="password"
                        v-model="password"
                        :class="{ 'border-red-500': showErrorPassword }"
                        placeholder="********"
                        required
                    />
                </div>

                <div>
                    <button
                        type="submit"
                        class="w-full px-4 mt-5 py-2 text-white bg-blue-600
                         rounded hover:bg-blue-700 focus:outline-none focus:ring-2
                         focus:ring-blue-500 disabled:opacity-50">
                        <span>Login</span>
                    </button>
                    <p class="text-right mt-3">Don't have an account ?
                        <router-link to="/register"
                                     class="text-blue-500 hover:text-blue-700 font-semibold
                                            hover:no-underline transition duration-300">
                            Register
                        </router-link>

                    </p>
                </div>
            </form>
        </div>
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
    showErrorEmail.value = !email.value;
    showErrorPassword.value = !password.value;
    if (showErrorEmail.value || showErrorPassword.value) {
        return;
    }
    try {
        const response = await axios.post('/api/login', {
            email: email.value,
            password: password.value
        });
        const token = response.data.authorisation.token;
        const user = response.data.user;
        if (token) {
            localStorage.setItem('token', token);
            localStorage.setItem('user', JSON.stringify(user));
            window.location.href = '/';
        } else {
            console.error('Token not received');
        }
    } catch (error) {
        console.error('Login failed:', error);
    }
};
</script>
