<template>
  <v-app class="" id="auth">
    <v-app-bar   absolute  app color="#FFF" dark>
      <router-link class="text-decoration-none" :to="{name: 'home'}">
      <v-toolbar-title  class="blue--text display-1 font-weight-bold">ShortLeest<sup class=" caption red--text">Beta</sup></v-toolbar-title>
      </router-link>
      <v-spacer></v-spacer>
      <div>
        <v-btn :to="{name:'signin'}" class="mr-2" outlined color="blue">Login</v-btn>
        <v-btn :to="{name:'signup'}" class="mr-2" color="blue">Sign Up</v-btn>
      </div>
    </v-app-bar>
    <router-view></router-view>
    <v-footer class="d-flex justify-center" color="#fff" app>
      <span
          class="blue--text caption">&copy;2021 All rights reserved, Shortleest is the property of IBT technologies</span>
      <div class="text-center ml-4">
        <router-link class="mr-2 caption blue--text" :to="{name: 'privacy-policy'}">Privacy Policy</router-link>
        <router-link class="caption blue--text " :to="{name: 'terms-conditions'}">Terms and conditions</router-link>
      </div>
    </v-footer>
  </v-app>
</template>

<script>
export default {
  mounted() {

  }
};
</script>
<style>
.text-right {
  float: right;
}

.custom_cls {
  display: block;
  width: 100%;
}
</style>

