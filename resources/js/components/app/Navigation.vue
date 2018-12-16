<template>
    <div>
        <alert v-bind="message"></alert>    
        <b-navbar toggleable="md" type="dark" variant="info">

        <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

        <b-navbar-brand href="#">Patientco - Social</b-navbar-brand>

        <b-collapse is-nav id="nav_collapse">

        <b-navbar-nav>
        <b-nav-item href="#">Dashboard</b-nav-item>
        </b-navbar-nav>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
            <b-navbar-nav  right>
                <b-nav-item @click="logout">Logout</b-nav-item>
            </b-navbar-nav>

        </b-navbar-nav>

        </b-collapse>
        </b-navbar>
    </div>
        
</template>

<script>
    import alert from '../helpers/Alert' 

    export default {
        data(){
            return {
                message : {

                }
            }
        },
        Name: 'Navigation',
        methods: {
           logout(){
               let vm = this;
               axios.post('/logout')
                .then(function(response) {
                    vm.$router.push({
                        path:'/login'
                    });
                })
                .catch(function (error) {
                    vm.message = {
                        type: 'danger',
                        message: error,
                        active: true
                    }
                });    
           }     
        },
        mounted() {
        },
        components: {alert}
    }
</script>
