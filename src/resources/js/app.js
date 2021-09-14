import './bootstrap'
import Vue from 'vue'
import HeaderComponent from "./components/HeaderComponent";
import BodyComponent from "./components/BodyComponent";

Vue.component('header-component', HeaderComponent);
Vue.component('body-component', BodyComponent);

const app = new Vue({
    el: '#app',
    components: {
        HeaderComponent,
        BodyComponent
    }
  })
