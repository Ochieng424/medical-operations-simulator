import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/auth/LoginView.vue'
import LoginView from "../views/auth/LoginView";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'login',
            component: LoginView
        },
        // {
        //     path: '/addproduct',
        //     name: 'add',
        //     // route level code-splitting
        //     // this generates a separate chunk (About.[hash].js) for this route
        //     // which is lazy-loaded when the route is visited.
        //     component: () => import('../views/AddView.vue')
        // }
    ]
})

export default router
