<template>
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="h3 text-success fw-bold">
        <font-awesome-icon icon="money-check-alt" class="me-2" /> Modos de Pago
      </h1>
      <button
        @click="newPayMode"
        class="btn btn-success d-flex align-items-center"
      >
        <font-awesome-icon icon="plus" class="me-2" />
        Nuevo Modo de Pago
      </button>
    </div>

    <div class="table-responsive shadow rounded">
      <table class="table table-striped table-hover align-middle mb-0">
        <thead class="table-success">
          <tr>
            <th>#</th>
            <th>
              <font-awesome-icon icon="file-signature" class="me-1" />
              Nombre
            </th>
            <th>
              <font-awesome-icon icon="sticky-note" class="me-1" />
              Observación
            </th>
            <th class="text-center">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(payMode, index) in payModes" :key="payMode.id">
            <th scope="row">{{ index + 1 }}</th>
            <td>{{ payMode.name }}</td>
            <td>{{ payMode.observation }}</td>
            <td class="text-center">
              <button
                @click="editPayMode(payMode.id)"
                class="btn btn-sm btn-warning me-2"
                title="Editar Modo de Pago"
              >
                <font-awesome-icon icon="pencil" />
              </button>
              <button
                @click="deletePayMode(payMode.id)"
                class="btn btn-sm btn-danger"
                title="Eliminar Modo de Pago"
              >
                <font-awesome-icon icon="trash" />
              </button>
            </td>
          </tr>
          <tr v-if="payModes.length === 0">
            <td colspan="4" class="text-center py-4 text-muted fst-italic">
              No hay modos de pago registrados.
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
  name: "PayModesList",
  data() {
    return {
      payModes: [],
    };
  },
  methods: {
    fetchPayModes() {
      axios
        .get("http://127.0.0.1:8000/api/pay-modes")
        .then((response) => {
          this.payModes =
            response.data.pay_modes ??
            response.data.payModes ??
            response.data.payModesList ??
            [];
        })
        .catch((error) => {
          console.error("Error fetching pay modes:", error);
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "No se pudieron cargar los modos de pago.",
          });
        });
    },
    deletePayMode(id) {
      Swal.fire({
        title: `¿Deseas eliminar el modo de pago con ID ${id}?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Eliminar",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#d33",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(`http://127.0.0.1:8000/api/pay-modes/${id}`)
            .then((response) => {
              Swal.fire(
                "¡Eliminado!",
                "El modo de pago ha sido eliminado.",
                "success"
              );
              this.payModes =
                response.data.pay_modes ??
                this.payModes.filter((pm) => pm.id !== id);
            })
            .catch((error) => {
              console.error("Error deleting pay mode:", error);
              Swal.fire(
                "Error",
                "No se pudo eliminar el modo de pago.",
                "error"
              );
            });
        }
      });
    },
    editPayMode(id) {
      this.$router.push({ name: "EditarModoPago", params: { id: `${id}` } });
    },
    newPayMode() {
      this.$router.push({ name: "NuevoModoPago" });
    },
  },
  mounted() {
    this.fetchPayModes();
  },
};
</script>

<style scoped>
.table thead th {
  vertical-align: middle;
  text-align: left;
}
.table tbody td {
  vertical-align: middle;
}
</style>
