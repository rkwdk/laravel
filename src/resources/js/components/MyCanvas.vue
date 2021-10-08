<template>
  <canvas :width="width" :height="height" class="canvas"></canvas>
</template>

<script>
export default {
  props: {
    radius: {
      type: Number,
      default: 0
    },
    height: {
      type: Number,
      default: 0
    },
    width: {
      type: Number,
      default: 0
    },
  },
  watch: {
    radius() {
        this.draw(this.radius,this.width,this.height)
    }
  },
  methods: {
    draw(radius,width,height) {
        this.ctx.clearRect(0, 0, width, height)
        for(var row=0;row<=height;row+=radius){
            for(var col=0;col<=width;col+=radius){
                //左上を(-2,-2)、右下を(2,2)の範囲で分割した数刻みで発散するかを計算
                // let res = Math.random() > 0.5 ? 255 : 0 ;
                let res = this.mandelbrot(0,0,col/width*4-2,row/height*4-2,30)
                if(res == 255){
                    continue;
                }
                let rgb =`rgb(${res}, ${res}, ${res})`;
                this.ctx.beginPath()
                this.ctx.arc(col, row, radius, 0, Math.PI * 2);
                this.ctx.fillStyle = rgb;
                this.ctx.fill();
                this.ctx.closePath()
            }
        }
        this.ctx.beginPath()
        this.ctx.arc(width/2, height/2, 1, 0, Math.PI * 2);
        this.ctx.fillStyle = `rgb(255, 0, 0)`;
        this.ctx.fill();
        this.ctx.closePath()
    },
    mandelbrot(znr,zni,cr,ci,N){
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
  mounted() {
    this.ctx = this.$el.getContext('2d')
    console.log(`mounted height:${this.height} width:${this.width}`);
    this.draw(this.radius,this.width,this.height)
  }
}
</script>

<style scoped>
.canvas {
  border: 1px solid #000;
}
</style>
