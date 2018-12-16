<template>
    <div>    
        <alert v-bind="message"></alert>  
        <div class="new-post">
            <h4><b-badge variant="info" no-resize=true>Post New Message</b-badge></h4>
            <b-form @submit="submitForm">
            <b-form-textarea
                        v-model="form.message"
                        placeholder="Share what on your mind.."
                        :rows="3"
                        :max-rows="6">
            </b-form-textarea>
            <div class="post-button">
                <b-button type="submit"  size="" variant="success">
                    Post
                </b-button>
            </div>
            </b-form>
        </div>
    </div>
    
</template>

<script>
    import alert from '../helpers/Alert' 

    export default {
        Name: 'Dashboard',
        data() {
            return {
                error_message: {

                },
                message: {

                },
                form: {
                    message: ""
                }
            }
        },
        methods: {
            submitForm(){
                let vm = this; 
                axios.post('/post_new',vm.form)
                .then(function(response) {
                    vm.message = {
                        type: "success",
                        message: "Message posted.",
                        active: true
                    }
                    vm.reloadPosts();

                    vm.form.message = "";
                })
                .catch(function (error) {
                    vm.error_message = {
                        type: "danger",
                        message: "Message posted.",
                        active: true
                    }
                });    
            },
            reloadPosts(){
                this.$emit('reload_request', true);
            }    
        },
        mounted() {
        },
        components: {alert}
    }
</script>

<style scoped>
    .new-post{
        padding: 30px;
    }
    .post-button{
        text-align: right;
        margin-top: 5px;
    }
</style>

