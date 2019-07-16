<template>
  <div>
    <h1>Editar Registro</h1>
    <form @submit.prevent="updateRegistro">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Label</label>
            <select class="form-control" v-model="registro.label">
              <option>CPF</option>
              <option>CNPJ</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Número:</label>
            <the-mask
              :mask="['###.###.###-##', '##.###.###/####-##']"
              masked
              class="form-control"
              v-model="registro.numero"
            />
          </div>
        </div>
      </div>
      <br />
      <div class="form-group">
        <button class="btn btn-primary">Atualizar</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      registro: {}
    };
  },
  created() {
    let uri = `/api/registro/edit/${this.$route.params.id}`;
    this.axios.get(uri).then(response => {
      this.registro = response.data;
    });
  },
  methods: {
    updateRegistro() {
      let uri = `/api/registro/update/${this.$route.params.id}`;
      this.axios.post(uri, this.registro).then(response => {
        this.$router.push({ name: "show" });
      });
    }
  }
};
</script>