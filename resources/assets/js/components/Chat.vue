<style scoped>
   .chat{
        width:100%;
        padding:20px;
        box-shadow: inset 0 0 20px 0 grey;
        margin-bottom: 20px;
        border: 1px solid grey;
        max-height: 600px;
        overflow-x: auto;
    }

    .chat .chat-right ,.chat .chat-left{
        max-width:200px;
        box-shadow:0 0 8px 0px grey;
        padding: 8px;
        margin-left: 4px;
    }

    .chat-right{
        float:right;
    }

    .chat-left{
        float:left;
    }

    .no-message{
        height:200x;
        display:flex;
        align-items:center;
    }
</style>
<template>
    <div class="panel-body">
        <div class="chats" v-if="chats.length != 0">
            <div v-for="chat in chats">
                <div class="chat-right " v-if="chat.user_from == userid" style="max-width:400px;box-shadow:0 0 8px 0px grey; padding: 8px;margin:10px;  float:right;">
                    {{chat.chat}}
                </div>
                <div class="chat-left" v-else style="max-width:400px;box-shadow:0 0 8px 0px grey;
                padding: 10px;margin: 10px; float:left;">
                    {{chat.chat}}
                </div>
            </div>
        </div>
        <div class="no-message" v-else>
            <p>There is no message!</p>
        </div> 
        <chat-composer v-bind:userid="userid" v-bind:chats="chats" v-bind:friendid="friendid"></chat-composer>
    </div>
</template>

<script>
    export default {
        props: ['chats','userid','friendid'],
    }
</script>
