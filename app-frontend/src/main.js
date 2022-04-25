import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

// axios
import axios from 'axios'
import VueAxios from 'vue-axios'

import BootstrapVue3 from 'bootstrap-vue-3'

// Import Bootstrap and BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue-3/dist/bootstrap-vue-3.css'

const app = createApp(App)

app.use(BootstrapVue3)
app.use(router)
app.use(VueAxios, axios)

axios.defaults.baseURL = import.meta.env.VITE_CLIENT_APP_URL ?? 'http://localhost:8001/api'

app.mount('#app')
