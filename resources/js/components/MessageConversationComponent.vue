<template>
<!--    <b-media right-align vertical-align="center" class="mb-2">
 -->    
        <b-media :right-align="writtenByMe" vertical-align="center" class="mb-2">   
        <b-img rounded="circle" slot="aside" blank blank-color="#ccc" width="48" alt="placeholder">
           </b-img>
        <b-card>
          <!--   {{ content }} -->
          <slot></slot>
             </b-card>   

   </b-media>
</template>

<script>
    export default {
      
        
         props:{
             writtenByme: Boolean
         },

        data() {
            return {
                content: 'abc',
                writtenByMe: ''
            };
        },
        mounted() {
            console.log('Valor de writtenByMe.',this.writtenByme)
        }
    }
</script>