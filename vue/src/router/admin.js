/**
 * Created by zhang on 2017/3/13.
 */
const Home = resolve => {
  require.ensure(['../components/admin/home'], () => {
    resolve(require('../components/admin/home'))
  })
}

const routers = {
  path: '/admin',
    component: resolve => require(['../components/admin/home.vue'], resolve),
  children: [
  {
    path: 'login',
    component: resolve => require(['../components/admin/login.vue'], resolve)
  },
  {
    path: 'login',
    component: resolve => require(['../components/admin/login.vue'], resolve)
  },
  {
    path: 'articles',
    component: resolve => require(['../components/admin/article/index'], resolve)
  }
]
}
export default routers
