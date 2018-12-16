<template>
  <div>
    <b-modal ref="myModalRef" hide-footer >
      <div class="d-block text-center">
        <h3>{{message}}</h3>
      </div>
        <b-button variant="success" @click="emitConfirm()">
            Confirm
        </b-button>
        <b-button variant="danger" @click="emitCancel()">
            Cancel
        </b-button>
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
    emitConfirm(){
      this.$emit('yes', true);
      this.hideModal();

    },
    emitAbort(){
      this.$emit('no', true);
      this.hideModal();
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