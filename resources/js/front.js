/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// faccio il require di vue per tutte le pagine del progetto
window.Vue = require('vue');

// faccio il require di axios per tutte le pagine del progetto
window.axios = require('axios');

import App from './views/App';
import router from './router';

const app = new Vue({
  el: '#app',
  render: h => h(App),
  router
});