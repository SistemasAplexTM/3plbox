<template>
  <el-form
    :model="formTrackingReceipt"
    :rules="rules"
    ref="formTrackingReceipt"
    label-position="top"
  >
    <el-form-item label="Tracking" prop="tracking">
      <el-input v-model="formTrackingReceipt.tracking"></el-input>
    </el-form-item>
    <el-form-item label="Correo" prop="email">
      <el-input v-model="formTrackingReceipt.email"></el-input>
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
      formTrackingReceipt: {
        tracking: "lkasdclaksmndlkna",
        email: "duvierm24@gmail.com"
      },
      rules: {
        tracking: [
          {
            required: true,
            message: "Campo obligatorio",
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