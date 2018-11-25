<template>
    <div class="meta-bar chat"><input name="message"  v-model="newMessage" @keyup.enter="sendMessage" class="nostyle chat-input" type="text" placeholder="Message..." /> <i class="mdi mdi-send" id="btn-chat" @click="sendMessage"></i></div>
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage
                });

                this.newMessage = ''
            }
        }
    }
</script>