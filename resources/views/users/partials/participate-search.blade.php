@if(count($usersParticipate)>0)
    @foreach($usersParticipate as $item)
        <li class="cursor add_participate"
            data-participate-id="{{$item->id}}"
            @if($item->user_type == 'work_individual')
            data-participate-fullname="{{$item->first_name.' '.$item->last_name}}"
            @else
            data-participate-fullname="{{$item->name}}"
                @endif
        >
            <a>  @if($item->user_type == 'work_individual')
                    {{$item->first_name.' '.$item->last_name}}
                @else
                    {{$item->name}}
                @endif</a>
        </li>
    @endforeach
@else
    <li class="">
        <a><span>No Data Found !</span></a>
    </li>
@endif