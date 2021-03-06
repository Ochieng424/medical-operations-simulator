import {createRouter, createWebHistory} from 'vue-router'
import LoginView from "../views/auth/LoginView.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'login',
            component: LoginView,
            meta: {
                auth: false
            }
        },
        {
            path: '/patients',
            name: 'patients',
            component: () => import('../views/dashboard/PatientsView.vue'),
            meta: {
                auth: true
            }
        },
        {
            path: '/patients/:id',
            name: 'patient',
            component: () => import('../views/dashboard/PatientView.vue'),
            meta: {
                auth: true
            }
        },
        {
            path: '/reports',
            name: 'reports',
            component: () => import('../views/dashboard/Reports.vue'),
            meta: {
                auth: true
            }
        }
    ]
})

export default router
