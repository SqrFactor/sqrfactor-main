
<template>
    <div class="panel-body">
        <form class="messages-form clearfix">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Write your reply here..."
                 v-on:keyup.enter.prevent="sendChat"
                 v-model="chat">
            </div>
            <i class="fa fa-send fa-primary"  v-on:click="sendChat" ></i>
        </form>
    </div>
</template>

<script>
    export default {
        props:['chats','userid','friendid'],
        data(){
            return{
                chat:''
            }
        },
        methods: {
            sendChat: function(e){
                if(this.chat != ''){
                    var data = {
                        chat: this.chat,
                        friend_id: this.friendid,
                        user_id: this.userid
                    }
                    this.chat = '';
                    axios.post('/myallMSG/sendChat',data).then((response)=>{
                        this.chats.push(data)
                    });
                }
            },
        }
    }
</script>
