/// src/axios.js
import axios from 'axios';

const instance = axios.create({
  baseURL: 'http://127.0.0.1:8000', // Backend Laravel
  withCredentials: true, // Nécessaire pour que Sanctum envoie les cookies (CSRF + session)
  headers: {
    'X-Requested-With': 'XMLHttpRequest', // Nécessaire pour que Sanctum détecte une requête AJAX
    'Accept': 'application/json',
    'Content-Type': 'application/json',
  },
});

export default instance;