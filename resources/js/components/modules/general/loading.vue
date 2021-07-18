<template>
  <div class="pa-4 ">
     <slot></slot>  <br />
    <span class=" font-weight-bold">{{text}}</span>
    <br />
    <v-spacer></v-spacer>
    <v-progress-circular :size="size" :width="width" :color="color" indeterminate></v-progress-circular>
  </div>
</template>

<script>
export default {
  props: {
    width: {
      type: Number,
      default: 10
    },
    color: {
      type: String,
      default: "#2E86C1"
    },
    size: {
      type: String,
      default: 32
    },
    text: {
      type: String,
      default: "Loading..."
    }
  }
};
</script>
