<template>
  <el-row type="flex" justify="center" class="container">
    <el-col :span="15">
      <br />
      <el-divider content-position="left">Registro de clientes</el-divider>
      <br />
      <el-form
        :model="ruleForm"
        :rules="rules"
        label-position="top"
        ref="ruleForm"
        class="demo-ruleForm"
      >
        <el-row :gutter="14">
          <el-col :span="12">
            <el-form-item label="Nombre" prop="names">
              <el-input v-model="ruleForm.names"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="12">
            <el-form-item label="Email" prop="email">
              <el-input v-model="ruleForm.email"></el-input>
            </el-form-item>
          </el-col>
        </el-row>
        <el-row :gutter="14">
          <el-col :span="12">
            <el-form-item label="País" prop="country">
              <el-input v-model="ruleForm.country"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="12">
            <el-form-item label="Ciudad" prop="city">
              <el-input v-model="ruleForm.city"></el-input>
            </el-form-item>
          </el-col>
        </el-row>
        <el-divider content-position="right">
          <el-button type="text" @click="showMore = !showMore">ver más</el-button>
        </el-divider>
        <template v-if="showMore">
          <el-row :gutter="14">
            <el-col :span="12">
              <el-form-item label="Celular" prop="phone">
                <el-input v-model="ruleForm.phone"></el-input>
              </el-form-item>
            </el-col>
            <el-col :span="12">
              <el-form-item label="Provincia" prop="province">
                <el-input v-model="ruleForm.province"></el-input>
              </el-form-item>
            </el-col>
          </el-row>
          <el-row :gutter="14">
            <el-col :span="24">
              <el-form-item label="Dirección" prop="address">
                <el-input
                  type="textarea"
                  :autosize="{ minRows: 2, maxRows: 4}"
                  v-model="ruleForm.address"
                ></el-input>
              </el-form-item>
            </el-col>
          </el-row>
        </template>
        <el-form-item>
          <el-button
            :loading="loading"
            type="success"
            @click="submitForm('ruleForm')"
            icon="el-icon-check"
          >Registrar</el-button>
          <el-button @click="resetForm('ruleForm')" icon="el-icon-refresh-left">Resetear</el-button>
        </el-form-item>
      </el-form>
    </el-col>
  </el-row>
</template>
<script>
import axios from "axios";
export default {
  data() {
    var validateEmailUnique = (rule, value, callback) => {
      this.validateEmailUnique(value)
        .then(isUnique => {
          if (!isUnique) {
            callback(new Error("Two inputs don't match!"));
          } else {
            callback();
          }
        })
        .catch(error => {
          console.log(error);
        });
    };
    return {
      loading: false,
      showMore: false,
      ruleForm: {
        names: "",
        email: "",
        country: "",
        city: "",
        province: "",
        phone: "",
        address: "",
        type_people: "client"
      },
      rules: {
        names: [
          {
            required: true,
            message: "Debe escribir un nombre",
            trigger: "blur"
          },
          {
            max: 200,
            message: "La lognitud máxima es 200",
            trigger: "blur"
          }
        ],
        email: [
          {
            required: true,
            message: "Debe escribir un email",
            trigger: "blur"
          },
          {
            max: 200,
            message: "La lognitud máxima es 200",
            trigger: "blur"
          },
          {
            validator: validateEmailUnique,
            message: "El correo ya se encuentra registrado",
            trigger: "blur"
          }
        ],
        country: [
          {
            required: true,
            message: "Debe escribir un país",
            trigger: "blur"
          },
          {
            max: 200,
            message: "La lognitud máxima es 200",
            trigger: "blur"
          }
        ],
        city: [
          {
            required: true,
            message: "Debe escribir una ciudad",
            trigger: "blur"
          },
          {
            max: 200,
            message: "La lognitud máxima es 200",
            trigger: "blur"
          }
        ]
      }
    };
  },
  methods: {
    submitForm(formName) {
      this.loading = true;
      this.$refs[formName].validate(valid => {
        if (valid) {
          axios
            .post("people/save", this.ruleForm)
            .then(response => {
              console.log(response);
              this.$message({
                message: "Registro realizado con éxito.",
                type: "success"
              });
              this.resetForm("ruleForm");
              this.loading = false;
            })
            .catch(error => {
              this.loading = false;
              this.$message.error("Ocurrió un error al intentar registrar.");
              console.log(error);
            });
        } else {
          this.loading = false;
          this.$message.error("Ocurrió un error al intentar registrar.");
          console.log("error submit!!");
          return false;
        }
      });
    },
    resetForm(formName) {
      this.$refs[formName].resetFields();
    },
    validateEmailUnique(email) {
      let isUnique = axios
        .get("global/validateEmailUnique/" + email)
        .then(({ data }) => {
          return data.valid;
        })
        .catch(error => {
          console.log(error);
        });
      return isUnique;
    }
  }
};
</script>

<style lang="css">
html {
  font-family: sans-serif;
  -webkit-text-size-adjust: 100%;
  -ms-text-size-adjust: 100%;
}
</style>