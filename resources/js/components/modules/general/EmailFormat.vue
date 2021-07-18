<template>
<span ><a  class="font-weight-bold" :href="'mailto:'+ email">{{email}}</a></span>

</template>

<script>
export default {
    props:{
        email :{
            type: String,
            default: "provide@email.please"
        }
    }
 
};
</script> 
<style scoped>

</style>