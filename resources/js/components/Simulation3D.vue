<template>
  <div class="simulation-container">
    <h2>Simulation 3D</h2>
    <model-viewer
      :src="modelSrc"
      alt="Simulation en 3D"
      auto-rotate
      camera-controls
      shadow-intensity="1"
      style="width: 100%; height: 500px;">
    </model-viewer>
  </div>
</template>

<script setup>
defineProps({
  modelSrc: {
    type: String,
    required: true
  }
});
</script>

<style scoped>
.simulation-container {
  background-color: #ffffff;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
}
</style>