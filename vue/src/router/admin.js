/**
 * Created by zhang on 2017/3/13.
 */
const Home = resolve => {
  require.ensure(['../components/admin/home'], () => {
    resolve(require('../components/admin/home'))
  })
}

const routers = [{
  path: '/admin',
  name: 'home',
  component: Home
},{
  path: '/admin/login',
  name: 'login',
  component: Home
}]
export default routers
