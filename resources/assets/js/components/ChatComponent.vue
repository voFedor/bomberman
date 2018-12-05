<template>
    <div class="container clearfix" style="margin: 0 auto;background: #444753;border-radius: 5px;">

        <!-- Modal -->
        <div class="modal fade" id="users_list" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                        <div class="people-list" id="people-list">
                            <div class="search">
                                <input type="text" placeholder="search" />
                                <i class="fa fa-search"></i>
                            </div>
                            <ul class="list" style="overflow-y: hidden;overflow: auto;">
                                <li class="clearfix" v-for="friend in friends" :key=friend.id>
                                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01.jpg" alt="avatar" />
                                    <div class="about">
                                        <div class="name">{{friend.name}}</div>
                                        <div class="status">
                                            <i class="fa fa-circle online" v-if="friend.online"></i>
                                            <button  @click.prevent="play(friend)">Пригласить</button>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



    </div> <!-- end container -->

</template>

<script>

    import moment from '../../../../public/some.js';

    export default {
        components: {
            moment
        },
        props: ['game_id', 'bet_id'],
        data(){
            return {
                friends:[]
            }
        },

        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            show () {
                this.$modal.show('hello-world');
            },
            hide () {
                this.$modal.hide('hello-world');
            },
            play: function (friend) {

                axios.post('/getGamePlay', {
                    game_id: $("#game_id_for_vue").val(),
                    friend_id: friend.id,
                    bet_id: $("#bet_id_for_vue").val()
                }).then(res => openMathGameWindow(res.data.data))
            },
            openGamePopU: function
            close(friend){
                friend.session.open = false;
            },
            getUsers(){
                axios.post('/getUsers/').then(res => (this.friends = res.data.data));
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
                .joining((user) => {
                    this.friends.forEach(
                        friend => (user.id == friend.id) ? (friend.online = true) : "")

            }).leaving((user) => {
                this.friends.forEach(friend => user.id == friend.id ? friend.online = false : '')
            });
        }
    }


    $(function() {
        openGameWindow();
    })
</script>
<style>
    i {
        color: green;
    }
</style>