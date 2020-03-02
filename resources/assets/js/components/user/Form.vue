<template>
  <div class="card">
    <div class="header">
      <h2>Registrar usuario</h2>
    </div>
    <div class="body">
      <el-form :model="form" :rules="rules" ref="form" label-position="top">
        <el-form-item label="Nombre completo" prop="name">
          <el-input v-model="form.name" prefix-icon="el-icon-user"></el-input>
        </el-form-item>
        <el-form-item label="Email" prop="email">
          <el-input type="email" v-model="form.email" prefix-icon="el-icon-message"></el-input>
        </el-form-item>
        <el-form-item label="Contraseña" prop="password">
          <el-input type="password" v-model="form.password" prefix-icon="el-icon-key"></el-input>
        </el-form-item>
        <el-form-item label="Confirmar Contraseña" prop="password_confirm">
          <el-input type="password" v-model="form.password_confirm" prefix-icon="el-icon-key"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button
            v-if="!editing"
            type="primary"
            @click="submitForm(false)"
            icon="el-icon-check"
          >Registrar</el-button>
          <el-button v-else type="primary" @click="submitForm(true)" icon="el-icon-check">Actualizar</el-button>
          <el-button @click="resetFields()" icon="el-icon-refresh">Resetear</el-button>
        </el-form-item>
      </el-form>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    var confirmPass = (rule, value, callback) => {
      if (value !== this.form.password) {
        callback(new Error("Two inputs don't match!"));
      } else {
        callback();
      }
    };
    return {
      form: {
        name: "",
        email: "",
        password: "",
        password_confirm: ""
      },
      editing: false,
      rules: {
        name: [
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
        ],
        password: [
          {
            required: true,
            message: "Campo obligatorio",
            trigger: "blur"
          }
        ],
        password_confirm: [
          {
            required: true,
            message: "Campo obligatorio",
            trigger: "blur"
          },
          {
            validator: confirmPass,
            message: "La contraseña no coincide",
            trigger: "blur"
          }
        ]
      }
    };
  },
  created() {
    let me = this;
    bus.$on("edit", payload => {
      console.log("edit ", payload);
    });
  },
  methods: {
    submitForm(edit) {
      this.$refs["form"].validate(async valid => {
        if (valid) {
          if (edit) {
            await this.update();
          } else {
            await this.store();
          }
          this.resetForm();
          recargarTabla("tbl-users");
        }
      });
    },
    store() {
      let me = this;
      axios
        .post("users", me.form)
        .then(response => {
          notifyMesagge("bg-teal", "Registrado con éxito");
        })
        .catch(error => {
          alert(error);
        });
    },
    update() {
      let me = this;
      axios
        .put("users/" + this.id, me.form)
        .then(response => {
          notifyMesagge("bg-teal", "Actualizado con éxito");
        })
        .catch(error => {
          alert(error);
        });
    },
    edit(data) {
      this.id = data["id"];
      this.name = data["name"];
      (this.email = data["email"]), (this.editing = true);
    },
    resetFields() {
      this.$refs["form"].resetFields();
    },
    resetForm() {
      this.form = {
        name: "",
        email: "",
        password: "",
        password_confirm: ""
      };
      this.editing = false;
    },
    cancel() {
      this.resetForm();
      this.editing = false;
      // this.$validator.reset();
    }
  }
};
</script>