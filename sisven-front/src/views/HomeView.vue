<template>
  <div class="home-view">
    <img class="vue-logo" alt="Vue logo" src="../assets/logo.png" />
    <HelloWorld msg="Bienvenido a tu aplicación Vue.js 🎉" />
  </div>
</template>

<script>
import HelloWorld from "@/components/HelloWorld.vue";

export default {
  name: "HomeView",
  components: {
    HelloWorld,
  },
};
</script>

<style scoped>
.home-view {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 40px 20px;
  text-align: center;
  background-color: #f9f9f9;
  min-height: 100vh;
}

.vue-logo {
  width: 120px;
  margin-bottom: 20px;
}
</style>
