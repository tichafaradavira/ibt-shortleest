<template>
  <div style="display:inline">
    <span class=" font-weight-bold" v-if="value != 0">YES</span>
    <span class=" font-weight-bold" v-if="value == 0">NO</span>
  </div>
</template>

<script>
export default {
  props: {
    value: {
      type: Number,
      required: true
    },
  }
};
</script> 
<style scoped>
</style>