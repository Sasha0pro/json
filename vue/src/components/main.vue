<template>
  <router-link to="/books">my books</router-link>
  <form>
    <input type="text" v-model="author" placeholder="author">
    <input type="text" v-model="title" placeholder="title">
    <button type="button" @click="search()">найти</button>
  </form>
  <!-- Карточка товара -->
  <div class="card" v-for="book in books">
    <!-- Верхняя часть -->
    <div class="card__top">
      <!-- Изображение-ссылка товара -->
      <a href="#" class="card__image">
        <img
            src="https://i.pinimg.com/236x/29/e9/0f/29e90fbcac66748657516eb12f85832c.jpg"

         alt=""/>
      </a>
    </div>
    <div class="card__bottom">
      <div class="card__prices">
        <div class="card__price card__price--common" v-for="username in book.users">{{username.username}}</div>
      </div>
      <p class="card__title">
        {{book.title}}
      </p>

      <button class="card__add" @click="read(book)">прочитать</button>
    </div>
  </div>



</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      json: axios.get(`http://127.0.0.1:8000/main`)
          .then(res => {
            this.books = res.data.data
          }),
      books: [],
      author: null,
      title: null
    }
  },
  methods: {
    search() {
      if (this.author !== null && this.title !== null) {
        this.json = axios.get(`http://127.0.0.1:8000/main?author=${this.author}&title=${this.title}`)
            .then(res => {
              this.books = res.data.data
            })
      }
     else if (this.author !== null) {
        this.json = axios.get(`http://127.0.0.1:8000/main?author=${this.author}`)
            .then(res => {
              this.books = res.data.data
            })
      }

     else if (this.title !== null) {
        this.json = axios.get(`http://127.0.0.1:8000/main?title=${this.title}`,
            {
              headers: {
                'Authorization': localStorage.getItem('accessToken')
              }
            })
      }
    },

    read(book) {
      window.location.href = `/book/${book.id}/content`
    }
  }
}
</script>

<style scoped>
.card {
float: left;
  margin-left: 100px;
  margin-top: 20px;
}
</style>