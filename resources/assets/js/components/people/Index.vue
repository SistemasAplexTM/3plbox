<template>
  <div>
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="header">
          <h2>Registrar clientes</h2>
        </div>
        <div class="body">
          <form-people></form-people>
        </div>
      </div>
    </div>
    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
      <list-people></list-people>
    </div>
  </div>
</template>

<script>
import FormPeople from "./Form";
import ListPeople from "./List";
export default {
  components: { FormPeople, ListPeople },
  data() {
    return {};
  },
  methods: {}
};
</script>
