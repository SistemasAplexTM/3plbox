<template>
  <div class="card">
    <div class="header">
      <h2>Usuarios</h2>
    </div>
    <div class="body">
      <table class="table table-bordered table-striped table-hover dataTable" id="tbl-users">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</template>
<script>
$(document).ready(function() {
  var table = $("#tbl-users").DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: "users/all",
    columns: [
      { data: "name", name: "name" },
      { data: "email", name: "email" },
      {
        sortable: false,
        render: function(data, type, full, meta) {
          var params = [full.id, "'" + full.name + "'", "'" + full.email + "'"];
          // var params = { id: full.id, name: full.name, email: full.email };
          return imp_btn(true, full.id, params, "user");
        }
      }
    ]
  });
});

export default {
  data() {
    return {};
  },
  created() {
    let me = this;
    bus.$on("delete", payload => {
      if (payload.type == "user") {
        me.delete(payload.id);
      }
    });
  },
  methods: {
    delete(id) {
      let me = this;
      axios
        .delete("user/" + id)
        .then(response => {
          notifyMesagge("bg-teal", "Registro eliminado con éxito");
          recargarTabla("tbl-users");
        })
        .catch(error => {
          notifyMesagge("bg-red", "Error al intentar eliminar");
        });
    }
  }
};
</script>