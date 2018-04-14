<template>
    <div>
        <div class="panel-body" style="height:650px;">
        <div  style="height:500px;width:99.9%;overflow:scroll;" class="scroll">
        <div  class="chats" v-if="chats.length != 0"  >
            <ul class="notification-list chat-message chat-message-field" >
                <li v-for="chat in chats" >
                    <div class="chat-right " v-if="chat.user_from == userid" style="width:100%">
                        <div class="media" style="border-bottom:1px solid #F3F4F8; padding-bottom:10px;">
                            <img class="d-flex author-thumb" v-if="user.profile.substring(0,1)=='h'" :src="user.profile" alt="author">
                            <img class="d-flex author-thumb" v-else :src="'http://localhost:8000/'+user.profile" alt="author">
                            <div class="media-body">
                                        <div class="notification-event" >
                                            <div class="clearfix" >
                                                <a href="#" class="h6 notification-friend" v-if="user.first_name == null">
                                                      {{user.name}}
                                                </a>
                                                <a href="#" class="h6 notification-friend" v-else>
                                                  
                                                    {{user.first_name}}&nbsp{{user.last_name}}
                                                </a>
                                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">{{chat.created_at | moment}}</time></span>
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
                                    <img class="d-flex author-thumb"  v-if="friend.profile.substring(0,1)=='h'"" :src="friend.profile" alt="author">
                                      <img class="d-flex author-thumb"  v-else :src="'http://localhost:8000/'+friend.profile" alt="author">
                                    <div class="media-body" style="width:100%">
                                        <div class="notification-event" >
                                            <div class="clearfix" >
                                                <a href="#" class="h6 notification-friend">
                                                {{friend.first_name}}&nbsp{{friend.last_name}}
                                                </a>
                                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">{{chat.created_at | moment}}</time></span>
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
                    <br><br>
                    <center>
                        <h4>There is no message to display!</h4>
                    </center>
                </div> 
            </div>         
        </div> 
        <chat-composer v-bind:userid="userid" v-bind:chats="chats" v-bind:friendid="friendid"></chat-composer>
    </div>
</template>

<script>
    export default {
        props: ['chats','userid','friendid','user','friend'],
        filters: {
            moment: function (date) {
                return moment(date).format('MMMM Do YYYY, h:mm:ss a');
            }
        },
        updated(){

            var container = document.querySelector(".scroll");
            console.log(container.clientHeight);
            container.scrollTop = 12000;
        }
    }  
</script>
