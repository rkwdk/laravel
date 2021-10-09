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
    N: {
      type: Number,
      default: 30
    },
  },
  watch: {
    radius() {
        this.draw(this.radius,this.width,this.height,this.N)
    }
  },
  methods: {
    draw(radius,width,height,N) {
        this.ctx.clearRect(0, 0, width, height)
        this.ctx.font = "12px serif";

        let lt = [-0.575,0.55];
        let ru = [-0.570,0.54];
        if (ru[0]-lt[0]<0 || ru[1]-lt[1]>0 ){
            console.log("描画エラー");
            return
        }

        for(var row=0;row<=height;row+=radius){
            for(var col=0;col<=width;col+=radius){
                //左上を(-2,2)、右下を(2,-2)の範囲で分割した数刻みで発散するかを計算
                // let res = Math.random() > 0.5 ? 255 : 0 ;
                let res = this.mandelbrot(0,0,
                    lt[0]+col/width*(ru[0]-lt[0]),
                    lt[1]+row/height*(ru[1]-lt[1])
                    ,N
                )
                if(res != 255){
                    this.ctx.beginPath()
                    this.ctx.arc(col, row, radius, 0, Math.PI * 2);
                    let rgb =`rgb(${res}, ${res}, ${res})`;
                    this.ctx.fillStyle = rgb;
                    this.ctx.fill();
                    this.ctx.closePath()
                }
            }
        }
        for(var row=0;row<=height;row+=radius){
            for(var col=0;col<=width;col+=radius){
                this.ctx.beginPath()
                this.ctx.fillStyle = `rgb(255, 0, 0)`;
                let x = lt[0]+col/width*(ru[0]-lt[0]);
                let y = lt[1]+row/height*(ru[1]-lt[1]);
                if ( col == 0 && row == 0 ){
                    this.ctx.fillText(`lt(${x.toPrecision(2)},${y.toPrecision(2)})`,
                    col+10, row+10);
                }
                if ( col == 0 && row == parseInt(height/2)){
                    this.ctx.fillText(`l(${x.toPrecision(2)},${y.toPrecision(2)})`,
                    col+10, row);
                }
                if ( col == 0 && row == height){
                    this.ctx.fillText(`lu(${x.toPrecision(2)},${y.toPrecision(2)})`,
                    col+10, row-10);
                }
                if ( col == parseInt(width/2) && row == 0){
                    this.ctx.fillText(`t(${x.toPrecision(2)},${y.toPrecision(2)})`,
                    col, row+10);
                }
                if ( col == parseInt(width/2) && row == parseInt(height/2)){
                    this.ctx.fillText(`O(${x.toPrecision(2)},${y.toPrecision(2)})`,
                    col, row);
                }
                if ( col == parseInt(width/2) && row == height){
                    this.ctx.fillText(`u(${x.toPrecision(2)},${y.toPrecision(2)})`,
                    col, row-10);
                }
                if ( col == width && row == 0){
                    this.ctx.fillText(`rt(${x.toPrecision(2)},${y.toPrecision(2)})`,
                    col-100, row+10);
                }
                if ( col == width && row == parseInt(height/2)){
                    this.ctx.fillText(`r(${x.toPrecision(2)},${y.toPrecision(2)})`,
                    col-100, row);
                }
                if ( col == width && row == height){
                    this.ctx.fillText(`ru(${x.toPrecision(2)},${y.toPrecision(2)})`,
                    col-100, row-10);
                }
                this.ctx.closePath()
            }
        }
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
    this.draw(this.radius,this.width,this.height,this.N)
  }
}
</script>

<style scoped>
.canvas {
  border: 1px solid #000;
}
</style>
