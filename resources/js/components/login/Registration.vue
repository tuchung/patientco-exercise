<template>
    <div>    
        <b-container class='login-container'>
        <alert v-bind="error_message"></alert>    
        <h1><b-badge variant="primary">Register New Account</b-badge></h1>    
        <b-form @submit="submitForm" @reset="resetForm">

        <b-form-group id="register-name-group"
                        label="Name:"
                        label-for="register-name">
            <b-form-input id="register-name"
                        type="text"
                        v-model="form.name"
                        placeholder="Enter Name"
                        required>
            </b-form-input>
        </b-form-group>


        <b-form-group id="register-dob-group"
                        label="Date of Birth:"
                        label-for="register-dob">
                        <b-row>
                        <b-col>
                            <date-picker v-model="form.dob" :config="options"></date-picker>
                        </b-col>
                        </b-row>
        </b-form-group>

        <b-form-group id="login-email-group"
                        label="Email address:"
                        label-for="login-email">
            <b-form-input id="login-email"
                        type="email"
                        v-model="form.email"
                        placeholder="Enter Email"
                        required>
            </b-form-input>
        </b-form-group>

        <b-form-group id="login-password-group"
                        label="Password:"
                        label-for="login-password">
            <b-form-input id="login-password"
                        type="password"
                        v-model="form.password"
                        required
                        placeholder="Enter password">
            </b-form-input>
        </b-form-group>


        <b-form-group id="login-password-confirm-group"
                        label="Confirm Password:"
                        label-for="login-password-confirm">
            <b-form-input id="login-password-confirm"
                        type="password"
                        v-model="form.password_confirm"
                        required
                        placeholder="Confirm password">
            </b-form-input>
        </b-form-group>

        <b-button type="submit" variant="primary">Submit</b-button>
        </b-form>

        </b-container>
        </div>
    
</template>

<script>
    import alert from '../helpers/Alert' 

    export default {
        Name: 'Login',
        data() {
           return {
               error_message: {

               },
               options: {
                   format: 'MM/DD/YYYY',
                   useCurrent: false,
               },       
               form: {
                   dob: new Date(),
                   email: '',
                   password: '',
                   password_confirm: '',
                   name: '',
               }
           }     
        },
        methods: {
            confirmPassword(){
                if(this.form.password !== this.form.password_confirm){
                    this.error_message = {
                        type : 'danger',
                        message : 'Passwords does not match. Please try again.',
                        active : true
                    }
                    return false;
                }
                    return true;
            },
            submitForm(){
                let vm = this;
                if(!vm.confirmPassword()){
                   return; 
                } 
                axios.post('/register',vm.form)
                .then(function(response) {
                    vm.$router.push({
                        path:'/login',
                        params: { 
                            message : 'User successfully created.'
                            },
                        });
                })
                .catch(error => {
                    vm.error_message = {
                        type : 'danger',
                        message : error.response.data,
                        active : true
                    }
                });
            },
            resetForm(){

            }
        },
        mounted() {
        },
        components: {alert}
    }
</script>

<style scoped>
    .login-container{
        margin-top: 50px;
    }
</style>
