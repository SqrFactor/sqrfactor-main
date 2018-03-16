<!-- Modal -->
<div class="modal fade" id="usersLikeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{--<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-caret-up"></i> <span class="usersLikesPostCount"></span></h5>--}}
                <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                    <div class="ui-block ">
                        <ul class="widget w-friend-pages-added notification-list friend-requests user-post-likes-html">
                          {{-- @include('users.partials.users-like-li')--}}

                        </ul>
                    </div>
                </div>


        </div>
    </div>
</div>