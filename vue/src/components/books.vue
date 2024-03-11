<template>
  <div>
    <router-link to="/main">main</router-link>
    <br>
    <router-link to="/create">create book</router-link>
  </div>
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

      <button class="card__add" @click="$router.push(`/book/${book.id}/content`)">прочитать</button>
      <button class="delete" @click="deleteBook(book.id)">удалить</button>
      <button class="edit" @click="$router.push(`/book/${book.id}/update`)">редактировать</button>
    </div>
  </div>
    <button v-for="i in numPages" @click="page(i)">{{i}}</button>
</template>

<script>
import axios, {formToJSON} from "axios";
export default {
  data(){
    return {
      numPages: axios.get('http://127.0.0.1:8000/books',
          {
            headers: {
              'Authorization': localStorage.getItem('accessToken')
            }
          }
      )
          .then(res => {
            this.books = res.data.data
            this.numPages = res.data.numPages
          }),
      books: null,
    }
  },
  methods: {
    page(page) {
      axios.get(`http://127.0.0.1:8000/books?page=${page}`,
          {
            headers: {
              'Authorization': localStorage.getItem('accessToken')
            }
          }
      )
          .then(res => {
            this.books = res.data.data
          })
    },

   deleteBook(id) {
      axios.delete(`http://127.0.0.1:8000/book/${id}/delete`,
          {
            headers: {
              'Authorization': localStorage.getItem('accessToken')
            }
          })

       axios.get('http://127.0.0.1:8000/books',
         {
           headers: {
             'Authorization': localStorage.getItem('accessToken')
           }
         }
     )
         .then(res => {
           this.books = res.data.data
           this.numPages = res.data.numPages
         })

    }
  }
}
</script>

<style scoped>
.card {
  float: left;
  margin-left: 100px;
}
.delete {
  background-color: white;
  border: red 1px solid;
  color: red;
  border-radius: 5px;
}
.edit {
  background-color: white;
  border: cadetblue 1px solid;
  color: cadetblue;
  border-radius: 5px;
}
</style>