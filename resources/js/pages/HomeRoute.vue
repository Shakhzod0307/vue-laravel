
<template>
    <div>
        <h1>Home page</h1>
        <router-link to="/test">Link to the test page</router-link><br>
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
        }
    }
}
</script>
