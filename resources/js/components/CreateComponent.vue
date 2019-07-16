<template>
  <div>
    <h1>Criar Registro</h1>
    <form @submit.prevent="addRegistro">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Label:</label>
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
        <button class="btn btn-primary">Salvar</button>
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
  methods: {
    addRegistro() {
      let uri = "/api/registro/create";
      this.axios.post(uri, this.registro).then(response => {
        this.$router.push({ name: "show" });
      });
    }
  }
};
</script>