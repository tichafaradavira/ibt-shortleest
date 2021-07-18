<template>
  <v-card class="pa-2" flat>
    <v-card-title class=" blue-grey--text">Living expenses</v-card-title>
    <v-divider/>
    <div class="pa-2">
      <p v-for="(expense,index) in application.expenses" :key="index">{{expense.expense}}: <span class="font-weight-bold black--text">${{expense.cost}}</span></p>
    </div>
  </v-card>
</template>
<script>

export default {
  data() {
    return {};
  },
  props: {
    application: {
      type: Object,
      required: true
    },

    name: {
      type: String,
      default: "Reference"
    }
  },
  computed:{
    expenses : function ()
    {
      return Object.keys(this.application.expenses)

    }
  },
};
</script>


