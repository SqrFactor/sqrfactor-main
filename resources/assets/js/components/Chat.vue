<style scoped>
     .chat-right{
        float:right;
    }

    .chat-left{
        float:left;
    }
</style>
<template>
    <div class="container">
        <div class="chats" v-if="chats.length != 0">
            <div v-for="chat in chats">
                <div class="chat-right pull-right" v-if="chat.user_from == userid" style="max-width:400px;box-shadow:0 0 8px 0px grey;
                padding: 8px;margin:10px;  border-radius:10px;">
                    {{chat.chat}}
                </div>
                <div class="chat-left pull-left" v-else style="max-width:400px;box-shadow:0 0 8px 0px grey;
                padding: 10px;margin: 10px; border-radius:10px;">
                    {{chat.chat}}
                </div>
            </div>
        </div>
        <div class="no-message" v-else>
            <p>There is no message!</p>
        </div> 
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <chat-composer v-bind:userid="userid" v-bind:chats="chats" v-bind:friendid="friendid"></chat-composer>
    </div>
</template>

<script>
    export default {
        props: ['chats','userid','friendid'],
    }
</script>
