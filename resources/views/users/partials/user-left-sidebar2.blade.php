<div class="col-xl-3 pull-xl-6 col-lg-6">
    <!-- Personal Info -->
    <div class="ui-block">
        <div class="ui-block-title">
            <h6 class="title">Announcements</h6>
        </div>
        <ul class="widget w-activity-feed notification-list w-announcements">
            <li class="text-center">Launching Feature soon!</li> </ul>
       {{-- <ul class="widget w-activity-feed notification-list w-announcements">
            <li>
                <div class="author-thumb">
                    <img src="{{ asset('assets/images/avatar-6.jpg') }}" alt="">
                </div>
                <div class="notification-event">
                    <a href="#" class="h6 notification-friend">Reinventing Gwalior’16 Event</a> Reinventing
                    Gwalior’16 Event was held in Gwalior on 28th and 29th of May 2016. Karan Shar....<a
                            href="#" class="link-inverse">readmore</a>.
                    <span class="notification-date"><time class="entry-date updated"
                                                          datetime="2004-07-24T18:18">2 mins ago</time></span>
                </div>
            </li>
            <li>
                <div class="author-thumb">
                    <img src="{{ asset('assets/images/avatar-5.jpg') }}" alt="">
                </div>
                <div class="notification-event">
                    <a href="#" class="h6 notification-friend">Reinventing Gwalior’16 Event</a> Reinventing
                    Gwalior’16 Event was held in Gwalior on 28th and 29th of May 2016. Karan Shar....<a
                            href="#" class="link-inverse">readmore</a>.
                    <span class="notification-date"><time class="entry-date updated"
                                                          datetime="2004-07-24T18:18">5 mins ago</time></span>
                </div>
            </li>
            <li>
                <div class="author-thumb">
                    <img src="{{ asset('assets/images/avatar-2.jpg') }}" alt="">
                </div>
                <div class="notification-event">
                    <a href="#" class="h6 notification-friend">Reinventing Gwalior’16 Event</a> Reinventing
                    Gwalior’16 Event was held in Gwalior on 28th and 29th of May 2016. Karan Shar....<a
                            href="#" class="link-inverse">readmore</a>.
                    <span class="notification-date"><time class="entry-date updated"
                                                          datetime="2004-07-24T18:18">12 mins ago</time></span>
                </div>
            </li>
            <li>
                <div class="author-thumb">
                    <img src="{{ asset('assets/images/avatar-3.jpg') }}" alt="">
                </div>
                <div class="notification-event">
                    <a href="#" class="h6 notification-friend">Reinventing Gwalior’16 Event</a> Reinventing
                    Gwalior’16 Event was held in Gwalior on 28th and 29th of May 2016. Karan Shar....<a
                            href="#" class="link-inverse">readmore</a>.
                    <span class="notification-date"><time class="entry-date updated"
                                                          datetime="2004-07-24T18:18">1 hour ago</time></span>
                </div>
            </li>
        </ul>--}}
    </div>

    <div class="ui-block">
        <div class="ui-block-content ui-block-content-sm">
            <form>
                <div class="form-group mb-3">
                    <input class="form-control form-control-lg" id="inviteEmail" placeholder="Invite your friends"
                           type="text">
                    <p class="errors" style="color: red;display: none"></p>
                </div>
                <a   class="btn btn-primary btn-block font-weight-bold mb-0 invite_friend"  data-path="{{ Request::path() }}"
                        style="height: 40px;color: white;cursor:pointer;">Send Invitation
                </a>
            </form>
        </div>
    </div>
</div>