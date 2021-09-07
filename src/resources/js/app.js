import './bootstrap'
import Vue from 'vue'
import FooBar from './components/FooBar'
import Sample from './pages/Sample'
import Sidebar from './components/sidebar'
import HeaderComponent from "./components/HeaderComponent";

Vue.component('foo-bar', require('./components/FooBar.vue').default);
Vue.component('sidebar', require('./components/sidebar.vue').default);
Vue.component('header-component', HeaderComponent);

const app = new Vue({
    el: '#app',
    components: {
      FooBar,
      Sidebar,
    }
  })
