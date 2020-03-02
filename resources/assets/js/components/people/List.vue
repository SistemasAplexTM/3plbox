<template>
  <div>
    <div class="card">
      <div class="header">
        <h2>Clientes</h2>
      </div>
      <div class="body">
        <table class="table table-bordered table-striped table-hover" id="tbl-people">
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
  </div>
</template>
<script>
$(document).ready(function() {
  var table = $("#tbl-people").DataTable({
    // processing: true,
    // serverSide: true,
    // responsive: true,
    ajax: "all",
    columns: [
      { data: "names", name: "names" },
      { data: "email", name: "email" },
      {
        sortable: false,
        render: function(data, type, full, meta) {
          var params = [
            full.id,
            "'" + full.names + "'",
            "'" + full.email + "'",
            "'" + full.phone + "'",
            "'" + full.country + "'",
            "'" + full.city + "'",
            "'" + full.province + "'",
            "'" + full.address + "'"
          ];
          return imp_btn(true, full.id, params, "people");
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
    // bus.$on("updateList", table => {
    //   recargarTabla2(table);
    //   notifyMesagge("bg-teal", "Registro creado con éxito");
    //   console.log("RECARGANDO TABLA");
    // });
    bus.$on("delete", payload => {
      if (payload.type == "people") {
        me.delete(payload.id);
      }
    });
  },
  methods: {
    delete(id) {
      let me = this;
      axios
        .delete(id)
        .then(response => {
          notifyMesagge("bg-teal", "Registro eliminado con éxito");
          recargarTabla2("tbl-people");
        })
        .catch(error => {
          console.log(error);
          notifyMesagge("bg-red", "Error al intentar eliminar");
        });
    }
  }
};
</script>