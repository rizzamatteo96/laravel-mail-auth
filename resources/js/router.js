import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from './pages/Home';
import Posts from './pages/Posts';
import SinglePost from './pages/SinglePost';
import Contact from './pages/Contact';

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/posts',
      name: 'posts',
      component: Posts
    },
    {
      path: '/post/:slug',
      name: 'post-details',
      component: SinglePost
    },
    {
      path: '/contact',
      name: 'contact',
      component: Contact
    }
  ]
});

export default router;