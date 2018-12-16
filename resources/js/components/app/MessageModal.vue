<template>
  <div>
    <b-modal ref="myModalRef" hide-footer title="Edit Post">
      <b-form-textarea
                        v-model="form.edit_message"
                        :rows="3"
                        :max-rows="6">
        </b-form-textarea>
      <b-btn class="mt-3" variant="success" block @click="updatePost">Update</b-btn>
    </b-modal>
  </div>
</template>

<script>
export default {
    props:['trigger', 'message', 'message_id'],
    data(){
        return {
            form : {
                edit_message: "",
                edit_id: 0
            }
        }
    },
  methods: {
    showModal () {
      this.$refs.myModalRef.show()
    },
    hideModal () {
      this.$refs.myModalRef.hide()
    },
    requestReload(){
        this.$emit('reload_request', true);
    },
    updatePost(){
        let vm = this;    
        axios.put('/posts/update', vm.form)
        .then(function(response) {
            vm.hideModal();
            vm.requestReload();
        })
        .catch(function (error) {
        });
    }
  },
  watch: {
      trigger: function(val, oldval){
              this.showModal();
              this.form.edit_message = this.message;
              this.form.edit_id = this.message_id;
      }
  }
}
</script>

