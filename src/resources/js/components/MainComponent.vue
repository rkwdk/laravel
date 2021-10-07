<template>
    <!-- svgの描画 -->
    <svg :width="width" :height="height" :viewBox="size">
        <!-- vueによる円の繰り返し描画 -->
        <circle v-for="circle in circles" :key="circle.id"
                :cx="circle.x" :cy="circle.y" :r="circle.r"
                :fill="circle.color"
        />
    </svg>
</template>
<script>

export default{
    data() {
        return {
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
    methods : {
        //発散値を求めるための再帰関数
        //znr:Z(n)の実数部、zni:Z(n)の虚数部
        //cr:cの実数部、ci:cの虚数部、Nは臨界数
        mandelbrot: function(znr,zni,cr,ci,N){
            /*
            Z(n+1)=Z(n)^2+c
            Z(0)=0+0i
            cは複素平面上の座標(cr+ci*i)
            n->∞のとき,Z(n)が発散しないcをマンデルブロ集合という
            Z(n)=znr+zni*iとして、実部と虚部に分けるとZ(n+1)は
            zn1r=znr*znr-zni*zni+cr
            zn1i=2*znr*zni+ci
            上記を再帰して、途中で発散するかN回目で規定値を超えていた場合255を返す。

            */
            if (0>=N){
                let abs = znr*znr+zni*zni;
                return abs > 255 ? 255 : abs;
            }
            let zn1r = (znr * znr) - (zni * zni) + cr;
            let zn1i = (znr * zni * 2.0) + ci;
            if (!isFinite(zn1r)||!isFinite(zn1i)){
                return 255;
            }
            return this.mandelbrot(zn1r,zn1i,cr,ci,N-1)
        },
    },
    computed: {
    height: function () {
        //正方形にしないとマンデルブロ集合が正しく描画されないので、小さい方に合わせる
        return this.h < this.w ? this.h:this.w
    },
    width: function () {
        //正方形にしないとマンデルブロ集合が正しく描画されないので、小さい方に合わせる
        return this.h < this.w ? this.h:this.w
    },
    size: function () {
        //svgのviewportを算出して返す
        return this.h < this.w ?  "0 0 "+this.h*2+" "+this.h*2 : "0 0 "+this.w*2+" "+this.w*2
    },
    circles: function () {
        let circles = [];//svg用の円の配列の格納
        let count = 0;//svg用の円のid計算用
        let maxN = 10;//臨界数
        let r = 1;//塗りつぶし用の半径
        let h = this.height;//svg用の高さ
        let w = this.width;//svg用の幅
        let cr = 0;//グレースケール値の格納
        let rgb = ``;//svgの描画用の色格納
        let res = 0;//臨界数を超えたときの値

        //高さを半径で割った数に分割
        for (var col=0;col<h/r;col+=r){
            //幅を半径で割った数に分割
            for (var row=0;row<w/r;row+=r){
                //左上を(-2,-2)、右下を(2,2)の範囲で分割した数刻みで発散するかを計算
                res = this.mandelbrot(0,0,row/w*4-2,col/h*4-2,maxN)
                //結果の値で色を決定(発散したら255)
                if (res == 0){
                    rgb = `rgb(255 0 0)`
                }else {
                    cr = res % 256;
                    rgb = `rgb(${cr}, ${cr}, ${cr})`
                }
                //描画用の円の生成と配列への格納
                circles.push({id:count, x:r+row*2*r,y:r+col*2*r,r:r,color:rgb })
                //円のid
                count++;
            }
        }
      return circles;
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
