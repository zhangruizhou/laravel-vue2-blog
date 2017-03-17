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
      path: '/admin',
      component: resolve => require(['../components/admin/home'], resolve),
      children: [
        {
          path: 'login',
          component: resolve => require(['../components/admin/login'], resolve)
        },
        {
          path: 'article',
          component: resolve => require(['../components/admin/article/index'], resolve)
        },
        {
          path: 'article/add',
          component: resolve => require(['../components/admin/article/add'], resolve)
        },
        {
          path: 'article/:id/edit',
          component: resolve => require(['../components/admin/article/edit'], resolve)
        }
      ]
    }
    ]
})
