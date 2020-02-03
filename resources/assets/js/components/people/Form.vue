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
      <el-button type="primary" @click="submitForm()" icon="el-icon-save">Create</el-button>
      <el-button @click="resetForm()">Limpiar</el-button>
    </el-form-item>
  </el-form>
</template>
<script>
export default {
  data() {
    return {
      formPeople: {
        names: "Duvier Marin Escobar",
        email: "duvierm24@gmail.com",
        phone: "3122414492",
        address: "Manzana 4 Casa 14. Barrio Villamarina",
        country: "Colombia",
        city: "Pradera",
        province: "Valle del Cauca"
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
      console.log("Editar persona: ", id);
    });
  },
  methods: {
    edit: function(data) {
      this.formPeople = data;
      this.editing = true;
    },
    async save() {
      let result = await axios.post("save", this.formPeople);
      return result.data.code === 200 ? true : false;
    },
    submitForm() {
      this.$refs["formPeople"].validate(valid => {
        if (valid) {
          let response = this.save();
          if (response) {
            this.resetForm();
            setTimeout(() => {
              bus.$emit("updateListPeople");
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