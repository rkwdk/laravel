import './bootstrap'
import Vue from 'vue'
import MainComponent from "./components/MainComponent";
import MyCanvas from './components/MyCanvas.vue'

Vue.component('main-component', MainComponent);

const app = new Vue({
    el: '#app',
    components: {
        MainComponent,
        MyCanvas
    }
  })
