<template> 
<div>
    <div class="panel-body" style="height:650px;" >
   
    <div style="height:79%;width:99.8%;;" class="inside-chat-cont scrollbar scrollbar-primary" id="in-chat-cont" >
        <div class="chats" v-if="chats.length != 0" id="chat_contain" >
            <ul class="notification-list chat-message chat-message-field">

                <li v-for="chat in chats" >
                    <div class="chat-right " v-if="chat.user_from == userid" style="width:100%">
                        <div class="media" style="border-bottom:1px solid #F3F4F8; padding-bottom:10px;">
                            <img class="d-flex author-thumb" src="" alt="author">
                            <div class="media-body">
                                <div class="notification-event" >
                                    <div class="clearfix" >
                                        <a href="#" class="h6 notification-friend">Elaine Dreyfuss</a>
                                        <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 8:10pm</time></span>
                                    </div>
                                    <span class="chat-message-item">
                                        {{chat.chat}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-left" v-else style="width:100%">
                        <div class="media" style="border-bottom:1px solid #F3F4F8; padding-bottom:10px;">
                            <img class="d-flex author-thumb" src="" alt="author">
                            <div class="media-body" >
                                <div class="notification-event" >
                                    <div class="clearfix" >
                                        <a href="#" class="h6 notification-friend">John Enosh</a>
                                        <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 8:10pm</time></span>
                                    </div>
                                    <span class="chat-message-item">
                                        {{chat.chat}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </li>

            </ul>
            
        </div>
        <div class="no-message" v-else>
            <p>There is no message!</p>
        </div> 
         </div> 
        
    </div>
    

    <chat-composer v-bind:userid="userid" v-bind:chats="chats" v-bind:friendid="friendid"></chat-composer>
    </div>
</template>

<script>
    export default {
        props: ['chats','userid','friendid'],
        
    }

    
</script>