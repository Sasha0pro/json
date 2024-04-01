<template xmlns:v-bind="http://www.w3.org/1999/xhtml">
  <form>
    <input type="text" placeholder="title" v-model="title"><br><br>
    <textarea placeholder="content" v-model="content"></textarea><br>
    <select v-model="authorId" multiple>
      <option disabled value="">Выберите Автора</option>
      <option v-for="author in authors" v-bind:value="author.id">{{author.username}}</option>
    </select><br><br>
    <button type="button" @click="save()">сохранить</button>
  </form>
</template>

<script>
import axios, {all} from "axios";
export default {
  data() {
    return {
      authors: axios.get('http://127.0.0.1:8000/authors')
          .then(res => (this.authors = res.data.data)),
      authorId: null,
      title: null,
      content: null,
    }
  },
  methods: {
    save() {
      let json = JSON.stringify(this.authorId)
      axios.post(`http://127.0.0.1:8000/registration`,
          {
            password: this.title,
            username: json
          },
          {
            headers: {
              'Content-Type': 'multipart/form-data',
              'Authorization': localStorage.getItem('accessToken')
            }
          })
          .then(res => (this.jsonId = res))
    }
  }
}
</script>

<style>

</style>