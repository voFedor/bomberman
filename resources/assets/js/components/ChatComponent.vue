<template>
    <div class="container clearfix" style="margin: 0 auto;background: #444753;border-radius: 5px;">
                <div class="people-list" id="people-list">
                    <div class="search">
                        <input type="text" placeholder="search" />
                        <i class="fa fa-search"></i>
                    </div>
                    <ul class="list" style="overflow-y: hidden;overflow: auto;">
                        <li class="clearfix" v-for="friend in friends" :key=friend.id @click.prevent="openChat(friend)">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01.jpg" alt="avatar" />
                            <div class="about">
                                <div class="name">{{friend.name}}</div>
                                <div class="status">
                                    <i class="fa fa-circle online" v-if="friend.online"></i>

                                </div>
                            </div>
                        </li>
                    </ul>

                </div>

                <div class="chat">
                    <div class="chat-header clearfix">

                    </div> <!-- end chat-header -->
                    <span v-for="friend in friends" :key="friend.id" v-if="friend.session">
                        <message-component v-if="friend.session.open" @close="close(friend)" :friend=friend></message-component>
                    </span>


                </div> <!-- end chat -->

            </div> <!-- end container -->

</template>

<script>
    import MessageComponent from './MessageComponent';
    export default {
        components: { MessageComponent },
        data(){
            return {
                friends:[]
            }
        },

        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            close(friend){
                friend.session.open = false;
            },
            getUsers(){
                axios.post('/getUsers').then(res => (this.friends = res.data.data));
            },
            openChat(friend){
                if (friend.session){
                    this.friends.forEach(friend => {
                        friend.session.open = false;
                    });
                    friend.session.open = true;
                } else {
                    this.createSession(friend);
                }

            },

        createSession(friend) {
            axios.post('/session/create', {friend_id: friend.id}).then(res => {
                (friend.session = res.data.data), (friend.session.open = true);
            });
            }
        },
        created(){
            this.getUsers();
            Echo.channel(`Chat`).listen('SessionEvent', e => {
               let friend = this.friends.find(friend => friend.id == e.session_by);
               friend.session = e.session;
            });
            Echo.join(`Chat`)
                .here(users => {
                   this.friends.forEach(friend => {
                       users.forEach(user => {
                           if(user.id == friend.id) {
                               friend.online = true
                           }

                       });
                   });
                })
                .joining(user => {
                    this.friends.forEach(
                        friend => user.id == friend.id ? friend.online = true : "")

            }).leaving((user) => {
                this.friends.forEach(friend => user.id == friend.id ? friend.online = false : '')
            });
        }
    }
</script>
