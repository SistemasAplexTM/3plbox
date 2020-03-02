<template>
  <div>
    <div class="card">
      <div class="header">
        <h2>Clientes</h2>
      </div>
      <div class="body">
        <table
          class="table table-bordered table-striped table-hover dataTable"
          id="tbl-tracking_receipt"
        >
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
  var table = $("#tbl-tracking_receipt").DataTable({
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
          var params = [full.id, "'" + full.name + "'", "'" + full.email + "'"];
          return imp_btn(true, full.id, params, true);
        }
      }
    ]
  });
});

function edit(id, name, email) {
  var data = {
    id: id,
    name: name,
    email: email
  };
  bus.$emit("edittracking_receipt", data);
}

export default {
  data() {
    return {};
  },
  created() {
    let me = this;
    bus.$on("updateListtracking_receipt", function() {
      recargarTabla2("tbl-tracking_receipt");
      notifyMesagge("bg-teal", "Registro creado con éxito");
      console.log("RECARGANDO TABLA");
    });
    bus.$on("deletetracking_receipt", function(id) {
      me.delete(id);
    });
  },
  methods: {
    delete: function(id) {
      let me = this;
      axios
        .delete(id)
        .then(function(response) {
          notifyMesagge("bg-teal", "Registro eliminado con éxito");
          recargarTabla2("tbl-tracking_receipt");
        })
        .catch(function(error) {
          console.log(error);
          notifyMesagge("bg-red", "Error");
        });
    }
  }
};
</script>