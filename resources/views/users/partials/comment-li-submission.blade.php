

            <li>
                <div class="post__author author vcard inline-items">
                    <img src="{{asset($usersSubmissiondetail->user->profile)}}" alt="">

                    <div class="author-date">
                        <a class="h6 post__author-name fn" href="#">{{$usersSubmissiondetail->user->fullName()}}</a>
                        <div class="post__date">
                            <time class="published" datetime="2017-03-24T18:18">
                               {{$usersSubmissiondetail->created_at->diffForHumans()}}
                            </time>
                        </div>
                    </div>

                    <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="../assets/icons/icons.svg#olymp-three-dots-icon"></use></svg></a>

                </div>

                <p>{{$usersSubmissiondetail->body}}</p>

               
            </li>
            