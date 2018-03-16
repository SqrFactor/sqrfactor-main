<div class="col-md-12">
   
    <div class="form-group label-floating">
        <ul class="widget w-friend-pages-added notification-list friend-requests user-post-likes-html"><input type="hidden" class="postLikesUserss" value="1">
        @if(count($joblist) > 0)    
        @foreach($joblist as $list)
          
        <li class="inline-items">
        <div class="author-thumb">
            <img src="{{asset($list->user->profile)}}" alt="">
        </div>
        <div class="notification-event">
            <a href="{{route('profileView',$list->user->user_name)}}" class="h6 notification-friend">{{$list->user->user_name}}</a>
            
        </div>
        </li>
         @endforeach
         @else
         <li class="inline-items">
            
            <div class="notification-event">
                <a href="#" class="h6 notification-friend">NO  applicant found</a>
                
            </div>
        </li>
        @endif


    </ul>
    </div>
   
    
</div>