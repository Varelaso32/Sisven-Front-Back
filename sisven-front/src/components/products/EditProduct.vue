<template>
  <div class="container text-start py-4">
    <h1 class="text-success fw-bold mb-4">Editar Producto</h1>
    <div class="card shadow-sm rounded">
      <div class="card-header fw-bold bg-success text-white">
        Datos del Producto
      </div>
      <div class="card-body">
        <form @submit.prevent="updateProduct">
          <div class="mb-3">
            <label for="name" class="form-label">Nombre del Producto:</label>
            <div class="input-group">
              <span class="input-group-text">
                <font-awesome-icon icon="box" />
              </span>
              <input
                type="text"
                class="form-control"
                id="name"
                v-model="product.name"
                required
              />
            </div>
          </div>

          <div class="mb-3">
            <label for="precio" class="form-label">Precio:</label>
            <div class="input-group">
              <span class="input-group-text">
                <font-awesome-icon icon="dollar-sign" />
              </span>
              <input
                type="number"
                class="form-control"
                id="precio"
                v-model.number="product.precio"
                min="0"
                required
              />
            </div>
          </div>

          <div class="mb-3">
            <label for="stock" class="form-label">Stock:</label>
            <div class="input-group">
              <span class="input-group-text">
                <font-awesome-icon icon="boxes" />
              </span>
              <input
                type="number"
                class="form-control"
                id="stock"
                v-model.number="product.stock"
                min="0"
                required
              />
            </div>
          </div>

          <div class="mb-4">
            <label for="category_id" class="form-label">Categoría:</label>
            <div class="input-group">
              <span class="input-group-text">
                <font-awesome-icon icon="tags" />
              </span>
              <select
                class="form-select"
                id="category_id"
                v-model="product.category_id"
                required
              >
                <option disabled value="">Seleccione una categoría</option>
                <option
                  v-for="category in categories"
                  :key="category.id"
                  :value="category.id"
                >
                  {{ category.name }}
                </option>
              </select>
            </div>
          </div>

          <button type="submit" class="btn btn-success me-2">Guardar</button>
          <button
            type="button"
            class="btn btn-outline-secondary"
            @click="cancel"
          >
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
  name: "EditarProducto",
  data() {
    return {
      product: {
        id: null,
        name: "",
        precio: 0,
        stock: 0,
        category_id: "",
      },
      categories: [],
    };
  },
  methods: {
    cancel() {
      this.$router.push({ name: "Products" });
    },
    async updateProduct() {
      try {
        const res = await axios.put(
          `http://127.0.0.1:8000/api/products/${this.product.id}`,
          this.product
        );
        if (res.status === 200) {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Producto actualizado correctamente",
            showConfirmButton: false,
            timer: 2000,
          });
          this.$router.push({ name: "Products" });
        }
      } catch (error) {
        console.error("Error al actualizar producto:", error);
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "No se pudo actualizar el producto.",
        });
      }
    },
    async fetchCategories() {
      try {
        const res = await axios.get("http://127.0.0.1:8000/api/categories");
        this.categories = res.data.categories;
      } catch (error) {
        console.error("Error al cargar categorías:", error);
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "No se pudieron cargar las categorías.",
        });
      }
    },
    async fetchProduct() {
      const id = this.$route.params.id;
      try {
        const res = await axios.get(`http://127.0.0.1:8000/api/products/${id}`);
        this.product = res.data.product;
      } catch (error) {
        console.error("Error al obtener el producto:", error);
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "No se pudo cargar la información del producto.",
        });
      }
    },
  },
  mounted() {
    this.fetchCategories();
    this.fetchProduct();
  },
};
</script>
