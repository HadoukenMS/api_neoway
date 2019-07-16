<template>
  <div>
    <h1>Registros</h1>
    <div class="row">
      <div class="col-md-10" style="padding-bottom:10px;">
        <div class="form-group">
          <router-link :to="{ name: 'create' }" class="btn btn-primary">Criar Registro</router-link>
        </div>

        <form class="form-inline">
          <div class="form-group" style="margin-right:10px;">
            <label style="margin-right:10px;">Ordernar por:</label>
            <select class="form-control" v-model="configs.orderBy">
              <option value="label">Label</option>
              <option value="numero">Número</option>
            </select>
          </div>

          <div class="form-group" style="margin-right:10px;">
            <label style="margin-right:10px;">Ordem:</label>
            <select class="form-control" v-model="configs.order">
              <option value="asc">Crescente</option>
              <option value="desc">Decrescente</option>
            </select>
          </div>
          <div class="form-group" style="margin-right:10px;">
            <label style="margin-right:10px;">Filtrar:</label>
            <input
              type="text"
              class="form-control"
              v-model="configs.filter"
              placeholder="Filtrar por número"
            />
          </div>
        </form>
      </div>
    </div>
    <table class="table table-sm table-hover table-bordered">
      <thead>
        <tr class="text-center">
          <th>Label</th>
          <th>Número</th>
          <th colspan="3">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr class="text-center" v-for="(registro, index) in list" v-bind:index="index" :key="registro._id">
          <td>{{ registro.label }}</td>
          <td>{{ registro.numero }}</td>
          <td>
            <router-link
              :to="{name: 'edit', params: { id: registro._id }}"
              class="btn btn-primary"
            >Editar</router-link>
          </td>
          <td>
            <button class="btn btn-danger" @click.prevent="deleteRegistro(registro._id, index)">Apagar</button>
          </td>
          <td>
            <button class="btn btn-warning" @click.prevent="addBlacklist(registro._id)">Blacklist</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  data() {
    return {
      regs: [],
      configs: {
        orderBy: "label",
        order: "desc",
        filter: ""
      }
    };
  },
  created() {
    let uri = "/api/registros";
    this.axios.get(uri).then(response => {
      this.regs = response.data.data;
    });
  },
  methods: {
    deleteRegistro(id, index) {
      let uri = `/api/registro/delete/${id}`;
      this.axios.delete(uri).then(response => {
        this.regs.splice(index, 1);
      });
    },
    addBlacklist(id) {
      let uri = `/api/blacklist/create/${id}`;
      this.axios.post(uri).then(response => {
        this.$router.push({ name: "blacklist" });
      });
    }
  },
  computed: {
    list() {
      const filter = this.configs.filter;
      const list = _.orderBy(
        this.regs,
        this.configs.orderBy,
        this.configs.order
      );

      if (_.isEmpty(filter)) {
        return list;
      }
      return _.filter(list, registro => registro.numero.indexOf(filter) >= 0);
    }
  }
};
</script>
