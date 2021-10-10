<template>
  <div class="example">
    <MyCanvas :N="N" :left="validateLeft" :top="validateTop" :right="right" :under="under" :height="height" :width="width"/>
    <p>
        Left:
        <button v-on:click="subtract('left')">-</button>
        <input type="range" min=-2 max=2 :step="step" v-model.number="left">
        <button v-on:click="add('left')">+</button>
        {{left.toPrecision(3)}}
        Top:<input type="range" min=-2 max=2 :step="step" v-model.number="top">{{top.toPrecision(3)}}
        N:<input type="range" min=10 max=100 step=10 v-model.number="N">{{N.toFixed(3)}}
    </p>
    <p>
        Right:<input type="range" min=-2 max=2 :step="step" v-model.number="right">{{right.toPrecision(3)}}
        Under:<input type="range" min=-2 max=2 :step="step" v-model.number="under">{{under.toPrecision(3)}}
    </p>
  </div>
</template>
<script>
// キャンバス用コンポーネントの読み込み
import MyCanvas from './MyCanvas.vue'

export default{
    components: {
        MyCanvas
    },
    methods:{
        add(arg1){
            if (-2 <= this.left && this.left < 2){
                this.left+=this.step;
            }
        },
        subtract(arg1){
            if (-2 < this.left && this.left <= 2){
                this.left-=this.step;
            }
        }
    },
    data() {
        return {
            step:0.01,
            left:-2,
            top:2,
            right:2,
            under:-2,
            N:10,
            //ブラウザのサイドメニュとヘッダー以外の高さと幅を取得
            h:document.getElementsByClassName('content-wrapper')[0].offsetHeight,
            w:document.getElementsByClassName('content-wrapper')[0].offsetWidth
        }
    },
    created : function(){
        console.log('created h:'+this.height+" w:"+this.width)
    },
    mounted : function(){
        console.log('mounted')
    },
    computed: {
        validateLeft: function () {
            if(this.left>this.right){
                this.right = this.left-this.step;
            }
            return this.left;
        },
        validateTop: function () {
            if(this.top<this.under){
                this.under = this.top-this.step;
            }
            return this.top;
        },
        height: function () {
            //正方形にしないとマンデルブロ集合が正しく描画されないので、小さい方に合わせる
            return this.h;// < this.w ? this.h:this.w
        },
        width: function () {
            //正方形にしないとマンデルブロ集合が正しく描画されないので、小さい方に合わせる
            return this.w;// < this.w ? this.h:this.w
        }
  }
}
</script>

<style>
/* 描画範囲の左側の空白部分を詰める */
.content-wrapper>.content{
    padding:0.0rem
}
.content{
    padding:0.0rem
}
.container-fluid{
    padding-left: 0.0px;
}
</style>
