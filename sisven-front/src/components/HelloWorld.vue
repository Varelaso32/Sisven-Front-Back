<template>
  <div class="admin-dashboard">
    <h1 class="title">{{ msg }}</h1>
    <p class="intro">
      Bienvenido al panel de administración de tu tienda. Usa las siguientes
      secciones para gestionar tu negocio.
    </p>

    <div class="grid">
      <div class="card" v-for="section in sections" :key="section.title">
        <h3>{{ section.title }}</h3>
        <p>{{ section.description }}</p>
        <router-link :to="section.link">Ir a {{ section.title }}</router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "HelloWorld",
  props: {
    msg: String,
  },
  data() {
    return {
      sections: [
        {
          title: "Productos",
          description: "Administra tu inventario de productos.",
          link: "/products",
        },
        {
          title: "Clientes",
          description: "Consulta y gestiona tus clientes.",
          link: "/customers",
        },
        {
          title: "Pedidos",
          description: "Revisa el historial y estado de pedidos.",
          link: "/orders",
        },
        {
          title: "Categorías",
          description: "Organiza tus productos por categoría.",
          link: "/categories",
        },
        {
          title: "Reportes",
          description: "Visualiza reportes de ventas y rendimiento.",
          link: "/reports",
        },
      ],
    };
  },
};
</script>

<style scoped>
.admin-dashboard {
  max-width: 1000px;
  margin: auto;
  padding: 2rem;
  text-align: center;
}

.title {
  color: #2c3e50;
  font-size: 2rem;
  font-weight: 600;
  margin-bottom: 1rem;
}

.intro {
  font-size: 1.1rem;
  color: #555;
  margin-bottom: 2rem;
}

.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 1.5rem;
}

.card {
  background: #fff;
  border-radius: 10px;
  padding: 1.5rem;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
  transition: transform 0.2s ease;
  text-align: left;
}

.card:hover {
  transform: translateY(-5px);
}

.card h3 {
  margin-bottom: 0.5rem;
  color: #42b983;
}

.card p {
  font-size: 0.95rem;
  color: #333;
  margin-bottom: 1rem;
}

.card a {
  text-decoration: none;
  color: #2c3e50;
  font-weight: bold;
  transition: color 0.2s;
}

.card a:hover {
  color: #42b983;
}
</style>
