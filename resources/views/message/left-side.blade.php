<div class="messages-col messages-col-left">
                <div class="form-group mb-0 search-messages-group">
                    <a href="#" class="messages-list-toggle messages-list-toggle-open"><i class="fa fa-bars"></i></a>
                    <div class="search-messages">
                        <input type="text" class="form-control" placeholder="Search Message">
                        <i class="fa fa-search"></i>
                    </div>
                    <a href="#" class="messages-list-toggle"><i class="fa fa-close"></i></a>
                </div>
                <div class="messages-list mCustomScrollbar" data-mcs-theme="dark">
                    

                    <!-- message list -->
                    <ul class="notification-list chat-message chat-message-list" v-for="privateMsg in privateMsgs">
                        <li @click="messages(privateMsg.id)">
    <div class="author-thumb">
        <img src="../assets/images/avatar-1.jpg" alt="author">
    </div>
    <div class="notification-event">
        <a href="#" class="h6 notification-friend mb-1"><span v-if="privateMsg.name == null"> @{{privateMsg.first_name}}  @{{privateMsg.last_name}}</span> <span v-else>@{{privateMsg.name}} </span></a>
        <span class="chat-message-item">Hi James! It’s Diana, I just wanted to let you know that we have to </span>
        <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">4 hours ago</time></span>
    </div>
    <span class="notification-icon">
        <svg class="olymp-chat---messages-icon"><use xlink:href="../assets/icons/icons.svg#olymp-chat---messages-icon"></use></svg>
    </span>

    <div class="more">
        <svg class="olymp-three-dots-icon"><use xlink:href="../assets/icons/icons.svg#olymp-three-dots-icon"></use></svg>
    </div>
</li>
                    </ul>
                </div>
        </div>