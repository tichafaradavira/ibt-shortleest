<template>
  <v-snackbar
    :value="snackbar"
    :bottom="y === 'bottom'"
    color="green"
    :left="x === 'left'"
    :multi-line="mode === 'multi-line'"
    :right="x === 'right'"
    :timeout="5000"
    :top="y === 'top'"
    :vertical="mode === 'vertical'"
    @input="closeSnackbar"
  >
    {{ text }}
    <v-btn dark text @click="closeSnackbar">Close</v-btn>
  </v-snackbar>
</template>

<script>
export default {
  props: {
    snackbar: {
      type: Boolean,
      default: false
    },
     text: {
      type: String,
      default: 'Please add some text.'
    }
  },
  data() {
    return {
      color: "",
      mode: "",
      timeout: 6000,
      x: null,
      y: "top"
    };
  },
  methods: {
    closeSnackbar(snackbar) {
      this.$emit("update-snackbar", snackbar);
    }
  }
};
</script> 
<style scoped>
</style>