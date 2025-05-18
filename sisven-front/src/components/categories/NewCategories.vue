<template>
  <div class="container text-start">
    <h1 class="text-primary fw-bold">Nueva Categoría</h1>
    <div class="card">
      <div class="card-header fw-bold">Datos de la Categoría</div>
      <div class="card-body">
        <form @submit.prevent="saveCategory">
          <div class="row mb-3">
            <label for="name" class="form-label">Nombre:</label>
            <div class="input-group">
              <div class="input-group-text">
                <font-awesome-icon icon="pencil" />
              </div>
              <input
                type="text"
                class="form-control"
                id="name"
                v-model="category.name"
                placeholder="Nombre de la categoría"
                required
                maxlength="64"
              />
            </div>
          </div>

          <div class="row mb-3">
            <label for="description" class="form-label">Descripción:</label>
            <textarea
              class="form-control"
              id="description"
              v-model="category.description"
              placeholder="Descripción de la categoría"
              rows="4"
              required
            ></textarea>
          </div>

          <button type="submit" class="btn btn-primary me-2">Guardar</button>
          <button type="button" class="btn btn-secondary" @click="cancel">
            Cancelar
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {
  name: "NewCategory",
  data() {
    return {
      category: {
        name: "",
        description: "",
      },
    };
  },
  methods: {
    cancel() {
      this.$router.push({ name: "Categories" }); // Cambia según tu ruta real de listado de categorías
    },
    async saveCategory() {
      try {
        const res = await axios.post(
          "http://127.0.0.1:8000/api/categories",
          this.category
        );
        if (res.status === 200 || res.status === 201) {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Categoría creada correctamente",
            showConfirmButton: false,
            timer: 2000,
          });
          this.$router.push({ name: "Categories" });
        }
      } catch (error) {
        console.error("Error al crear categoría:", error);

        let msg = "No se pudo crear la categoría.";
        if (error.response && error.response.data && error.response.data.msg) {
          msg = error.response.data.msg;
        }
        Swal.fire({
          icon: "error",
          title: "Error",
          text: msg,
        });
      }
    },
  },
};
</script>
