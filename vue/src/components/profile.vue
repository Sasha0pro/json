<script>
export default {
  name: "profile",
  data(){
    return {
      id: false,
    }
  },
  methods: {
    click() {
      if (this.id === false) {
        this.id = true
      }
      else {
        this.id = false
      }
    }
  }
}
</script>

<template>
<img src="https://cdn.icon-icons.com/icons2/1904/PNG/512/profile_121261.png" @click="click()">
  <div class="main" v-show="id">

  </div>
</template>

<style scoped>
img {
  width: 20px;
  height: 20px;
  position: fixed;
}
.main {
  width: 300px;
  height: 100vh;
  background-color: snow;
  border: #adadad 1px solid;
  border-radius: 10px;
  margin-top: 20px;
  position: fixed;
}

</style>