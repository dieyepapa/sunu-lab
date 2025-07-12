<template>
  <div class="container">
    <form class="login-form" @submit.prevent="handleLogin">
      <h2>Connexion</h2>

      <label>Email :</label>
      <input type="email" v-model="email" placeholder="Votre email" required />

      <label>Mot de passe :</label>
      <input type="password" v-model="password" placeholder="Votre mot de passe" required />

      <button type="submit">Se connecter</button>
    </form>
  </div>
</template>

<script>
import axios from '../axios'; // ← chemin vers ton axios.js

export default {
  data() {
    return {
      email: '',
      password: '',
    };
  },
  methods: {
   async handleLogin() {
  try {
    console.log("Tentative de récupération du cookie CSRF...");
    await axios.get('/sanctum/csrf-cookie');
    console.log("Cookie CSRF obtenu.");

    console.log("Tentative de connexion...");
    const response = await axios.post('/api/login', {
      email: this.email,
      password: this.password,
    });
    console.log("Réponse du backend :", response.data);

    if (response.data.status === 'eleve') {
      window.location.href = '/eleve';
    } else if (response.data.status === 'professeur') {
      window.location.href = '/professeur';
    }
  } catch (error) {
  if (error.response) {
    alert("les identification fournis sont incorrects");
  }
}

  }
}
  }

</script>

<style scoped>
.container {
  display: flex;
  height: 100vh;
  justify-content: center;
  align-items: center;
  background-color: #f4f4f4;
}
.login-form {
  background: white;
  padding: 2rem;
  border-radius: 8px;
  width: 300px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}
.login-form h2 {
  margin-bottom: 1rem;
  text-align: center;
}
.login-form label {
  display: block;
  margin: 0.5rem 0 0.2rem;
  font-weight: bold;
}
.login-form input {
  width: 100%;
  padding: 0.5rem;
  margin-bottom: 1rem;
  border-radius: 4px;
  border: 1px solid #ccc;
}
.login-form button {
  width: 100%;
  padding: 0.7rem;
  background-color: #3490dc;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.login-form button:hover {
  background-color: #2779bd;
}
</style>