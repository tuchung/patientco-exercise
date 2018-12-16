<template>
    <div class="person-card">
        <img src="images/person.jpg" class="person-img" alt="">
        <p class="card-text">{{name}}</p>
    </div>
    
</template>

<script>

    export default {
        props: ['name'],
        Name: 'PersonCard',
        methods: {
                
        },
        mounted() {
        }
    }
</script>

<style scoped>
 .person-img{
     width: 100%;
 }
 .person-card{
     /* width: 8%;
     display: inline-block */
 }
 .card-text{
     text-align: center;
     font-size: 10px;
 }
</style>
