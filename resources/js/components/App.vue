<template>
  <v-app id="app" class="ma0 pa0"  >
    <router-view></router-view>
  </v-app>
</template>

<script>


export default {
  name: "App",
  data() {
    return {};
  },
  components: {
  },
  methods: {},
  created () {
    document.title = "ShortLeest";
  }
};
</script>

<style>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

</style>
