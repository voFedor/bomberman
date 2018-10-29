<template>
    <div>
    <h3>ИГРАТЬ с {{friend.name}}
        <a class="close-icon" href="" @click.prevent="close">
        <i class="fa fa-times float-right"></i>
    </a></h3>

    <ul class="chat-box" v-chat-scroll>
        <li :style="{'text-align: -webkit-left;':chat.type == 1}" class="card-text" v-for="chat in chats" :key="chat.id">
            {{chat.message}}
        </li>
    </ul>
    <form class="card-footer" @submit.prevent="send">
        <div class="form-group">
            <input v-model="message" placeholder="Ваше сообщение" type="text" class="form-control">
        </div>
        <button class="button button-ps send-btn">Оьправить</button>
    </form>
    </div>
</template>

<script>
    export default {
        props: ['friend'],
        data(){
            return {
                chats: [],
                message: null,
                open: true
            }
        },
        methods:{
            send(){
                if(this.message){
                    this.pushToChats(this.message);

                    axios.post(`/send/${this.friend.session.id}`, {
                        content: this.message,
                        to_user: this.friend.id
                    });
                    this.message = null;
                }
            },
            pushToChats(message) {
                this.chats.push({ message: message, type:0, sent_at: 'Just Now'});
            },
            close(){
                this.$emit('close');
            },
            getAllMessages(){
                axios.post(`/session/${this.friend.session.id}/chats`)
                    .then(res => (this.chats = res.data.data));
            }
        },
        created(){
            this.getAllMessages();

            Echo.private(`Chat.${this.friend.session.id}`).listen("PrivateChatEvent",
                (e) => {
                this.chats.push({ message: e.content, type:1, sent_at: 'Just Now'})
            });
        }
    }
</script>

<style scoped>
    .close-icon{
        color: white;
        float: right;
        margin-right: 22px;
    }
    .chat-box{
        height: 400px;
        margin: 0 0;
        overflow-y: scroll;
    }
    input{
        width: 80%;
        height: 50px;
        border: solid 1px #ccc;
        border-radius: 10px;
    }
    li{
        padding: 25px 25px;
    }
    .card-footer{
        margin: 0 0 0;
    }
    .send-btn {
        border-radius: 10px;
    }
    .card-text{
        text-align: -webkit-left;
        color:black;
        list-style-type: none;
    }
</style>