<template>
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <router-link :to="{name : 'home'}" class="navbar-brand">Boolpress</router-link>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item" v-for="(link,i) in navLinks" :key="i">
            <router-link :to="{name : link.routeName}" class="nav-link active" aria-current="page"> {{link.label}} </router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
</template>

<script>
export default {
  name: 'Header',
  data(){
    return {
      navLinks: [
        {
          label: 'Home',
          routeName: 'home'
        },
        {
          label: 'Posts',
          routeName: 'posts'
        }
      ]
    }
  }
}
</script>

<style lang="scss" scoped>

</style>