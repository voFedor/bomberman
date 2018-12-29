<template>
    <div class="container clearfix" style="margin: 0 auto;background: #444753;border-radius: 5px;">

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