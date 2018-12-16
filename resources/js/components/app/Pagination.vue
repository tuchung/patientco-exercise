<template>
<div>
  <b-pagination align="center" :total-rows="10*pages" :per-page="10" v-model="currentPage">
  </b-pagination>
</div>
</template>

<script>
export default {
    
  props: ['pages'],  
  data () {
    return {
      currentPage: 1
    }
  },
  methods: {
  
  },
  watch:{
      currentPage: function(val){
          this.$emit('pageChange', val);
      }
  }
}
</script>
