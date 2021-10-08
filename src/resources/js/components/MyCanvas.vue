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
      this.draw(this.radius,this.height,this.width)
   }
  },
  methods: {
    draw(radius,height,width) {
        this.ctx.clearRect(0, 0, height, width)
        for(var row=1;row<=height;row+=2){
            for(var col=1;col<=width;col+=2){
                if(Math.random()<0.5){
                    continue;
                }
                this.ctx.beginPath()
                this.ctx.arc(col, row, radius*0.01, 0, Math.PI * 2);
                this.ctx.fillStyle = "rgb(0, 141, 213)";
                this.ctx.fill();
                this.ctx.closePath()
            }
        }
    }
  },
  mounted() {
    this.ctx = this.$el.getContext('2d')
    this.draw(this.radius,this.height,this.width)
  }
}
</script>

<style scoped>
.canvas {
  border: 1px solid #000;
}
</style>
