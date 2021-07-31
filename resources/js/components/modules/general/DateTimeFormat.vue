<template>
    <span class="font-weight-bold">{{moment(this.value).format("DD/MM/YYYY, h:mm:ss")}}</span>
</template>

<script>
import moment from 'moment/moment'
export default {
  props: {
    value: {
      type: String,
      required: true
    }
  },
  data(){
    return{
       moment: moment
    }
  }

};
</script>
<style scoped>
</style>
