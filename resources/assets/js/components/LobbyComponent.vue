<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card card-default">
                    <div class="card-header">Список игроков</div>

                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="user in users">{{ user.name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9"></div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                users:[]
            }
        },
        methods:{
            getUsers(){
                axios.post('getUsers').then(res => this.users = res.data.data)
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
    li {
        color: black;
    }
</style>