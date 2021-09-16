<template>
    <svg :width="width" :height="height" :viewBox="size">
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
        return this.h > this.w ? this.h:this.w
    },
    width: function () {
        return this.h > this.w ? this.h:this.w
    },
    size: function () {
        return this.h > this.w ?  "0 0 "+this.h*2+" "+this.h*2 : "0 0 "+this.w*2+" "+this.w*2
    },
    circles: function () {
        let circles = [];
        let count = 0;
        let maxN = 10;
        let r = 1;
        let h = this.height;
        let w = this.width;
        let cr = 0
        let rgb = ``
        let res = 0
        for (var col=0;col<h/r;col+=r){
            for (var row=0;row<w/r;row+=r){
                res = this.mandelbrot(0,0,row/w*4-2,col/h*4-2,maxN)
                if (res == 0){
                    rgb = `rgb(255 0 0)`
                }else {
                    cr = res % 256;
                    rgb = `rgb(${cr}, ${cr}, ${cr})`
                }
                circles.push({id:count, x:r+row*2*r,y:r+col*2*r,r:r,color:rgb })
                count++;
            }
        }
      return circles;
    }
  }
}
</script>

<style>
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
