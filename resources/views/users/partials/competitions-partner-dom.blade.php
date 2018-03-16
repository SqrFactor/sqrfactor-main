@if(count($usersCompetitionsJury)>0)
    @foreach($usersCompetitionsJury as $item)
        <li class="cursor add_partner"
            data-partner-id="{{$item->id}}"
            data-partner-email="{{$item->email}}"
            data-partner-mobile="{{$item->mobile_number}}"
            data-partner-fullname="{{ $item->name}}">
            <a>{{ $item->name }}</a>
        </li>
    @endforeach
@else
    <li class="">
        <a><span>No Data Found !</span></a>
    </li>
@endif