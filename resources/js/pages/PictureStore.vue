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
            <h1 class="text-xl font-bold text-gray-700 mb-4">Add Image</h1>
            <form @submit.prevent="submitImage">
                <label for="image" class="block text-gray-600">Image:</label>
                <input
                    type="file"
                    @change="handleFileUpload"
                    id="image"
                    name="image"
                    required
                    class="w-full px-4 py-2 mb-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >

                <button
                    type="submit"
                    class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition-colors"
                >
                    Submit
                </button>
            </form>
        </div>
    </div>
    <div v-if="response.data" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:p-12 w-full p-4">
        <div v-for="(image, index) in response.data" :key="index" class="p-6 bg-gray-100">
            <img :src="`storage/${image.image}`" alt="Image" class="w-full h-60 scale-100 hover:scale-[1.12] transition-transform object-cover  rounded-lg" />
            <h2 class="font-semibold text-lg text-center text-gray-800 mt-2">
                {{ image.user.f_name }}
                {{ image.user.l_name }}
            </h2>
            <p class="mt-2 text-gray-800 text-center">
                {{ image.user.email || 'No description available.' }}
            </p>
        </div>
    </div>
</template>

<script setup>
import {onMounted, ref} from 'vue';
import axios from 'axios';
import {useRouter} from 'vue-router';

const router = useRouter();
const image = ref(null);
const response = ref([]);

const isTokenExpired = () => {
    const tokenExpiry = localStorage.getItem('token_expiry');
    if (!tokenExpiry) return true;
    const now = new Date().getTime();
    return now > tokenExpiry;
};
const handleFileUpload = (event) => {
    image.value = event.target.files[0];
}

const submitImage = async () => {
    const formData = new FormData();
    formData.append('image', image.value);

    try {
        const response = await axios.post('/api/image/store', formData, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`,
                'Content-Type': 'multipart/form-data',
            }
        });
        console.log('Image uploaded successfully:', response.data);
        image.value = null;
        window.location.href = '/image';
    } catch (error) {
        console.log('Error uploading image:', error);
    }
}

const getValue = async () => {
    if (isTokenExpired()) {
        console.log('Token expired');
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        localStorage.removeItem('token_expiry');
        window.location.href = '/login';
        return;
    }
    try {
        const { data } = await axios.get("/api/images", {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        });
        response.value = data;
        console.log('images:', data);
    } catch (error) {
        console.log(error);
    }
};
onMounted(()=>{
    getValue();
})
</script>
