

<div class="more">
    <svg class="olymp-three-dots-icon">
        <use xlink:href="{{ asset('assets/icons/icons.svg#olymp-three-dots-icon') }}"></use>
    </svg>

    <ul class="more-dropdown">
      
           <li>
                <a href="{{route('competition.submit.design.edit',$item->id)}}" class="edit_post_submission" >Edit
                    Post</a>
            </li>
      
            <li>
                <a href="javascript:void(0)" class="delete_post_submission" data-submission-post-id="{{$item->id}}">Delete Post</a>
            </li>
        
       
    </ul>
</div>