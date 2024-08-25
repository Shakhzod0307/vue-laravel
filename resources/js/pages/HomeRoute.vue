
<template>
    <div>
        <h1>Home page</h1>
        <router-link
            to="/test"
            class="text-blue-500 hover:text-blue-700 font-semibold underline hover:no-underline transition duration-300"
        >
            Link to the test page
        </router-link><br>
        <router-link to="/count">Link to the count page</router-link>
        <hr>
<!--        <Count/>-->
        <p>{{message}}</p><br>
        <input v-model="message" placeholder="Write here">
        <div>Checked names: {{ checkedNames }}</div>
        <label for="anna">Anna</label>
        <input type="checkbox" id="anna" v-model="checkedNames" value="Anna">
        <label for="jack">Jack</label>
        <input type="checkbox" id="jack" v-model="checkedNames" value="Jack">
        <label for="alex">Alex</label>
        <input type="checkbox" id="alex" v-model="checkedNames" value="Alex">
    </div>

    <div v-for="variant in variants" :key="variant.id"
         @mouseover="updateImage(variant.image)"
         class="image-circle"
         :style="{backgroundColor: variant.color}"
    >
    </div>

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
