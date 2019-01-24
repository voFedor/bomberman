<template>
    <div class="card card-default chat-box">
        <div class="card-header">
            <b :class="{'text-denger':session_block}">
                {{user.name}}
                <span v-if="session_block">(Заблокирован)</span>
            </b>
            <a href="" @click.prevent="close">
            <i class="fa fa-times float-right"></i>
            </a>


            <div class="dropdown">
                <a data-toggle="dropdown">
                    <i class="fa fa-ellipsis-v float-right"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" @click.prevent="clear">Очистить</a>
                    <a class="dropdown-item" v-if="session_block" @click.prevent="unblock">Разблокировать</a>
                    <a class="dropdown-item" @click.prevent="block" v-else>Заблокировать</a>
                </div>
            </div>
        </div>
        <div class="card-body" v-chat-scroll>
            <p class="card-text" v-for="chat in chats" :key="chat.message">
                {{chat.message}}
            </p>
        </div>
        <form class="card-footer" @submit.prevent="send">
            <div class="form-group">
                <input type="text" class="form-control message-input" :disabled="session_block">
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data(){
            return {
                chats:[],
                message: null,
                session_block:false
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
                this.$emit('close');
            },
            clear() {
                this.chats = []
            },
            block() {
                this.session_block = true
            },
            unblock() {
                this.session_block = false
            }
        },
        mounted() {
            console.log('Component mounted.')
        },

        created(){
            this.chats.push(
                {message:"Hey"}
            )
        }
    }
</script>
<style>
    .chat-box {
        height: 400px;
    }
    .card-body {
        overflow-y: scroll;
    }
    .card-text {
        color: black !important;
        font-size: 15px !important;
    }
    .fa {
        float: right;
    }
    .dropdown {
        float: right;
        margin-right: 10px;
    }
</style>