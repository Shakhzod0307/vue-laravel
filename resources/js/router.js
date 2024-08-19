import {createRouter, createWebHistory } from "vue-router";

const routes =  [
    {
    path: "/",
    component: ()=>import("./pages/HomeRoute.vue")
    },
    {
    path: "/test",
    component: ()=>import("./pages/TestRoute.vue")
    },
    {
    path: "/count",
    component: ()=>import("./pages/Count.vue")
    }
];
export default createRouter({
    history:createWebHistory(),
    routes,
});
