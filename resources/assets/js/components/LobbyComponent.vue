<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="span3">
                <div class="card card-default">
                    <div class="card-header">Список игроков</div>

                        <ul class="list-group">
                            <a href="javascript:void(0)" @click.prevent="openChat(user)" :key=user.id v-for="user in users">
                                <li class="list-group-item">{{user.name}}</li>
                            </a>
                        </ul>

                </div>
            </div>
            <div class="span9">
                <span v-for="user in users" :key="user.id" v-if="user.session">
                    <message-component v-if="user.session.open" @close="close(user)" :user=user></message-component>
                </span>

            </div>
        </div>
    </div>
</template>

<script>
    import MessageComponent from './MessageComponent';
    export default {
        components: {
            MessageComponent
        },
        name: 'lobbycomponent',
        data(){
            return {
                users:[]
            }
        },
        methods:{
            getUsers(){
                axios.post('getUsers').then(res => this.users = res.data.data)
            },
            close(user){
                user.session.open = false
            },
            openChat(user) {
                if (user.session) {
                    this.users.forEach(user => {
                        user.session.open = false;
                    });
                    user.session.open = true;
                } else {
                    this.createSession(user);
                }

            },
            createSession(user) {
                axios.post("/session/create", { friend_id:user.id}).then(res => {
                    (user.session = res.data.data), (user.session.open = true);
                });
            }
        },
        created(){

            this.getUsers();

            Echo.join("Chat")
                .here(($users) => {
                    console.log($users)
                })
        }
    }
</script>

<style>
    .list-group{
        margin: 0 0 10px 0px;
    }
    li {
        color: black;
    }
    .message-input {
        width: 98%;

    }
</style>