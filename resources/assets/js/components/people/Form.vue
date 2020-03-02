<template>
  <el-form :model="formPeople" :rules="rules" ref="formPeople" label-position="top">
    <el-form-item label="Nombre" prop="names">
      <el-input v-model="formPeople.names"></el-input>
    </el-form-item>
    <el-form-item label="Correo" prop="email">
      <el-input v-model="formPeople.email"></el-input>
    </el-form-item>
    <el-form-item label="Celular" prop="phone">
      <el-input v-model="formPeople.phone"></el-input>
    </el-form-item>
    <el-form-item label="País" prop="country">
      <el-input v-model="formPeople.country"></el-input>
    </el-form-item>
    <el-form-item label="Ciudad" prop="city">
      <el-input v-model="formPeople.city"></el-input>
    </el-form-item>
    <el-form-item label="Provincia" prop="province">
      <el-input v-model="formPeople.province"></el-input>
    </el-form-item>
    <el-form-item label="Dirección" prop="address">
      <el-input type="textarea" v-model="formPeople.address"></el-input>
    </el-form-item>
    <el-form-item>
      <el-button v-if="!editing" type="primary" @click="submitForm()" icon="el-icon-check">Registrar</el-button>
      <el-button v-else type="primary" @click="submitForm()" icon="el-icon-check">Actualizar</el-button>
      <el-button @click="resetForm()" icon="el-icon-refresh">Resetear</el-button>
    </el-form-item>
  </el-form>
</template>
<script>
export default {
  data() {
    return {
      editing: false,
      formPeople: {
        names: "",
        email: "",
        phone: "",
        address: "",
        country: "",
        city: "",
        province: ""
      },
      rules: {
        names: [
          {
            required: true,
            message: "Campo obligatorio",
            trigger: "blur"
          }
        ],
        email: [
          {
            required: true,
            message: "Campo obligatorio",
            trigger: "blur"
          },
          {
            type: "email",
            message: "Correo inválido",
            trigger: "blur"
          }
        ]
      }
    };
  },
  created() {
    let me = this;
    bus.$on("editPeople", function(params) {
      me.edit(params);
    });
  },
  methods: {
    edit: function(data) {
      this.formPeople = data;
      this.editing = true;
    },
    async save() {
      let result = await axios.post("save", this.formPeople);
      notifyMesagge("bg-teal", "Registrado con éxito");
      return result.data.code === 200 ? true : false;
    },
    async update() {
      let id = this.formPeople.id;
      let result = await axios.post("update/" + id, this.formPeople);
      this.editing = false;
      return result.data.code === 200 ? true : false;
    },
    submitForm() {
      this.$refs["formPeople"].validate(valid => {
        if (valid) {
          let response = null;
          if (this.editing) {
            console.log("update: ", this.editing);
            response = this.update();
          } else {
            console.log("save: ", this.editing);
            response = this.save();
          }

          if (response) {
            let me = this;
            setTimeout(() => {
              me.resetForm();
              recargarTabla2("tbl-people");
              // bus.$emit("updateList", "tbl-people");
            }, 500);
          }
        } else {
          console.log("error submit!!");
          return false;
        }
      });
    },
    resetForm() {
      this.$refs["formPeople"].resetFields();
    }
  }
};
</script>