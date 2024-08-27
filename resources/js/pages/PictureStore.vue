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
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';


const router = useRouter();
const image = ref(null);
const handleFileUpload = (event) => {
    image.value = event.target.files[0];
}

const submitImage = async () => {
    const formData = new FormData();
    formData.append('image', image.value);

    try {
        const response = await axios.post('/api/image', formData, {
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
</script>
