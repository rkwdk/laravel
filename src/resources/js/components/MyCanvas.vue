<template>
  <canvas :width="width" :height="height" class="canvas"></canvas>
</template>

<script>
export default {
  data(){
    return {
        rad: 1,
    };
  },
  props: {
    left: {
      type: Number,
      default: -1
    },
    top: {
      type: Number,
      default: 1
    },
    right: {
      type: Number,
      default: 1
    },
    under: {
      type: Number,
      default: -1
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
      default: 10
    },
  },
  computed: {
    inputWatch() {
      return [this.$props.left, this.$props.top,this.$props.right, this.$props.under, this.$props.N];
    }
  },
  watch: {
    inputWatch() {
        this.draw(this.left,this.top,this.right,this.under,this.width,this.height,this.N)
    }
  },
  methods: {
    memoize(recursiveFunction) {
        var cacheIn = {}
        return function() {
            var key = JSON.stringify(arguments);
            if(cacheIn[key]) {
                return cacheIn[key];
            }
            else {
                var val = recursiveFunction.apply(this, arguments);
                cacheIn[key] = val;
                return val;
            }
        }
    },
    draw(left,top,right,under,width,height,N) {
        this.ctx.clearRect(0, 0, width, height)
        this.ctx.font = "12px serif";

        let lt = [left,top];
        let ru = [right,under];
        if (ru[0]-lt[0]<0 || ru[1]-lt[1]>0 ){
            console.log("描画エラー");
            return
        }

        for(var row=0;row<=height;row+=this.rad){
            for(var col=0;col<=width;col+=this.rad){
                //左上を(-2,2)、右下を(2,-2)の範囲で分割した数刻みで発散するかを計算
                let precisionX = (lt[0]+col/width*(ru[0]-lt[0])).toPrecision(8);
                let precisionY = (lt[1]+row/height*(ru[1]-lt[1])).toPrecision(8);

                let factorial = this.memoize(this.mandelbrot);
                let res = factorial(0,0,
                    parseFloat(precisionX),parseFloat(precisionY),N
                )
                if(res < 2){
                    this.ctx.beginPath()
                    this.ctx.arc(col, row, this.rad, 0, Math.PI * 2);
                    let gray = res/2*255
                    let rgb =`rgb(${gray}, ${gray}, ${gray})`;
                    this.ctx.fillStyle = rgb;
                    this.ctx.fill();
                    this.ctx.closePath()
                }
            }
        }
        let middleHeight = parseInt(height/2);
        let heightArray = [0,middleHeight,height]
        let middleWidth = parseInt(width/2);
        let widthArray = [0,middleWidth,width]
        for (const row of heightArray) {
            for (const col of widthArray) {
                // console.log(`${row} ${col}`);
                this.ctx.beginPath()
                this.ctx.fillStyle = `rgb(255, 0, 0)`;
                let x = lt[0]+col/width*(ru[0]-lt[0]);
                let y = lt[1]+row/height*(ru[1]-lt[1]);
                let atCol = (col == 0) ? 10: (col == width) ? -100 : 0;
                let atRow = (row == 0) ? 10: (row == height) ? -10 : 0;
                if ( ( col == 0 || col == parseInt(width/2) || col == width)
                    && (row == 0 || row == parseInt(height/2) || row == height) ){
                    this.ctx.fillText(`(${x.toPrecision(2)},${y.toPrecision(2)})`,
                    col+atCol, row+atRow);
                }
                this.ctx.closePath()
            }
        }
    },
    mandelbrot(znr,zni,cr,ci,N){
        let abs = 0;
        if (0>=N){
            abs = znr*znr+zni*zni;
            // console.log(`abs:${abs}`);
            return abs >= 2 ? 2 : abs;
        }
        let zn1r = (znr * znr) - (zni * zni) + cr;
        let zn1i = (znr * zni * 2.0) + ci;
        if (!isFinite(zn1r)||!isFinite(zn1i)){
            return 2;
        }
        abs = znr*znr+zni*zni;
        if (abs >= 2){
            return 2;
        }
        return this.mandelbrot(zn1r,zn1i,cr,ci,N-1)
    },
  },
  mounted() {
    this.ctx = this.$el.getContext('2d')
    console.log(`mounted height:${this.height} width:${this.width}`);
    this.draw(this.left,this.top,this.right,this.under,this.width,this.height,this.N)
  }
}
</script>

<style scoped>
.canvas {
  border: 1px solid #000;
}
</style>
