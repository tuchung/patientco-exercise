<template>
    <div>
        <navigation></navigation>
        <new-post @reload_request="comReload($event)"></new-post>
        <posts-list :trigger_reload="reload"></posts-list>
        
    </div>
    
</template>

<script>
    import navigation from './Navigation'
    import newPost from './NewPost'
    import postsList from './PostsList'

    export default {
        Name: 'Dashboard',
        data(){
            return{
               reload: false     
            }
        },
        methods: {
           comReload(){
               this.reload = !this.reload;
           }     
        },
        mounted() {
        },
        components: {navigation, newPost, postsList}
    }
</script>
