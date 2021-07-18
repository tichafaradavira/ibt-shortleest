<template>
  <v-dialog v-model="dialog" max-width="290">
    <v-card>
      <v-card-title class="headline">Please Confirm</v-card-title>

      <v-card-text>{{text}}</v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>

        <v-btn class="font-weight-bold" color="red darken-1 " text @click="()=>processResponse('true')">Yes</v-btn>

        <v-btn color="green darken-1 " text @click="()=>processResponse('false')">Cancel</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: {
    dialog: {
      type: Boolean,
      default: false
    },
    text: {
      type: String,
      default: "Are you sure you wand to proceed?"
    }
  },
  methods: {
    processResponse(dialog, response) {
      this.closeDialog(dialog, response);
    },
    closeDialog(dialog, response) {
      this.$emit("update-dialog", dialog, response);
    }
  }
};
</script> 
<style scoped>
</style>