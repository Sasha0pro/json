<template>
  <router-view></router-view>
</template>

<script>
import formRegistration from "./components/formRegistration.vue"
import formAuthentication from "@/components/formAuthentication.vue";
export default {
  components: {
    formRegistration,
    formAuthentication,
  },
  data(){
    return {
      form: 'formRegistration' ,
      result: localStorage.getItem('accessToken')
    }
  },
  methods: {
    click() {
      alert(this.result)
    }
  },

}
</script>

<style scoped>

</style>
