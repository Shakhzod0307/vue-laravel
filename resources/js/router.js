import { createRouter, createWebHistory } from "vue-router";
import Swal from 'sweetalert2';

// Middleware to check user role
// const checkUserType = (to, from, next) => {
//     const user = JSON.parse(localStorage.getItem('user'));
//     if (user?.role === 'admin') {
//         console.log('ok');
//         next();
//     } else {
//         Swal.fire({
//             icon: "error",
//             title: "Oops…",
//             text: "You are not authorized to access this page!",
//         });
//         next('/');
//     }
// };

// Routes definition
const routes = [
    {
        path: "/login",
        name: "login",
        component: () => import("./components/Login.vue"),
    },
    {
        path: "/register",
        name: "register",
        component: () => import("./components/Register.vue"),
    },
    {
        path: "/test",
        name: "test",
        component: () => import("./pages/TestRoute.vue"),
        // beforeEnter: checkUserType,  // Add role check here
    },
    {
        path: "/count",
        name: "count",
        component: () => import("./pages/Count.vue"),
        // beforeEnter: checkUserType,  // Add role check here
    },
    {
        path: "/",
        name: "home",
        component: () => import("./pages/Home.vue"),  // Optional home route
    },
];

// Create router instance
const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Global navigation guard for authentication
router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem('token');
    if (!isAuthenticated && to.name !== 'login' && to.name !== 'register') {
        next({ name: 'login' });
    } else {
        next();
    }
});

export default router;
