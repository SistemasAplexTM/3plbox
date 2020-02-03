const Vue = require('vue');
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI);

Vue.component('register', require('./components/Register.vue'));

new Vue({
  el: '#register',
  data: {

  },
  methods: {

  }
});
