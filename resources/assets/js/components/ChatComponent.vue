<template>
    <div class="container clearfix" style="margin: 0 auto;background: #444753;border-radius: 5px;">
                <div class="people-list" id="people-list">
                    <div class="search">
                        <input type="text" placeholder="search" />
                        <i class="fa fa-search"></i>
                    </div>
                    <ul class="list" style="overflow-y: hidden;overflow: auto;">
                        <li class="clearfix" v-for="user in users" :key="user.id" @click.prevent="openChat(user)">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01.jpg" alt="avatar" />
                            <div class="about">
                                <div class="name">{{user.name}}</div>
                                <div class="status">
                                    <i class="fa fa-circle online" v-if="user.online"></i>

                                </div>
                            </div>
                        </li>
                    </ul>

                </div>

                <div class="chat">
                    <div class="chat-header clearfix">

                    </div> <!-- end chat-header -->
                    <span v-for="user in users" :key="user.id" @click.prevent="openChat(user)" v-if="user.session">
                        <message-component v-if="user.session.open" @close="close" :user=user></message-component>
                    </span>


                </div> <!-- end chat -->

            </div> <!-- end container -->

</template>

<script>
    import MessageComponent from './MessageComponent';
    export default {
        data(){
            return {
                users:[]
            }
        },
        components: { MessageComponent },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            close(user){
                user.session.open = false
            },
            getUsers(){
                axios.post('/getUsers').then(res => this.users = res.data.data)
            },
            openChat(user){
                if (user.session){
                    this.users.forEach(user => {
                        user.session.open = false
                    });
                    user.session.open = true
                } else {
                    this.createSession(user);

                }

            }
        },
        createSession(user) {
            axios.post('/session/create', {user_id: user.id}).then(res => {
                (user.session = res.data.data), (user.session.open = true);
            });
        },
        created(){
            this.getUsers();

            Echo.join('Chat')
                .here((t_users) => {
                   this.users.forEach(user => {
                       t_users.forEach(t_user => {
                           if(user.id == t_user.id) {
                               user.online = true
                           }

                       })
                   })
                })
        }
    }
</script>
