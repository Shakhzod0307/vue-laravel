<template>
    <router-link to="/">Home</router-link>
    <div>
        <h4>Name: {{ name }}</h4>
        <button style="padding: 10px 25px; font-size: 25px"  @click="count++">{{ count }}</button>
    </div>
</template>
<script>
export default {
    data(){
        return{
            name:"Jack",
            count: 1,
        }
    },
    methods:{

    }
}
</script>
