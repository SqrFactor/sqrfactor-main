
    @if(count($userCollegeUniversity)>0)
    @foreach($userCollegeUniversity as $collegeUniversity)
    <li>
        <a class="college_li_data" data-type="@if($typeValid == 'y'){{$collegeUniversity->user_type}}@endif" 
            data-id="@if($typeValid == 'y'){{$collegeUniversity->id}}@endif" 
            data-college-name='{{$collegeUniversity->name}}'><img src='{{asset($collegeUniversity->profile)}}'><span>{{$collegeUniversity->name}}</span></a>
    </li>
    @endforeach
    @else
    <li class="text-center">
        <a class=""><span>No Data Found !</span></a>
    </li>
    @endif()
    <li class="text-center">
        <a class="add_college"><img style="height: 16px;width: 16px;" src="{{asset('assets/images/plus.png')}}"><span>Add Other</span></a>
    </li>