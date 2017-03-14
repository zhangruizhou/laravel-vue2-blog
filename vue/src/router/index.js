import Vue from 'vue'
import Router from 'vue-router'
import home from '@/components/front/home'

const Articles = resolve => {
  require.ensure(['../components/front/article/index.vue'], () => {
    resolve(require('../components/front/article/index.vue'))
  })
}
const Article = resolve => {
  require.ensure(['../components/front/article/detail.vue'], () => {
    resolve(require('../components/front/article/detail.vue'))
  })
}
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
      component: Articles
    },
    {
      path: '/article/:id',
      name: 'article',
      component: Article
    }
  ]
})
