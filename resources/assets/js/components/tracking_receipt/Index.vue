<template>
  <div>
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="header">
          <h2>Recibo de tracking</h2>
        </div>
        <div class="body">
          <form-tracking-receipt></form-tracking-receipt>
        </div>
      </div>
    </div>
    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
      <list-tracking-receipt></list-tracking-receipt>
    </div>
  </div>
</template>

<script>
import FormTrackingReceipt from "./Form";
import ListTrackingReceipt from "./List";
export default {
  components: { FormTrackingReceipt, ListTrackingReceipt },
  data() {
    return {};
  },
  methods: {}
};
</script>
