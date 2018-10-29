<template>

    <div id="price" class="section secondary-section">
        <div class="container">
            <div class="title">
                <h1>Price</h1>
                <p>Duis mollis placerat quam, eget laoreet tellus tempor eu. Quisque dapibus in purus in dignissim.</p>
            </div>
            <div class="price-table row-fluid">
                <div class="span4 price-column">
                    <h3>Ваши дуэли</h3>
                    <ul class="list">
                        <li class="li-padding" @click.prevent="openChat(friend)"
                            v-for="friend in friends" :key=friend.id>
                        <a href="" >
                        {{ friend.name}}
                        </a>
                            <i v-if="friend.online" class="fa fa-circle float-right text-success" aria-hidden="true"></i>
                        </li>

                    </ul>
                    <a href="#" class="button button-ps">Пополнить баланс (ну или сыграть на 100р)</a>
                </div>
                <div class="span8 price-column">
                    <span v-for="friend in friends" :key="friend.id"
                        v-if="friend.session">
                        <message-component
                                v-if="friend.session.open"
                                @close="close(friend)"
                                :friend="friend"
                            ></message-component>

                    </span>

                </div>
            </div>
            <div class="centered">
                <p class="price-text">We Offer Custom Plans. Contact Us For More Info.</p>
                <a href="#contact" class="button">Contact Us</a>
            </div>
        </div>
    </div>


</template>


<script>
    import MessageComponent from './MessageComponent';
    export default {
        components: {MessageComponent},
        data() {
          return {
              friends:[]
          };
        },
        methods: {
            close(friend){
                friend.session.open = false
            },
            getFriends() {
                axios.post("/getFriends").then(res => {
                    this.friends = res.data.data;
                    this.friends.forEach(
                        friend => (friend.session ? this.listenForEverySession(friend) : "")
                    );
                });
            },
            openChat(friend){
                if (friend.session){
                    this.friends.forEach(friend => friend.session ? friend.session.open = false : '');
                    friend.session.open = true;
                } else {
                    this.createSession(friend);
                }

            },
            createSession(friend) {
                axios.post("/session/create", { friend_id: friend.id }).then(res => {
                    (friend.session = res.data.data), (friend.session.open = true);
                });
            },
            listenForEverySession(friend) {
                // Echo.private(`Chat.${friend.session.id}`).listen(
                //     "PrivateChatEvent",
                //     e => (friend.session.open ? "" : friend.session.unreadCount++)
                // );
            }
        },

        created(){
            this.getFriends();
            Echo.channel('Chat').listen('SessionEvent', e => {
                let friend = this.friends.find(friend => friend.id == e.session_by);
                friend.session = e.session;
            });
            Echo.join('Chat')
                .here((users) => {
                    this.friends.forEach(friend=>{
                        users.forEach(user => {
                            if(user.id == friend.id){
                                friend.online = true
                            }
                        })
                    })
                })
                .joining(user => {
                    this.friends.forEach(
                        friend => (user.id == friend.id ? (friend.online = true) : "")
                    );
                })
                .leaving(user => {
                    this.friends.forEach(
                        friend => (user.id == friend.id ? (friend.online = false) : "")
                    );
                });
        },
        mounted() {

        }
    }
</script>

<style scoped>
    input{
        width: 80%;
        height: 50px;
        border: solid 1px #ccc;
        border-radius: 10px;
    }
    .list{
        margin: 0 0;
    }
    .li-padding{
        padding: 25px 25px !important;
    }

</style>