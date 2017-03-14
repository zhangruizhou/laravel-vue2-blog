/**
 * Created by zhang on 2017/3/13.
 */
import Vue from 'vue'
import Router from 'vue-router'
import home from '@/components/admin/home'


Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/admin/',
      name: 'home',
      component: home
    }
  ]
})
