//import './bootstrap';

import { createApp } from 'vue'
import Login from './components/Login.vue'
import axios from 'axios'

axios.defaults.withCredentials = true
axios.defaults.baseURL = 'http://localhost:8000'

export default axios

createApp(Login).mount('#app')

import Simulation3D from './components/Simulation3D.vue';

const app = createApp({});
app.component('Simulation3D', Simulation3D);
app.mount('#app');
// pour les QCM
import '@google/model-viewer';

import Qcm from './components/Qcm.vue'
app.component('qcm', Qcm)
app.mount('#app')
