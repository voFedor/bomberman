<template>
    <ul class="chat" style="margin: 0 0 10px 5px;">
        <li v-for="message in messages">
            <img src="http://s8.postimg.org/76bg2es2t/index.png">
            <span>{{ message.user.name }}</span>
            <div class="message"> {{ message.message }}</div>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['messages']
    };
</script>