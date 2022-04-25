import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

// Vue-auth
import {createAuth} from '@websanova/vue-auth';
import driverAuthBearer from '@websanova/vue-auth/dist/drivers/auth/bearer.esm.js';
import driverHttpAxios from '@websanova/vue-auth/dist/drivers/http/axios.1.x.esm.js';
import driverRouterVueRouter from '@websanova/vue-auth/dist/drivers/router/vue-router.2.x.esm.js';

// axios
import axios from 'axios'
import VueAxios from 'vue-axios'

// Bootstrap Vue
import BootstrapVue3 from 'bootstrap-vue-3'

// Import Bootstrap and BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue-3/dist/bootstrap-vue-3.css'

// Vue auth
const auth = createAuth({
    plugins: {
        http: axios,
        router: router
    },
    drivers: {
        http: driverHttpAxios,
        auth: driverAuthBearer,
        router: driverRouterVueRouter,
    },
    options: {
        rolesKey: 'role',
        notFoundRedirect: {name: 'user-account'},
    }
});

const app = createApp(App)

app.use(BootstrapVue3)
app.use(router)
app.use(VueAxios, axios)
app.use(auth)

axios.defaults.baseURL = import.meta.env.VITE_CLIENT_APP_URL ?? 'http://localhost:8001/api/v1'

app.mount('#app')
