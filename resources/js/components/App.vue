<template>
  <div>
    <h2 class="text-2xl font-bold mb-6 text-center text-green-800">Connexion - Laboratoire SVT</h2>
    <form @submit.prevent="login" class="space-y-4">
      <div>
        <label class="block text-gray-700">Email</label>
        <input v-model="email" type="email" class="w-full border rounded px-4 py-2" required />
      </div>
      <div>
        <label class="block text-gray-700">Mot de passe</label>
        <input v-model="password" type="password" class="w-full border rounded px-4 py-2" required />
      </div>
      <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
        Se connecter
      </button>
      <p v-if="error" class="text-red-500 text-center mt-4">{{ error }}</p>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const email = ref('')
const password = ref('')
const error = ref('')

const login = async () => {
  try {
    await axios.get('/sanctum/csrf-cookie') // Nécessaire pour Sanctum
    const response = await axios.post('/api/login', { email: email.value, password: password.value })

    const role = response.data.role
    if (role === 'professeur') {
      window.location.href = '/professeur/dashboard'
    } else if (role === 'eleve') {
      window.location.href = '/eleve/dashboard'
    }
  } catch (err) {
    error.value = "Identifiants incorrects. Veuillez réessayer."
  }
}
</script>

<style scoped>
input:focus {
  outline: none;
  border-color: #38a169;
  box-shadow: 0 0 0 2px rgba(56, 161, 105, 0.5);
}
</style>
