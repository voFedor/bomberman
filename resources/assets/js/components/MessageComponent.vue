<template>
    <div>
    <div class="chat-history">
        <ul  v-chat-scroll>

            <li class="clearfix"  v-for="chat in chats" :key="chat.message">
                <div class="message-data align-right">
                    <span class="message-data-time" >10:10 AM, Today</span> &nbsp; &nbsp;
                    <span class="message-data-name" >{{ friend.name}}</span> <i class="fa fa-circle me"></i>

                </div>
                <div class="message other-message float-right">
                   {{ chat.message }}
                </div>
            </li>



        </ul>

    </div> <!-- end chat-history -->
        <form action="" @submit.prevent="send">
    <div class="chat-message clearfix">
        <textarea name="message-to-send" id="message-to-send" placeholder ="Type your message" rows="3"></textarea>

        <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
        <i class="fa fa-file-image-o"></i>

        <button v-model="message">Send</button>
    </div></form>
    </div> <!-- end chat-message -->
</template>

<script>
    export default {
        props: ['friend'],
        data(){
            return {
                chats:[],
                message: null
            }
        },
        methods: {
            send() {
                if (this.message) {
                    this.chats.push(this.message);
                    axios.post(`/send/${this.session.id}`, {
                        content : this.message
                    });
                    this.message = null;
                }
            },
            close(){
                this.$emit('closr');
            }
        },
        mounted() {
            console.log('Component mounted.')
        },

        created(){
            this.chats.push({
                message:"Hey"
            })
        }
    }
</script>
