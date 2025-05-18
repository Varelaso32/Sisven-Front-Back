<template>
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="h3 text-primary">
        <font-awesome-icon icon="users" class="me-2" /> Listado de Clientes
      </h1>
      <button
        @click="newCustomer"
        class="btn btn-success d-flex align-items-center"
      >
        <font-awesome-icon icon="plus" class="me-2" />
        Nuevo Cliente
      </button>
    </div>

    <div class="table-responsive shadow-sm rounded">
      <table class="table table-striped table-hover align-middle mb-0">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th><font-awesome-icon icon="id-card" class="me-1" /> Documento</th>
            <th><font-awesome-icon icon="user" class="me-1" /> Nombre</th>
            <th><font-awesome-icon icon="user" class="me-1" /> Apellido</th>
            <th>
              <font-awesome-icon icon="map-marker-alt" class="me-1" /> Dirección
            </th>
            <th>
              <font-awesome-icon icon="calendar" class="me-1" /> Fecha Nac.
            </th>
            <th><font-awesome-icon icon="phone" class="me-1" /> Teléfono</th>
            <th><font-awesome-icon icon="envelope" class="me-1" /> Email</th>
            <th class="text-center">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(customer, index) in customers" :key="customer.id">
            <th scope="row">{{ index + 1 }}</th>
            <td>{{ customer.document_number }}</td>
            <td>{{ customer.first_name }}</td>
            <td>{{ customer.last_name }}</td>
            <td>{{ customer.address }}</td>
            <td>{{ customer.birthday }}</td>
            <td>{{ customer.phone_number }}</td>
            <td>{{ customer.email }}</td>
            <td class="text-center">
              <button
                @click="editCustomer(customer.id)"
                class="btn btn-sm btn-warning me-2"
                title="Editar Cliente"
              >
                <font-awesome-icon icon="pencil" />
              </button>
              <button
                @click="deleteCustomer(customer.id)"
                class="btn btn-sm btn-danger"
                title="Eliminar Cliente"
              >
                <font-awesome-icon icon="trash" />
              </button>
            </td>
          </tr>
          <tr v-if="customers.length === 0">
            <td colspan="9" class="text-center py-4 text-muted">
              No hay clientes registrados.
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
  name: "CustomersList",
  data() {
    return {
      customers: [],
    };
  },
  methods: {
    fetchCustomers() {
      axios
        .get("http://127.0.0.1:8000/api/customers")
        .then((response) => {
          this.customers = response.data.customers;
        })
        .catch((error) => {
          console.error("Error fetching customers:", error);
        });
    },
    deleteCustomer(id) {
      Swal.fire({
        title: `¿Deseas eliminar al cliente con ID ${id}?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Eliminar",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#d33",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(`http://127.0.0.1:8000/api/customers/${id}`)
            .then((response) => {
              Swal.fire(
                "¡Eliminado!",
                "El cliente ha sido eliminado.",
                "success"
              );
              this.customers = response.data.customers;
            })
            .catch((error) => {
              console.error("Error deleting customer:", error);
              Swal.fire("Error", "No se pudo eliminar el cliente.", "error");
            });
        }
      });
    },
    editCustomer(id) {
      this.$router.push({ name: "EditarCliente", params: { id: `${id}` } });
    },
    newCustomer() {
      this.$router.push({ name: "NuevoCliente" });
    },
  },
  mounted() {
    this.fetchCustomers();
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
