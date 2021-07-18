<template>
  <div>
    <span v-if="owing" class="green--text darken-2 font-weight-bold">-</span>
    <span class="green--text darken-2 font-weight-bold ">{{currency.code}}</span>
    <span class="green--text darken-2 font-weight-bold " v-html="currency.symbol" />
    <span v-if="!owing" class="font-weight-bold">{{amount}}</span>
    <span v-if="owing" class="red--text font-weight-bold">{{amount}}</span>
  </div>
</template>
</template>

<script>
export default {
  props: {
    amount: {
      type: Number,
      required: true
    },
    currency: {
      type: Object,
      required: true
    },
    owing: {
      type: Boolean,
      default: false
    }
  }
};
</script> 
<style scoped>
</style>