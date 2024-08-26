<template>
    <div class="p-6 max-w-md mx-auto bg-white rounded-xl shadow-md space-y-4">
        <!-- Navigation Link -->
        <router-link
            to="/"
            class="text-blue-500 hover:underline"
        >
            Home
        </router-link>

        <!-- Add New User Form -->
        <div>
            <h1 class="text-xl font-bold text-gray-700 mb-4">Add New User</h1>
            <form @submit.prevent="submitForm">
                <label for="f_name" class="block text-gray-600">First Name:</label>
                <input
                    type="text"
                    v-model="first_name"
                    id="f_name"
                    name="f_name"
                    required
                    class="w-full px-4 py-2 mb-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >

                <label for="l_name" class="block text-gray-600">Last Name:</label>
                <input
                    type="text"
                    v-model="last_name"
                    id="l_name"
                    name="l_name"
                    required
                    class="w-full px-4 py-2 mb-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >

                <label for="email" class="block text-gray-600">Email:</label>
                <input
                    type="email"
                    v-model="email"
                    id="email"
                    name="email"
                    required
                    class="w-full px-4 py-2 mb-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >

                <label for="password" class="block text-gray-600">Password:</label>
                <input
                    type="password"
                    v-model="password"
                    id="password"
                    name="password"
                    required
                    class="w-full px-4 py-2 mb-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >

                <button
                    type="submit"
                    class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition-colors"
                >
                    Submit
                </button>
            </form>
        </div>

        <!-- Users List -->
        <div>
            <h1 class="text-xl font-bold text-gray-700 mt-8 mb-4">Here is users page</h1>
            <div v-if="response">
                <ul v-for="(name, index) in response" :key="index" class="mb-4">
                    <li class="p-4 border border-gray-300 rounded-md">
                        <p><strong>First Name:</strong> {{ name.f_name }}</p>
                        <p><strong>Last Name:</strong> {{ name.l_name }}</p>
                        <p><strong>Email:</strong> {{ name.email }}</p>
                        <button
                            @click="deleteUser(index)"
                            class="mt-2 bg-red-500 text-white py-1 px-2 rounded-md hover:bg-red-600 transition-colors"
                        >
                            Delete
                        </button>
                        <Logout/>
                    </li>
                </ul>
            </div>
            <p v-else class="text-gray-500">No user found</p>
        </div>
    </div>
</template>


<script setup>
import axios from "axios"
import {ref, onMounted} from "vue"
import Logout from "../components/Logout.vue";
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
        console.log(error);
    }
};
const submitForm = async ()=>{
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
const deleteUser = async (index)=>{
    try{
        const id = response.value[index].id;
        await axios.delete(`/api/user/delete/${id}`);
        response.value.splice(index,1)
    }catch (error){
        if (error.response && error.response.status === 403) {
            console.error("Permission error: You do not have access to delete this user.");
        } else {
            console.error("There was an error deleting the user:", error);
        }
    }
}
onMounted(()=>{
    getValue();
})
</script>
