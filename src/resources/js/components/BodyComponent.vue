<template>
    <svg width="400" height="400" viewBox="0 0 400 400">
        <circle :cx="circle.x" :cy="circle.y" :r="circle.r"/>
    </svg>
</template>
<script>

export default{
    created : function(){
        console.log('created')
    },
    mounted : function(){
        console.log('mounted')
    },
    computed: {
    circle: function () {
      return {x:50,y:50,r:50}
    }
  }
}
</script>
