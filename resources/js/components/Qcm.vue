<template>
  <div class="qcm-container">
    <h2 class="title">🧪 QCM - Après la simulation</h2>

    <p class="question">{{ question }}</p>

    <div v-for="(option, index) in options" :key="index">
      <label class="option">
        <input
          type="radio"
          name="qcm"
          :value="option.id"
          v-model="selected"
        />
        {{ option.text }}
      </label>
    </div>

    <button @click="valider" class="btn">✅ Valider</button>

    <div v-if="result !== null" class="result" :class="{ correct: result, incorrect: !result }">
      {{ result ? '✅ Bonne réponse !' : '❌ Mauvaise réponse' }}
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const question = 'Quel est le rôle de cette simulation ?'
const options = [
  { id: 1, text: 'Reproduire l’ADN', correct: true },
  { id: 2, text: 'Produire de l\'énergie', correct: false },
  { id: 3, text: 'Digérer les aliments', correct: false }
]

const selected = ref(null)
const result = ref(null)

function valider() {
  const bonne = options.find(o => o.correct)
  result.value = selected.value == bonne.id
}
</script>

<style scoped>
.qcm-container {
  margin-top: 30px;
  background: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.title {
  font-size: 20px;
  margin-bottom: 10px;
}
.option {
  display: block;
  margin-bottom: 10px;
}
.btn {
  background-color: #1abc9c;
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}
.btn:hover {
  background-color: #16a085;
}
.result {
  margin-top: 15px;
  font-weight: bold;
}
.correct {
  color: green;
}
.incorrect {
  color: red;
}
</style>