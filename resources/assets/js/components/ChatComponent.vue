<template>
    <div class="container clearfix" style="margin: 0 auto;background: #444753;border-radius: 5px;">

        <!-- Modal -->
        <div class="modal fade" id="users_list" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="color: black">Выбери с кем хочешь сразиться</h4>
                    </div>
                    <div class="modal-body">
                        <div class="people-list" id="people-list">
                            <div class="search">
                                <div class="filter" style="color: black">
                                    <label><input type="radio" v-model="selectedCategory" value="All" /> Все</label>
                                    <label><input type="radio" v-model="selectedCategory" value="Online" /> Онлайн</label>
                                    <label><input type="radio" v-model="selectedCategory" value="Offline" /> Офлайн</label>
                                </div>
                            </div>





                            <div class="media" v-for="friend in filteredPeople" :key=friend.id>
                                <a href="#" class="pull-left">
                                    <img alt="64x64" data-src="holder.js/64x64" class="media-object img-thumbnail" style="width: 64px; height: 64px;" src="http://placehold.it/64x64">
                                </a>
                                <div class="media-body">
                                    <h3 class="media-heading"><strong><a href="#">{{friend.name}}</a></strong></h3>
                                    <p class="small">
                                        <button  @click.prevent="play(friend)">Играть</button>
                                        <i class="fa fa-circle online" v-if="friend.online"></i>
                                    </p>

                                </div>
                            </div>




                            <!--<ul class="list" style="overflow-y: hidden;overflow: auto;">-->
                                <!--<li class="clearfix" v-for="friend in filteredPeople" :key=friend.id>-->
                                    <!--<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01.jpg" alt="avatar" />-->
                                    <!--<img src="{{friend.photo}}" alt="avatar" />-->
                                    <!--<div class="about">-->
                                        <!--<div class="name">{{friend.name}}</div>-->
                                        <!--<div class="status">-->
                                            <!--<i class="fa fa-circle online" v-if="friend.online"></i>-->
                                            <!--<button  @click.prevent="play(friend)">Играть</button>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                <!--</li>-->
                            <!--</ul>-->

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-default" style="display: none" id="someElement"></button>
                    </div>
                </div>
            </div>
        </div>



    </div> <!-- end container -->

</template>

<script>

    import moment from '../../../../public/some.js';

    export default {
        name: 'chat-component',
        components: {
            moment
        },
        props: ['game_id', 'bet_id'],
        data(){
            return {
                friends:[],
                selectedCategory: "All",
                current_user: "",
                games: [],
                session_id: 0
            }
        },
        computed: {
            filteredPeople: function() {
                var vm = this;
                var category = vm.selectedCategory;

                if(category === "All") {
                    return vm.friends;
                } else {
                    return vm.friends.filter(function(friend) {

                        if (vm.selectedCategory == "Online"){
                            return friend.online == true;
                        }
                        if (vm.selectedCategory == "Offline"){
                            return friend.online === false;
                        }
                    });
                }
            },

        },
        mounted() {
            console.log('Component mounted.');
        },
        methods: {
            show () {
                this.$modal.show('hello-world');
            },
            hide () {
                this.$modal.hide('hello-world');
            },
            play: function (friend) {
                if ($("#game_id_for_vue").val() != 1)
                {
                    alert('Доделываем. \n' +
                        'Скоро будут.')
                }
                $('#users_list').modal('toggle');

                axios.post('/checkGameSession', {
                    game_id: $("#game_id_for_vue").val(),
                    friend_id: friend.id,
                    bet_id: $("#bet_id_for_vue").val()
                }).then(res => {
                    this.session_id = res.data.data;
                    console.log(res.data.error);
                        axios.post('/getGamePlay', {
                            game_id: $("#game_id_for_vue").val(),
                            friend_id: friend.id,
                            bet_id: $("#bet_id_for_vue").val(),
                            session_id: this.session_id
                        }).then(result => {
                            console.log(result.data.data);
                            openMathGameWindow(result.data.data)
                        });



                });


            },
            openGamePopU: function
            close(friend){
                friend.session.open = false;
            },
            getUsers(){
                axios.post('/getUsers/').then(res => (this.friends = res.data.data));
            },
            getCurrentUsers(){
                axios.post('/getCurrentUsers/').then(res => (this.current_user = res.data.data));
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
            this.getCurrentUsers();
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
    .status{
        color: black;
    }
    .name{
         color: black;
     }
    .small {
        padding: 0px;
    }
    .media{
        display: flow-root;
    }
</style>