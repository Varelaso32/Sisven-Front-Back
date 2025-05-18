<template>
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="h3 text-primary">
        <font-awesome-icon icon="list" class="me-2" /> Listado de Categorías
      </h1>
      <button
        @click="newCategory"
        class="btn btn-success d-flex align-items-center"
      >
        <font-awesome-icon icon="plus" class="me-2" />
        Nueva Categoría
      </button>
    </div>

    <div class="table-responsive shadow-sm rounded">
      <table class="table table-striped table-hover align-middle mb-0">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th><font-awesome-icon icon="tag" class="me-1" /> Nombre</th>
            <th>
              <font-awesome-icon icon="file-alt" class="me-1" /> Descripción
            </th>
            <th class="text-center">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(category, index) in categories" :key="category.id">
            <th scope="row">{{ index + 1 }}</th>
            <td>{{ category.name }}</td>
            <td>{{ category.description }}</td>
            <td class="text-center">
              <button
                @click="editCategory(category.id)"
                class="btn btn-sm btn-warning me-2"
                title="Editar Categoría"
              >
                <font-awesome-icon icon="pencil" />
              </button>
              <button
                @click="deleteCategory(category.id)"
                class="btn btn-sm btn-danger"
                title="Eliminar Categoría"
              >
                <font-awesome-icon icon="trash" />
              </button>
            </td>
          </tr>
          <tr v-if="categories.length === 0">
            <td colspan="4" class="text-center py-4 text-muted">
              No hay categorías registradas.
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {
  name: "CategoriesList",
  data() {
    return {
      categories: [],
    };
  },
  methods: {
    fetchCategories() {
      axios
        .get("http://127.0.0.1:8000/api/categories")
        .then((response) => {
          this.categories = response.data.categories;
        })
        .catch((error) => {
          console.error("Error fetching categories:", error);
        });
    },
    deleteCategory(id) {
      Swal.fire({
        title: `¿Deseas eliminar la categoría con ID ${id}?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Eliminar",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#d33",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(`http://127.0.0.1:8000/api/categories/${id}`)
            .then((response) => {
              Swal.fire(
                "¡Eliminado!",
                "La categoría ha sido eliminada.",
                "success"
              );
              this.categories = response.data.categories;
            })
            .catch((error) => {
              console.error("Error deleting category:", error);
              Swal.fire("Error", "No se pudo eliminar la categoría.", "error");
            });
        }
      });
    },
    editCategory(id) {
      this.$router.push({ name: "EditarCategoria", params: { id: `${id}` } });
    },
    newCategory() {
      this.$router.push({ name: "NuevaCategoria" });
    },
  },
  mounted() {
    this.fetchCategories();
  },
};
</script>

<style scoped>
.table thead th {
  vertical-align: middle;
  text-align: center;
}
.table tbody td {
  vertical-align: middle;
}
</style>
