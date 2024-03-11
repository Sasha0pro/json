<template>
  <div class="main">
    <div class="title">
      {{book.title}}
    </div>
    <div class="content">
    {{book.content}}
    </div>
    <router-link to="/main">exit</router-link>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data(){
    return {
      book: axios.get(`http://127.0.0.1:8000/book/${this.$route.params.id}/content`)
          .then(res => (this.book = res.data.data)),
    }
  },

  }
</script>

<style scoped>
  .main {
    height: 700px;
    width: 500px;
    background-color: blanchedalmond;
  }
  .content {
    margin-top: 50px;
  }
</style>