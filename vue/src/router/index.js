import Vue from 'vue'
import Router from 'vue-router'
import home from '@/components/front/home'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'home',
      component: home
    },
    {
      path: '/articles',
      name: 'article',
      component: resolve => require(['../components/front/article/index.vue'], resolve)
    },
    {
      path: '/article/:id',
      name: 'article',
      component: resolve => require(['../components/front/article/detail.vue'], resolve)
    },
    {
      path: '/admin/',
      name: 'admin',
      component: resolve => require(['../components/admin/home.vue'], resolve)
    },
    {
      path: '/admin/login',
      name: 'login',
      component: resolve => require(['../components/admin/login.vue'], resolve)
    }]
})
