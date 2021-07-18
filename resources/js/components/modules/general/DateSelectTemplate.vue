<template>
    <div>
       <v-menu
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on }">
          <v-text-field
            v-model="dateProperty"
            label="Please Choose Date label"
            prepend-icon="mdi-calendar-month"
            readonly
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker v-model="dateProperty" ></v-date-picker>
      </v-menu>
  </div>
</template>

<script>
</script> 
<style scoped>
</style>