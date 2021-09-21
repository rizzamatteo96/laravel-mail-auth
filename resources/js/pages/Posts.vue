<template>
  <div class="container mt-5">
    
    <!-- inizio container posts -->
    <div class="row row-cols-3 g-4">
      <div class="col mt-4" v-for="post in posts" :key="post.id"> 
        <div class="card text-dark bg-light">
          <div class="card-body">
            <h3 class="card-title">{{post.title}}</h3>
            <p class="card-text">{{sliceText(post.description, 40)}}</p>
            <p class="card-text"><small class="text-muted">{{takeData(post.created_at)}}</small></p>
            <router-link :to="{name: 'post-details', params: { slug : post.slug }}" class="btn btn-outline-dark">Leggi articolo</router-link>
          </div>
        </div>
      </div>
    </div>
    <!-- fine container posts -->

    <!-- inizio navigation -->
    <nav aria-label="Page navigation example" class="mt-5">
      <ul class="pagination">
        <li class="page-item" :class="{'disabled' : actualPage == 1}">
          <button class="page-link" aria-label="Previous" @click="getPosts(actualPage - 1)">
            <span aria-hidden="true">&laquo;</span>
          </button>
        </li>

        <li class="page-item" :class="{'active' : actualPage == i}" v-for="i in lastPage" :key="i">
          <button class="page-link" @click="getPosts(i)" >{{i}}</button>
        </li>

        <li class="page-item" :class="{'disabled' : actualPage == lastPage}">
          <button class="page-link" aria-label="Next" @click="getPosts(actualPage + 1)">
            <span aria-hidden="true">&raquo;</span>
          </button>
        </li>
      </ul>
    </nav>
    <!-- fine navigation -->

  </div>
</template>


<script>
export default {
  name: 'Posts',
  data(){
    return {
      urlApi: 'http://127.0.0.1:8000/api/posts' ,
      posts: [],
      actualPage: 1,
      lastPage: null
    }
  },
  created(){
    this.getPosts(1);
  },
  methods: {
    getPosts(page){
      axios.get(this.urlApi, {
        params: {
          page: page
        }
      })
            .then(response => {
              console.log(response.data);
              this.posts = response.data.results.data;
              this.actualPage = response.data.results.current_page;
              this.lastPage = response.data.results.last_page;
            });
    },
    takeData(date){
      let d = new Date(date);
      let year = d.getFullYear();
      let month = parseInt(d.getMonth() + 1);
      let day = d.getDate();

      if(month < 10){
        month = '0' + month;
      }

      if(day < 10){
        day = '0' + day;
      }

      return day + '/' + month + '/' + year;

    },
    sliceText(text,maxChar){
      if(text.length > maxChar){
        return text.substr(0, maxChar) + '...';
      }
      
      return text;
    }
  }
}
</script>


<style lang="scss" scoped>

</style>