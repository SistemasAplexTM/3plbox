<template>
  <div>
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
      <form-user></form-user>
    </div>
    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
      <list-user></list-user>
    </div>
  </div>
</template>

<script>
import FormUser from "./Form";
import ListUser from "./List";
export default {
  components: { FormUser, ListUser },
  data() {
    return {};
  },
  methods: {}
};
</script>
