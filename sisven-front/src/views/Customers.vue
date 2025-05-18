<template>
  <div class="container">
    <h1>Listado Clientes</h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Documento</th>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido</th>
          <th scope="col">Dirección</th>
          <th scope="col">Fecha de Nacimiento</th>
          <th scope="col">Teléfono</th>
          <th scope="col">Email</th>
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
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "CustomersList",
  data() {
    return {
      customers: [],
    };
  },
  mounted() {
    axios
      .get("http://127.0.0.1:8000/api/customers")
      .then((response) => {
        this.customers = response.data.customers;
      })
      .catch((error) => {
        console.error("Error fetching customers:", error);
      });
  },
};
</script>
