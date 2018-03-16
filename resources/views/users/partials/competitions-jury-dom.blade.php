@if(count($usersCompetitionsJury)>0)
    @foreach($usersCompetitionsJury as $item)
        <li class="cursor add_Jury"
            data-jury-id="{{$item->id}}"
            data-jury-email="{{$item->email}}"
            data-jury-mobile="{{$item->mobile_number}}"
            data-jury-fullname="{{ $item->first_name . " " . $item->last_name }}">
            <a>{{ $item->first_name . " " . $item->last_name }}</a>
        </li>
    @endforeach
@else
    <li class="">
        <a><span>No Data Found !</span></a>
    </li>
@endif