<template>
  <div>
    <div class="card">
      <div class="header">
        <h2>Clientes</h2>
      </div>
      <div class="body">
        <table class="table table-bordered table-striped table-hover dataTable" id="tbl-people">
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
  bus.$emit("editPeople", data);
}

export default {
  data() {
    return {};
  },
  created() {
    let me = this;
    bus.$on("updateListPeople", function() {
      recargarTabla2("tbl-people");
      console.log("RECARGANDO TABLA");
    });
    bus.$on("deletePeople", function(id) {
      me.delete(id);
      console.log("Eliminar persona: ", id);
    });
  },
  methods: {
    delete: function(id) {
      let me = this;
      axios
        .delete(id)
        .then(function(response) {
          notifyMesagge("bg-teal", "Registro eliminado con éxito");
          recargarTabla2("tbl-people");
        })
        .catch(function(error) {
          console.log(error);
          notifyMesagge("bg-red", "Error");
        });
    }
  }
};
</script>