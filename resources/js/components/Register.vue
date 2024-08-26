<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md p-8 space-y-6 bg-white rounded shadow">
            <h2 class="text-2xl font-bold text-center text-gray-700">Create an Account</h2>
            <form @submit.prevent="submitForm" novalidate>
                <!-- Name Field -->
                <div>
                    <label for="f_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input
                        type="text"
                        id="f_name"
                        v-model="form.f_name"
                        :class="inputClasses('f_name')"
                        placeholder="John"
                    />
                    <p v-if="errors.f_name" class="mt-1 text-sm text-red-600">{{ errors.f_name[0] }}</p>
                </div>
                <div>
                    <label for="l_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input
                        type="text"
                        id="l_name"
                        v-model="form.l_name"
                        :class="inputClasses('l_name')"
                        placeholder="Doe"
                    />
                    <p v-if="errors.l_name" class="mt-1 text-sm text-red-600">{{ errors.l_name[0] }}</p>
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        v-model="form.email"
                        :class="inputClasses('email')"
                        placeholder="example@example.com"
                    />
                    <p v-if="errors.email" class="mt-1 text-sm text-red-600">{{ errors.email[0] }}</p>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input
                        type="password"
                        id="password"
                        v-model="form.password"
                        :class="inputClasses('password')"
                        placeholder="********"
                    />
                    <p v-if="errors.password" class="mt-1 text-sm text-red-600">{{ errors.password[0] }}</p>
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        :class="inputClasses('password_confirmation')"
                        placeholder="********"
                    />
                    <p v-if="errors.password_confirmation" class="mt-1 text-sm text-red-600">{{ errors.password_confirmation[0] }}</p>
                </div>

                <!-- Submit Button -->
                <div>
                    <button
                        type="submit"
                        class="w-full px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50"
                        :disabled="loading"
                    >
                        <span v-if="loading">Registering...</span>
                        <span v-else>Register</span>
                    </button>
                    <p class="text-right mt-3">Already have an account ?
                        <router-link to="/login"
                                     class="text-blue-500 hover:text-blue-700 font-semibold
                                            hover:no-underline transition duration-300">
                            Login
                        </router-link>

                    </p>
                </div>

                <!-- Success Message -->
                <div v-if="successMessage" class="p-4 text-green-700 bg-green-100 rounded">
                    {{ successMessage }}
                </div>

                <!-- General Error Message -->
                <div v-if="generalError" class="p-4 text-red-700 bg-red-100 rounded">
                    {{ generalError }}
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
const form = ref({
    f_name: '',
    l_name: '',
    email: '',
    password: '',
    password_confirmation: '',
});
const loading = ref(false);
const successMessage = ref('');
const generalError = ref('');
const errors = ref({});
const inputClasses = (field) => [
    'w-full px-3 py-2 mt-1 border rounded focus:outline-none focus:ring',
    errors.value[field] ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500',
];
const submitForm = async () => {
    loading.value = true;
    successMessage.value = '';
    generalError.value = '';
    errors.value = {};
    try {
        const response = await axios.post('/api/register', form.value);
        successMessage.value = response.data.message;
        localStorage.setItem('token', response.data.token);
        localStorage.setItem('user', JSON.stringify(response.data.user));
        window.location.href = '/users';
        form.value = {
            f_name: '',
            l_name: '',
            email: '',
            password: '',
            password_confirmation: '',
        };
    } catch (error) {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors;
        } else {
            generalError.value = 'An unexpected error occurred. Please try again.';
        }
    } finally {
        loading.value = false;
    }
};
</script>

<style scoped>

</style>
