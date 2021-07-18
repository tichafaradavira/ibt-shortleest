<template>
  <div class="pa-4 ">
    <span class=" font-weight-bold">Sending Mail</span>
       <v-progress-linear
              :active="loading"
              indeterminate
              absolute
              bottom
              striped
              height = "15"
              color="green"
            ></v-progress-linear>
    <br />
       <v-icon color="indigo" size="60">mdi-email-send</v-icon>
    <v-spacer></v-spacer>
    <!-- <v-progress-circular :size="size" :width="width" :color="color" indeterminate></v-progress-circular> -->
  </div>
</template>

<script>
export default {
  props: {
    width: {
      type: Number,
      default: 5
    },
    color: {
      type: String,
      default: "blue"
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