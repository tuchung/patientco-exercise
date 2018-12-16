<template>
    <div>
        <alert v-bind="message"></alert>  
        <confirm-modal :trigger="confirm_trigger" :message="confirm_message" @yes="deletePost()">
        </confirm-modal>
        <message-modal :trigger="modal_trigger" :message_id="edit_id" :message="edit_message" @reload_request="loadPost"></message-modal>
        <div class="posts-list">
        <b-card header="<b>Latest Feeds</b>">
            <b-list-group>
            <b-list-group-item 
                v-for="post in posts"
                v-bind:data="post.message"
                v-bind:key="post.id"
            >
            <b-row variant="primary">
                <b-col class="title" cols="12"><strong>Last updated:</strong>&nbsp;&nbsp;{{post.update}}</b-col>
            </b-row>
            <b-row >
                <b-col class="border-container" cols="1"><card :name="post.user"></card></b-col>
                <b-col class="message">{{post.message}}</b-col>
            </b-row>
            <b-row >
                <b-col class="action-button" cols="12">
                    <b-button size="sm" v-show="post.editable" variant="danger" @click="confirmModal('Delete this post?', post.id)">
                        delete
                    </b-button>
                    <b-button size="sm" v-show="post.editable" variant="primary" @click="triggerModal(post.id, post.message)">
                        edit
                    </b-button>
                </b-col>
            </b-row>
            </b-list-group-item>
            </b-list-group>
        </b-card>
        </div>
        <pagination :pages="num_page" @pageChange="pageChange($event)"></pagination>
    </div>
    
</template>

<script>
    import card from './PersonCard'
    import messageModal from './MessageModal'
    import alert from '../helpers/Alert'
    import confirmModal from './ConfirmModal'
    import pagination from './Pagination'
    export default {
        Name: 'PostsList',
        props: ['trigger_reload'],
        data(){
            return {
                posts: [],
                user_id: 0,
                edit_id: 0,
                edit_message: "",
                modal_trigger: false,
                confirm_trigger: false,
                confirm_message: "",
                delete_id: 0,
                message: {
                    
                },
                page: 1,
                num_page: 0
            }
        },
        methods: {
            pageChange(val){
                this.page = val;
                console.log(this.page);
                this.loadPost();
            },
            loadPost(){
                let vm = this;    

                axios.get('/posts', {params: {
                    page : vm.page
                }})
                .then(function(response) {
                    vm.posts = response.data.records;
                    vm.num_page = response.data.pages;
                })
                .catch(function (error) {
                    vm.error_message = {
                        type: "danger",
                        message: error,
                        active: true
                    }
                }); 
            },
            deletePost(){
                let vm = this;    
                axios.post('/posts/delete',{id : vm.delete_id} )
                .then(function(response) {
                    vm.message = {
                        type: "success",
                        message: "Post Deleted.",
                        active: true
                    }
                    vm.loadPost();
                })
                .catch(function (error) {
                    vm.message = {
                        type: "danger",
                        message: error,
                        active: true
                    }
                }); 
            },
            confirmModal(message, id){
                this.confirm_message = message;
                this.confirm_trigger = !this.confirm_trigger;
                this.delete_id = id; 
            },
            triggerModal(id, message){
               this.edit_id = id;
               this.edit_message = message;     
               this.modal_trigger = !this.modal_trigger;     
            }    
        },
        mounted() {
             this.loadPost();   
        },
        watch: {
            trigger_reload: function (val) {
                this.loadPost();
            },
        },
        components: {card, messageModal,alert, confirmModal, pagination}
        }
</script>

<style scoped>
    .posts-list{
        padding: 20px
    }
    .title{
         text-align: right;
    }
    .content{
        display: inline-block;
        min-height: 100px;
        line-height: 80px;
    }
    .message{
        text-align: left;
    }

    .border-container{
        border: 1px black solid;
        border-radius: 10px;
        margin-left: 10px;
    }

    .action-button{
        text-align: right;
        margin-bottom: 5px;
    }
</style>


