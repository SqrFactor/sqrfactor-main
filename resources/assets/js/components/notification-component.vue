<template>
	<div class="control-icon more has-items"  v-on:click="open = !open">
                    <i class="fa fa-bell-o"></i>
                    <div class="label-avatar bg-primary notification-badge" style="display: none;">0</div>
                    <div class="more-dropdown notifiction-custom more-with-triangle header-notification-dropdown">
                        <div class=" ui-block-title ui-block-title-small">
                            <h6 class="title">Notifications</h6>
                        </div>
                        <div class="mCustomScrollbar" data-mcs-theme="dark">
                            <ul class="notification-list realtime-notification" v-if="open" >
                                <!-- <br>
                                <p class="text-center"><img src='{{asset('/img/ajax-loader.gif')}}'></p> -->

                                                                 <li >
                    <div class="media">
                      <img class="author-thumb" src="" alt="author">
                      <div class="media-body">
                        <div class="notification-event">
                          <div><a href="#" class="h6 notification-friend">Mathilda Brinker</a> commented on your new <a href="#" class="notification-link">profile status</a></div>
                          <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">4 hours ago</time></span>
                        </div>
                        <div class="more">
                          <svg class="olymp-little-delete">
                            <use xlink:href="../assets/icons/icons.svg#olymp-little-delete"></use>
                          </svg>
                        </div>
                      </div>
                    </div>
                  </li>

                            </ul>
                        </div>
                        <a href="#" class="view-all bg-primary">View All Notifications</a>
                    </div>
                </div>

</template>

<script >
	export default {
		props: ['allNotifications']
	}
</script>