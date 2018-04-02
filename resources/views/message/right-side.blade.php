<!-- right column -->
            <div class="messages-col messages-col-right">
                <!-- chat field -->
                <div class="chat-field">
                    <div class="ui-block-title" >
                        <h6 class="title" >
                        </h6>
                        <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="../assets/icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
                    </div>
                    <div class="chat-field-content mCustomScrollbar" data-mcs-theme="dark">
                        <ul class="notification-list chat-message chat-message-field" v-for='singleMsg in singleMsgs'>
                           

                            <li>
    <div class="media">
        <img class="d-flex author-thumb" src="../assets/images/avatar-1.jpg" alt="author">
        <div class="media-body">
            <!-- <div  v-if="singleMsg.msg.length == null">No Message</div> -->
            <div class="notification-event">
                <div class="clearfix">
                    <a href="#" class="h6 notification-friend"><span v-if="singleMsg.name == null"> @{{singleMsg.first_name}}  @{{singleMsg.last_name}}</span> <span v-else>@{{singleMsg.name}} </span></a>
                    <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 8:10pm</time></span>
                </div>
                <span class="chat-message-item">
                @{{singleMsg.msg_db}}
                </span>
                 
            </div>
        </div>
    </div>
</li>
                        </ul>
                    </div>
                    <form class="messages-form clearfix"  >
    <div class="form-group">
        <input type="hidden" v-model='conID' >
         <textarea class="form-control" placeholder="Write your reply here..." v-model='chatMsg' @keydown='inputHandler'  rows="2" style="height:40px !important ;" ></textarea>
    </div>
    <i class="fa fa-send"></i>
</form>
                </div>
                <!-- end chat field -->
            </div>
            <!-- end right column -->
        

