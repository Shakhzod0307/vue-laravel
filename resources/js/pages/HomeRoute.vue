
<template>
    <div>
<!--        <h1>Home page</h1>-->
        <router-link
            to="/test"
            class="text-blue-500 hover:text-blue-700 font-semibold  hover:no-underline transition duration-300"
        >
            Link to the test page
        </router-link><br>
        <router-link to="/count" class="text-blue-500 hover:text-blue-700 font-semibold  hover:no-underline transition duration-300">Link to the count page</router-link>
        <hr>
<!--        <Count/>-->
        <div class="p-6 max-w-md mx-auto bg-white rounded-xl shadow-md space-y-4">

            <p class="text-lg font-medium text-gray-700">{{ message }}</p>
            <input
                type="text"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                v-model="message"
                placeholder="Write here"
            />

            <div class="mt-4 text-sm font-semibold text-gray-600">
                Checked names:
                <span class="text-blue-500">{{ checkedNames.length > 0 ? checkedNames.join(', ') : 'None' }}</span>
            </div>

            <div class="space-y-2 mt-4">
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="anna" v-model="checkedNames" value="Anna" class="form-checkbox text-blue-500" />
                    <label for="anna" class="text-gray-700">Anna</label>
                </div>
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="jack" v-model="checkedNames" value="Jack" class="form-checkbox text-blue-500" />
                    <label for="jack" class="text-gray-700">Jack</label>
                </div>
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="alex" v-model="checkedNames" value="Alex" class="form-checkbox text-blue-500" />
                    <label for="alex" class="text-gray-700">Alex</label>
                </div>
            </div>
        </div>
    </div>

<!--    <div v-for="variant in variants" :key="variant.id"-->
<!--         @mouseover="updateImage(variant.image)"-->
<!--         class="image-circle"-->
<!--         :style="{backgroundColor: variant.color}"-->
<!--    >-->
<!--    </div>-->

</template>
<script>
import Count from "./Count.vue"
export default {

    components:{
        Count,
    },
    data(){
        return{
            message:'',
            checkedNames:[],
            variants: [
                {id:1,color:'green',image:'images/HighPerformanceMySQL.jpg'},
                {id:2,color:'red',image:'images/PhpCookbook.jpg'},
                {id:3,color:'blue',image:'images/PracticalLaravel.jpg'},
            ],
        }
    },
    methods:{
        updateImage(variantImage){
            this.image = variantImage
        }
    }
}
</script>
<style scoped>
.image-circle{
    width: 50px;
    height: 50px;
    margin-top: 15px;
    border: 2px solid #d8d8d8;
    border-radius: 50%;
}
</style>
