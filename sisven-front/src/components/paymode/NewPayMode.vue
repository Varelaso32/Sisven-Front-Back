<template>
  <div class="container text-start">
    <h1 class="text-success fw-bold">Nuevo Modo de Pago</h1>
    <div class="card">
      <div class="card-header bg-success text-white fw-bold">
        Datos del Modo de Pago
      </div>
      <div class="card-body">
        <form @submit.prevent="savePayMode">
          <div class="row mb-3">
            <label for="name" class="form-label">Nombre:</label>
            <div class="input-group">
              <div class="input-group-text bg-success text-white">
                <font-awesome-icon icon="user" />
              </div>
              <input
                type="text"
                class="form-control"
                id="name"
                v-model="payMode.name"
                placeholder="Nombre del modo de pago"
                required
              />
            </div>
          </div>

          <div class="row mb-3">
            <label for="observation" class="form-label">Observación:</label>
            <div class="input-group">
              <div class="input-group-text bg-success text-white">
                <font-awesome-icon icon="envelope" />
              </div>
              <textarea
                class="form-control"
                id="observation"
                v-model="payMode.observation"
                placeholder="Observaciones (opcional)"
                rows="3"
              ></textarea>
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
  name: "NewPayMode",
  data() {
    return {
      payMode: {
        name: "",
        observation: "",
      },
    };
  },
  methods: {
    cancel() {
      this.$router.push({ name: "PayModes" });
    },
    async savePayMode() {
      try {
        const res = await axios.post(
          "http://127.0.0.1:8000/api/pay-modes",
          this.payMode
        );
        if (res.status === 200 || res.status === 201) {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Modo de pago creado correctamente",
            showConfirmButton: false,
            timer: 2000,
          });
          this.$router.push({ name: "PayModes" });
        }
      } catch (error) {
        console.error("Error al crear modo de pago:", error);

        let msg = "No se pudo crear el modo de pago.";
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
