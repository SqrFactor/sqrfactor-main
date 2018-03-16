<div class="more">
    <svg class="olymp-three-dots-icon">
        <use xlink:href="{{ asset('assets/icons/icons.svg#olymp-three-dots-icon') }}"></use>
    </svg>
    <ul class="more-dropdown">
        <li><a href="{{ route('postDetail',$post->slug) }}">Full View</a></li>
        @if($post->user->id == Auth::user()->id)
            <li>
                <a href="@if($post->type == 'status') {{ route('post.status.edit',$post->slug) }} @elseif($post->type == 'article') {{ route('post.article.edit',$post->slug) }} @elseif($post->type == 'design') {{ route('post.design.edit',$post->slug) }} @endif ">Edit
                    Post</a>
            </li>
        @endif
        
        @if($post->user->id == Auth::user()->id )
            <li>
                <a href="javascript:void(0)" class="delete_post" data-users_post_id="{{ $post->user_post_id }}"
                   data-is-shared="{{ $post->is_shared }}" data-post-id="{{ $post->shared_id }}">Delete Post</a>
            </li>
        @endif
        @if($post->user->id == Auth::user()->id)
            @if($post->type != "status")
                <li>
                    <a href="javascript:void(0)"
                       class="select_as_featured" data-post-id="{{ $post->shared_id }}"
                       data-is-shared="{{ $post->is_shared }}">
                        @if($post->isFeatured($post->id))
                            Remove from Featured
                        @else
                            Select as Featured
                        @endif
                    </a>
                </li>
            @endif
        @endif
    </ul>
</div>