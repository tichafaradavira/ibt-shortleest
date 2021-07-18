<template>
  <v-card class="pa-2" flat>
    <v-card-title class=" blue-grey--text">Vacancy Details
      <v-btn small v-if="vacancy" class="white--text blue ma-2" :to="{name:'vacancy-form',params:{id:vacancy.id}}">
        <v-icon>
          mdi-pencil
        </v-icon>
        Edit
      </v-btn>
    </v-card-title>
    <v-divider/>
    <div class="pa-2">
      <p><span class="body-2 text--secondary">Vacancy reference</span><br> <span
          class="font-weight-bold">{{ vacancy.reference }}</span></p>
      <p><span class="body-2 text--secondary">Status</span><br> <span
          class="font-weight-bold">{{ vacancy.vacancy_status }}</span></p>
      <p><span class="body-2 text--secondary">Available From </span><br><span
          class="font-weight-bold">{{ vacancy.available_from }}</span></p>

      <div>
        <span class="body-2 text--secondary">Link</span><br>
        <span class="body-2 red--text">(Copy the link  and send it to your prospective tenants)</span><br>
        <v-alert
            outlined
            text
            success
        >
          <p class="green--text" v-if="show">Copied to clipboard!</p>
          <a class="text-decoration-none" target="_blank" :href="vacancy.link"> Vacancy Link </a>
          <v-btn plain class="green--text font-weight-bold" @click="()=>copySomething(vacancy.link)">Copy</v-btn>
        </v-alert>
      </div>
    </div>
    <v-card-actions>

    </v-card-actions>
  </v-card>
</template>
<script>
import DateFormat from "../../general/DateFormat";

export default {
  components: {DateFormat},
  data() {
    return {
      show: false
    };
  },
  props: {
    vacancy: {
      type: Object,
      required: true
    },
    name: {
      type: String,
      default: "vacancy"
    }
  },
  methods: {
    async copySomething(text) {
      try {
        await navigator.clipboard.writeText(text);
        this.show = true;
        setTimeout(this.toggleCopied, 3000)
      } catch (err) {
        this.show = false;
      }
    },
    toggleCopied() {
      this.show = false;
    }
  }
};
</script>


