import {createRouter, createWebHistory} from "vue-router";
import formAuthentication from "@/components/formAuthentication.vue";
import formRegistration from "@/components/formRegistration.vue";
import books from '@/components/books.vue'
import main from '@/components/main.vue'
import content from '@/components/content.vue'
import create from '@/components/create.vue'
import update from "@/components/update.vue";
import array from "@/components/array.vue"

export default createRouter({
    history: createWebHistory(),
    routes: [{
        path: '/',
        component: formAuthentication
    },
        {
            path: '/registration',
            component: formRegistration
        },
        {
            path: '/books',
            component: books
        },
        {
            path: '/main',
            component: main
        },
        {
            path: '/book/:id(\\d+)/content',
            component: content
        },
        {
            path: '/create',
            component: create
        },
        {
            path: '/book/:id(\\d+)/update',
            component: update
        },
        {
            path: '/array',
            component: array
        }
    ]
})