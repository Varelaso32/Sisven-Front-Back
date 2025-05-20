<template>
  <div id="app">
    <nav class="navbar">
      <router-link to="/" exact>🏠 Home</router-link>
      <router-link to="/customers">👤 Clientes</router-link>
      <router-link to="/categories">📂 Categorías</router-link>
      <router-link to="/pay-modes">💳 Modos de Pago</router-link>
      <router-link to="/products">🛍️ Productos</router-link>
    </nav>
    <main class="main-content">
      <router-view />
    </main>
  </div>
</template>

<style scoped>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  color: #2c3e50;
  background-color: #f9f9f9;
  min-height: 100vh;
}

.navbar {
  display: flex;
  gap: 20px;
  justify-content: center;
  align-items: center;
  padding: 20px;
  background-color: #ffffff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  font-size: 1.1rem;
}

.navbar a {
  text-decoration: none;
  font-weight: 600;
  color: #2c3e50;
  padding: 8px 12px;
  border-radius: 5px;
  transition: background-color 0.2s ease;
}

.navbar a:hover {
  background-color: #f0f0f0;
}

.navbar a.router-link-exact-active {
  color: #ffffff;
  background-color: #42b983;
}

.main-content {
  padding: 30px;
}
</style>
