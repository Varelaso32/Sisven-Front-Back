<template>
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="h3 text-primary">
        <font-awesome-icon icon="box" class="me-2" /> Listado de Productos
      </h1>
      <button
        @click="newProduct"
        class="btn btn-success d-flex align-items-center"
      >
        <font-awesome-icon icon="plus" class="me-2" />
        Nuevo Producto
      </button>
    </div>

    <div class="table-responsive shadow-sm rounded">
      <table class="table table-striped table-hover align-middle mb-0">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th><font-awesome-icon icon="barcode" class="me-1" /> Nombre</th>
            <th>
              <font-awesome-icon icon="dollar-sign" class="me-1" /> Precio
            </th>
            <th><font-awesome-icon icon="boxes" class="me-1" /> Stock</th>
            <th><font-awesome-icon icon="tags" class="me-1" /> Categoría</th>
            <th class="text-center">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(product, index) in products" :key="product.id">
            <th scope="row">{{ index + 1 }}</th>
            <td>{{ product.name }}</td>
            <td>{{ product.precio }}</td>
            <td>{{ product.stock }}</td>
            <td>{{ product.category_name }}</td>
            <td class="text-center">
              <button
                @click="editProduct(product.id)"
                class="btn btn-sm btn-warning me-2"
                title="Editar Producto"
              >
                <font-awesome-icon icon="pencil" />
              </button>
              <button
                @click="deleteProduct(product.id)"
                class="btn btn-sm btn-danger"
                title="Eliminar Producto"
              >
                <font-awesome-icon icon="trash" />
              </button>
            </td>
          </tr>
          <tr v-if="products.length === 0">
            <td colspan="6" class="text-center py-4 text-muted">
              No hay productos registrados.
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
  name: "ProductsList",
  data() {
    return {
      products: [],
    };
  },
  methods: {
    fetchProducts() {
      axios
        .get("http://127.0.0.1:8000/api/products")
        .then((response) => {
          this.products = response.data.products;
        })
        .catch((error) => {
          console.error("Error fetching products:", error);
        });
    },
    deleteProduct(id) {
      Swal.fire({
        title: `¿Deseas eliminar el producto con ID ${id}?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Eliminar",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#d33",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(`http://127.0.0.1:8000/api/products/${id}`)
            .then((response) => {
              Swal.fire(
                "¡Eliminado!",
                "El producto ha sido eliminado.",
                "success"
              );
              this.products = response.data.products;
            })
            .catch((error) => {
              console.error("Error deleting product:", error);
              Swal.fire("Error", "No se pudo eliminar el producto.", "error");
            });
        }
      });
    },
    editProduct(id) {
      this.$router.push({ name: "EditarProducto", params: { id: `${id}` } });
    },
    newProduct() {
      this.$router.push({ name: "NuevoProducto" });
    },
  },
  mounted() {
    this.fetchProducts();
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
