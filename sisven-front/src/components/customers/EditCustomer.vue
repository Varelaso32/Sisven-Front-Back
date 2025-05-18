<template>
  <div class="container text-start">
    <h1 class="text-primary fw-bold">Editar Cliente</h1>
    <div class="card">
      <div class="card-header fw-bold">Datos del Cliente</div>
      <div class="card-body">
        <form  @submit.prevent="updateCustomer">
          <div class="row mb-3">
            <label for="document_number" class="form-label">Documento:</label>
            <div class="input-group">
              <div class="input-group-text">
                <font-awesome-icon icon="id-card" />
              </div>
              <input
                type="text"
                class="form-control"
                id="document_number"
                v-model="customer.document_number"
                disabled
              />
            </div>
          </div>

          <div class="row mb-3">
            <label for="first_name" class="form-label">Nombre:</label>
            <div class="input-group">
              <div class="input-group-text">
                <font-awesome-icon icon="user" />
              </div>
              <input
                type="text"
                class="form-control"
                id="first_name"
                v-model="customer.first_name"
              />
            </div>
          </div>

          <div class="row mb-3">
            <label for="last_name" class="form-label">Apellido:</label>
            <div class="input-group">
              <div class="input-group-text">
                <font-awesome-icon icon="user" />
              </div>
              <input
                type="text"
                class="form-control"
                id="last_name"
                v-model="customer.last_name"
              />
            </div>
          </div>

          <div class="row mb-3">
            <label for="address" class="form-label">Dirección:</label>
            <div class="input-group">
              <div class="input-group-text">
                <font-awesome-icon icon="map-marker-alt" />
              </div>
              <input
                type="text"
                class="form-control"
                id="address"
                v-model="customer.address"
              />
            </div>
          </div>

          <div class="row mb-3">
            <label for="birthday" class="form-label"
              >Fecha de Nacimiento:</label
            >
            <div class="input-group">
              <div class="input-group-text">
                <font-awesome-icon icon="calendar" />
              </div>
              <input
                type="date"
                class="form-control"
                id="birthday"
                v-model="customer.birthday"
              />
            </div>
          </div>

          <div class="row mb-3">
            <label for="phone_number" class="form-label">Teléfono:</label>
            <div class="input-group">
              <div class="input-group-text">
                <font-awesome-icon icon="phone" />
              </div>
              <input
                type="text"
                class="form-control"
                id="phone_number"
                v-model="customer.phone_number"
              />
            </div>
          </div>

          <div class="row mb-3">
            <label for="email" class="form-label">Email:</label>
            <div class="input-group">
              <div class="input-group-text">
                <font-awesome-icon icon="envelope" />
              </div>
              <input
                type="email"
                class="form-control"
                id="email"
                v-model="customer.email"
              />
            </div>
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
  name: "EditarCliente",
  data() {
    return {
      customer: {
        id: null,
        document_number: '',
        first_name: '',
        last_name: '',
        address: '',
        birthday: '',
        phone_number: '',
        email: '',
      },
    };
  },
  methods: {
    cancel() {
      this.$router.push({ name: "Customers" });
    },
    async updateCustomer() {
      try {
        const res = await axios.put(
          `http://127.0.0.1:8000/api/customers/${this.customer.id}`,
          this.customer
        );
        if (res.status === 200) {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Cliente actualizado correctamente",
            showConfirmButton: false,
            timer: 2000,
          });
          this.$router.push({ name: "Customers" });
        }
      } catch (error) {
        console.error("Error al actualizar cliente:", error);
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "No se pudo actualizar el cliente.",
        });
      }
    },
  },
  mounted() {
    const id = this.$route.params.id;
    axios
      .get(`http://127.0.0.1:8000/api/customers/${id}`)
      .then((response) => {
        this.customer = response.data.customers;
      })
      .catch((error) => {
        console.error("Error al obtener el cliente:", error);
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "No se pudo cargar la información del cliente.",
        });
      });
  },
};
</script>
