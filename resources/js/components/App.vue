<template>
    <div>
        <router-view></router-view>
    </div>
    
</template>

<script>
    import alert from './helpers/Alert' 

    export default {
        Name: 'App',
        methods: {
            authenticate: function(){
                axios.get('/authenticate',{})
                .then(function(response) {
                    
                })
                .catch(error => {
                    this.$router.push({ path: '/login' });
                });
            },
            checkAuthenticate: function(path){
                if( path != "/login/register" && path != "/login"){
                    this.authenticate();
                }
            }
        },
        mounted() {
            this.checkAuthenticate(this.$route.path);
        },
        watch: {
            '$route' (to, from) {
                this.checkAuthenticate(to.path);
            }
        },
        components: {alert}
    }
</script>
