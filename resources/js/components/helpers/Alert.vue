<template>
    <div>
    <b-alert :show="dismissCountDown"
             dismissible
             :variant="type"
             @dismissed="dismissCountDown=0"
             @dismiss-count-down="countDownChanged">
            {{message}}
    </b-alert>
  </div>
    
</template>

<script>
export default {
    name: "alert",
    props: [
        "message", "type", "active"
    ],
    data () {
        return {  
        dismissSecs: 5,
        dismissCountDown: 0
        }
    },
    methods: {
        countDownChanged (dismissCountDown) {
        this.dismissCountDown = dismissCountDown
        }
    },
    mounted: function(){
        if(this.active){
            this.dismissCountDown = 5;    
        }
    },
    watch: {
        active: function(newVal, oldVal){
            if(this.active){
                this.dismissCountDown = 5;    
            }
        }
    } 
}
</script>
