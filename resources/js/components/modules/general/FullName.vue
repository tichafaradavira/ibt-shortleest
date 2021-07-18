<template>
  <span class="font-weight-bold text-capitalize ">{{person.title ? person.title : ""}} {{person.first_name ? person.first_name : ""}} {{person.last_name ? person.last_name :""}}</span>
</template>

<script>
export default {
  props: {
    person: {
      type: Object,
      required: true
    }
  }
};
</script> 
<style scoped>
</style>