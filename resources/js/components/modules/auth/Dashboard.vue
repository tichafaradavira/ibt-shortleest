<template>
  <div class="card text-left">
    {{name}}
  </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      name:"",
      place :""
    }
  },
  computed: {},
  methods: {
    logout()
    {
this.$store.dispatch('logout');
    },
    loadResults() {
      this.loading = true;
      let token = localStorage.getItem("token");
      console.log(token);
      axios
        .get(
          "http://127.0.0.1:8080/api/user/dashboard",
          {
            headers: { Authorization: `Bearer ${token}` }
          }
        )
        .then(response => {
          console.log(response.data);
          this.name = response.data.name;
          this.place = response.data.place;

        });
    }
  },

  created() {
    let token = localStorage.getItem("token");
    if(!token)
    {
      this.$router.push('/signin');
    }
    this.loadResults();
    /**
     * GET
     * This is an Axios get Http call.
     */
    // axios.get("http://127.0.0.1:8080/api/admin/clients").then(response => {
    //   this.pagination = response.data;
    //   this.clients = response.data.data;
    //   this.loading = false;
    //   console.log(response.data.data);
    //   // return response;
    // }
    // );
  }
  //   this.$http
  //     .get("http://localhost:8000/admin/clients")
  //     .then(response => {
  //       return response;
  //     })
  //     .then(data => {
  //       console.log(data);
  //       this.clients = JSON.parse(data.bodyText);
  //     });
  // }
};
</script>

