<template>
  <div class="article">
    <h1>111</h1>
    <h2>article</h2>
    <ul>
      <li v-for="item in articles" class="food-list food-list-hook">
        <a>{{item.title}}</a>
      </li>
    </ul>
  </div>
</template>

<script>
  export default {
    name: 'article',
    data () {
      return {
        articles: []
      };
    },
    created() {
      const apiUrl = 'http://www.zhangruizhou.com'
      this.$http.get(apiUrl+'/articles').then((response) => {
        response = response.body
        if (response.status_code === 1) {
          this.articles = response.data;
          console.log("ok")
        }
      })
    }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
