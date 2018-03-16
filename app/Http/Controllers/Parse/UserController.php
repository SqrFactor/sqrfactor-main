<?php

namespace App\Http\Controllers\Parse;

use App\City;
use App\CollegeCompanyFeed;
use App\Comment;
use App\FollowUser;
use App\Http\Controllers\Controller;
use App\ImagesForCompression;
use App\Jobs\CompressImage;
use App\Like;
use App\Mail\Invitation;
use App\Mail\Welcome;
use App\Notifications\InvitationNotification;
use App\Portfolio;
use App\State;
use App\User;
use App\UserCompetition;
use App\UserCompetitionDesignSubmition;
use App\UserCompetitionJury;
use App\UserCompetitionPartner;
use App\UserDetail;
use App\UsersCompetitionDesignSubmitionAward;
use App\UsersCompetitionDesignSubmitionAwardItem;
use App\UsersCompetitionsAttachment;
use App\UsersEducationDetail;
use App\UsersEmail;
use App\UsersOtherDetail;
use App\UsersPost;
use App\UsersPostShare;
use App\UsersProfessionalDetail;
use App\VerifyOtp;
use Auth;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Image;
use Mail;
use Response;
use Validator;


class UserController extends Controller
{
    public function profileEmailUpdate(Request $request)
    {
        $rules = array(
            'email' => 'required|email|unique:users,email',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessagebag()->toArray(),
            ]);
        } else {
            $password = rand(111111, 999999);
            User::where('id', Auth::id())->update(
                [
                    'email' => $request->email,
                    'password' => bcrypt($password),

                ]);


            Mail::send("emails.login-password", [
                'password' => $password,
            ], function ($m) use ($request) {
                $m->to($request->email)->subject('sqrfactor login password');
            });

            return response()->json([
                'success_message' => 'Update successfully'
            ]);


        }
    }

    public function country(Request $request)
    {
        if (!empty($request->country)) {
            $states = State::where('country_id', $request->country)->orderBy('name', 'asc')->get();
            echo '<option selected disabled>Select State</option>';
            foreach ($states as $state) {
                echo '<option value="' . $state->id . '">' . $state->name . '</option>';
            }
            /*return response()->json([
                'states' => $states,
            ]);*/


        }


    }

    public function state(Request $request)
    {
        if (!empty($request->state)) {
            $cities = City::where('state_id', $request->state)->orderBy('name', 'asc')->get();
            echo '<option selected disabled>Select City</option>';
            foreach ($cities as $city) {
                echo '<option value="' . $city->id . '">' . $city->name . '</option>';
            }
        }


    }

    public function changeProfile(Request $request)
    {

        $rules = array(
            'profile_image' => 'required',
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->getMessageBag()->toArray(),
            ]);
        } else {

            /* base64 banner image saved*/
            if (!empty($request->profile_image)) {

                $bannerImageFileName = md5(time() . rand(0000, 9999)) . ".jpg";
                $bannerImagePath = public_path() . "/storage/images/" . $bannerImageFileName;

                Image::make(file_get_contents($request->profile_image))->save($bannerImagePath);

                $bannerImageSave = "storage/images/" . $bannerImageFileName;


                /*image compression*/
                $filepath = public_path('storage/images/' . $bannerImageFileName);
                $saveImageForCompression = new ImagesForCompression();
                $saveImageForCompression->url = $filepath;
                $saveImageForCompression->status = "n";
                $saveImageForCompression->save();
                dispatch(new CompressImage());

            }
            User::where('id', Auth::id())->update([
                'profile' => $bannerImageSave
            ]);

            return response()->json([
                'profile_image' => $bannerImageSave,
            ]);


        }

    }

    /*short bio*/
    public function short_bio(Request $request)
    {

        $rules = array(
            'short_bio' => 'required',
        );

        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->getMessageBag()->toArray(),
            ]);
        } else {
            $request->user()->userDetail->update([
                'short_bio' => $request->short_bio,
            ]);
        }
    }
    /*end short bio*/

    /*other detail*/
    public function workOtherDetail(Request $request)
    {
        //dynamic validation
        $rules = [];
        $message = [];

        foreach ($request->award as $key => $value) {
            $rules['award.' . $key] = "required";
            $rules['award_name.' . $key] = "required";
            $rules['project_name.' . $key] = "required";
            $rules['services_offered.' . $key] = "required";

            $message['award.' . $key . ".required"] = "Award filed in required";
            $message['award_name.' . $key . ".required"] = "Award Name filed in required";
            $message['project_name.' . $key . ".required"] = "Project Name filed in required";
            $message['services_offered.' . $key . ".required"] = "Services Offered filed in required";
        }

        $this->validate($request, $rules, $message);

        UsersOtherDetail::where('user_id', Auth::id())->delete();
        foreach ($request->award as $key => $value) {
            if ($value != null) {
                UsersOtherDetail::where('user_id', Auth::id())->create([
                    'user_id' => Auth::id(),
                    'slug' => str_slug($value . '-' . rand(10000, 99999)),
                    'award' => $value,
                    'award_name' => $request->award_name[$key],
                    'project_name' => $request->project_name[$key],
                    'services_offered' => $request->services_offered[$key],
                ]);
            }
        }
    }
    /*end other detail*/

    /*work-professional-details*/
    public function workProfessionalDetails(Request $request)
    {
        //Dynamic validation
        $rules = [];

        $message = [];

        foreach ($request->role as $key => $value) {
            //rules
            $rules['role.' . $key] = 'required';
            $rules['company_firm_or_college_university.' . $key] = 'required';
            $rules['start_date.' . $key] = 'required';
            $rules['end_date_of_working_currently.' . $key] = 'required';
            $rules['salary_stripend.' . $key] = 'required|numeric';

            //message
            $message['role.' . $key . '.required'] = "Role field is required";
            $message['company_firm_or_college_university.' . $key . '.required'] = "Company Firm Or College/University field is required";
            $message['start_date.' . $key . '.required'] = "Start date field is required";
            $message['end_date_of_working_currently.' . $key . '.required'] = "End date field is required";
            $message['salary_stripend.' . $key . '.required'] = "Salary field is required";
            $message['salary_stripend.' . $key . '.numeric'] = " Salary field must be a number";
        }

        $this->validate($request, $rules, $message);

        UserDetail::where('user_id', Auth::id())->update([
            'coa_registration' => $request->coa_registration,
            'years_since_service' => $request->years_since_service,
        ]);

        UsersProfessionalDetail::where('user_id', Auth::id())->delete();

        foreach ($request->role as $key => $role) {
            if ($role != null) {
                $professional = new UsersProfessionalDetail();
                $professional->user_id = Auth::id();
                $professional->slug = str_slug(str_random(15));
                $professional->role = str_slug(str_random(15));


                if (!empty($request->company_firm_or_college_university_type[$key])) {

                    $getCount = User::where('id', $request->company_firm_or_college_university_id[$key])->where('user_type', $request->company_firm_or_college_university_type[$key])->where('name', $request->company_firm_or_college_university[$key])->count();
                    if ($getCount > 0) {
                        $professional->company_college_type = $request->company_firm_or_college_university_type[$key];
                        $professional->company_firm_or_college_university_id = $request->company_firm_or_college_university_id[$key];
                        $professional->company_firm_or_college_university = null;
                    } else {
                        $professional->company_college_type = null;
                        $professional->company_firm_or_college_university_id = null;
                        $professional->company_firm_or_college_university = $request->company_firm_or_college_university[$key];
                    }

                } else {
                    $professional->company_college_type = null;
                    $professional->company_firm_or_college_university_id = null;
                    $professional->company_firm_or_college_university = $request->company_firm_or_college_university[$key];
                }

                $professional->start_date = $request->start_date[$key];

                $professional->end_date_of_working_currently = $request->end_date_of_working_currently[$key];
                $professional->salary_stripend = $request->salary_stripend[$key];
                $professional->save();

                /*UsersProfessionalDetail::create([
                    'user_id' => Auth::id(),
                    'slug' => str_slug(str_random(15)),
                    'role' => str_slug(str_random(15)),
                    'company_firm_or_college_university' => $request->company_firm_or_college_university[$key],
                    'start_date' => $request->start_date[$key],
                    'end_date_of_working_currently' => $request->end_date_of_working_currently[$key],
                    'salary_stripend' => $request->salary_stripend[$key],
                ]);*/
            }
        }
    }

    /* end work-professional-details*/

    /*
     * Save Work Education details
     * */
    public function workEducationDetail(Request $request)
    {
        //Dynamically Generate Rules
        $rules = [];
        $message = [];

        foreach ($request->course as $key => $value) {
            //rules
            $rules['course.' . $key] = 'required';
            $rules['college_university.' . $key] = 'required';
            $rules['year_of_admission.' . $key] = 'required';
            $rules['year_of_graduation.' . $key] = 'required';

            //Messages
            $message['course.' . $key . '.required'] = 'Course field is required';
            $message['college_university.' . $key . '.required'] = "College/University field is required";
            $message['year_of_admission.' . $key . '.required'] = 'Year of Admission field is required';
            $message['year_of_graduation.' . $key . '.required'] = 'Year of Graduation field is required';
        }

        $this->validate($request, $rules, $message);

        UsersEducationDetail::where('user_id', Auth::id())->delete();

        foreach ($request->course as $key => $value) {
            if ($value != null) {
                $education = new  UsersEducationDetail();
                $education->user_id = Auth::id();
                $education->course = $value;
                if (!empty($request->college_university_id[$key])) {
                    $education->college_university = null;
                    $education->college_university_id = $request->college_university_id[$key];
                } else {
                    $education->college_university = $request->college_university[$key];
                    $education->college_university_id = null;
                }
                $education->year_of_admission = $request->year_of_admission[$key];
                $education->year_of_graduation = $request->year_of_graduation[$key];
                $education->save();
                /*UsersEducationDetail::create([
                    'slug' => str_slug($value . '-' . rand(1010, 9909)),
                    'user_id' => Auth::id(),
                    'course' => $value,
                    'college_university' => $request->college_university[$key],
                    'year_of_admission' => $request->year_of_admission[$key],
                    'year_of_graduation' => $request->year_of_graduation[$key],
                ]);*/
            }
        }

        if (Auth::user()->first_name !== null && Auth::user()->last_name !== null && Auth::user()->userDetail->country_id !== null && Auth::user()->userDetail->state_id !== null && Auth::user()->userDetail->city_id !== null && Auth::user()->userDetail->gender !== null && Auth::user()->mobile_number !== null && Auth::user()->usersEducationDetails->first() != null && Auth::user()->usersEducationDetails->first()->course != null && Auth::user()->usersEducationDetails->first()->college_university != null && Auth::user()->usersEducationDetails->first()->year_of_admission != null && Auth::user()->usersEducationDetails->first()->year_of_graduation != null) {
            User::where('id', Auth::id())->update([
                'profile_flag' => 'y'
            ]);
        }

        return response()->json([
            'successMessage' => 'saved successfully..',
        ]);
    }

    /* end workEducationDetail*/

    public function workIndividualBasic(Request $request)
    {
        $messages = [
            'email.unique:users_email' => 'This email is already exists in user temps table',
            'email.unique:users' => 'This email is already exists in users table',
        ];


        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'facebook_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            /* 'pin_code' => 'nullable|numeric',*/
            'aadhar_id' => 'nullable|numeric',
            'date_of_birth' => 'required',
            /*'address' => 'nullable|max:100',*/
            'short_bio' => 'nullable|max:150',
            /*'describe_yourself' => 'nullable|max:500',*/

        );

        $validation = Validator::make(Input::all(), $rules, $messages);
        if ($validation->fails()) {
            return Response()->json([
                'errors' => $validation->getMessageBag()->toArray(),
            ]);
        } else {
            /*implode occupation value */
            if (!empty($request->occupation)) {
                $occupation = implode(',', $request->occupation);
            } else {
                $occupation = null;
            }


            /*save data*/
            if (!empty($request->email)) {
                UsersEmail::where('user_id', Auth::id())->delete();
                foreach ($request->email as $email) {
                    if ($email != null) {
                        UsersEmail::create([
                            'user_id' => Auth::id(),
                            'email' => $email,
                        ]);
                    }

                }
            }


            User::where('id', Auth::id())->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,

            ]);

            UserDetail::where('user_id', Auth::id())->update([
                'gender' => $request->gender,
                'aadhar_id' => $request->aadhar_id,
                'address' => $request->address,
                'occupation' => $occupation,
                'pin_code' => $request->pin_code,
                'country_id' => $request->country,
                'state_id' => $request->state,
                'city_id' => $request->city,
                'short_bio' => $request->short_bio,
                'facebook_link' => $request->facebook_link,
                'twitter_link' => $request->twitter_link,
                'linkedin_link' => $request->linkedin_link,
                'instagram_link' => $request->instagram_link,
                'date_of_birth' => $request->date_of_birth,


            ]);

        }
    }

    /*add email*/
    public function emailAdd(Request $request)
    {
        $rules = array(
            'email' => 'email|unique:users_email,email|unique:users,email',
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->getMessageBag()->toArray(),
            ]);
        }
    }

    /*end add email*/


    public function addEmailMore(Request $request)
    {

        /*save data*/
        if (!empty($request->email)) {

            foreach ($request->email as $email) {
                if ($email != null) {
                    UsersEmail::create([
                        'user_id' => Auth::id(),
                        'email' => $email,
                    ]);
                }

            }
        }

        return response()->json([
            'successMsg' => 'saved successfully',
        ]);
    }

    public function removeEmail(Request $request)
    {
        if ($request->id != null) {
            UsersEmail::where('id', $request->id)->where('user_id', Auth::id())->delete();
        }

        response()->json([
            'successMsg' => 'Removed successfully',
        ]);


    }

    public function follow(Request $request)
    {

        if ($request->to_user != null) {
            $count = FollowUser::where('from_user', $request->user()->id)->where('to_user', $request->to_user);

            if ($count->count() > 0) {
                $count->delete();

                $message = [
                    'return' => false,
                    'message' => 'UnFollow',
                    'following_count' => User::findOrFail($request->to_user)->following->count(),
                    'follower_count' => User::findOrFail($request->to_user)->follower->count(),
                    'from_user' => User::where("id", $request->user()->id)->first()
                ];
            } else {
                FollowUser::create([
                    'from_user' => $request->user()->id,
                    'to_user' => $request->to_user,
                ]);

                $message = [
                    'return' => true,
                    'message' => 'Follow',
                    'following_count' => User::findOrFail($request->to_user)->following->count(),
                    'follower_count' => User::findOrFail($request->to_user)->follower->count(),
                    'from_user' => User::where("id", $request->user()->id)->first()
                ];
            }

            return response()->json($message);


        }

    }

    /*like*/
    public function like(Request $request)
    {

        if (!empty($request->likeable_id) && !empty($request->likeable_type)) {

            /*Likeable type*/
            if ($request->likeable_type == "users_post_share") {
                $likeable_type = 'App\UsersPostShare';

                $usersPost = $likeable_type::selectRaw('users_post_share.id as shared_id')->where('id', $request->likeable_id)->first();
            }

            if ($request->likeable_type == "comments") {
                $likeable_type = 'App\Comment';
                $usersPost = $likeable_type::where('id', $request->likeable_id)->with('usersPost')->first();
            }


            $like = Like::where('user_id', Auth::id())->where('likeable_id', $request->likeable_id)->where('likeable_type', $likeable_type);


            if ($like->count() > 0) {
                $like->delete();

                $message = [
                    'return' => 'false',
                    'message' => 'UnLiked Successfully.',
                    'count' => $usersPost->likes->count(),

                ];

            } else {


                Like::create([
                    'user_id' => $request->user()->id,
                    'likeable_id' => $request->likeable_id,
                    'likeable_type' => $likeable_type,
                ]);

                $message = [
                    'return' => 'true',
                    'message' => 'Liked Successfully.',
                    'count' => $usersPost->likes->count(),
                    'from_user' => Auth::user(),
                    'post' => $usersPost,

                ];
            }

            return response()->json($message);
        }
    }


    /*comments*/

    public function comment(Request $request)
    {

        $is_shared = $request->is_shared;
        $post_id = $request->commentable_id;


        $rules = array(
            'comment_text' => 'required',
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->getMessageBag()->toArray(),
            ]);
        } else {
            if ($request->commentable_id != null) {


                $comment = Comment::create([
                    'user_id' => $request->user()->id,
                    'commentable_id' => $request->commentable_id,
                    'commentable_type' => 'App\UsersPostShare',
                    'body' => $request->comment_text,
                ]);

                $commentLastInsert = Comment::findOrFail($comment->id);

                $message = [
                    'return' => 'true',
                    'message' => 'Commented successfully.',
                    'comment' => $commentLastInsert,
                    'user' => $commentLastInsert->user,
                    'created_at' => $commentLastInsert->created_at->diffForHumans(),
                    'comment_count' => UsersPostShare::findOrFail($post_id)->comments->count(),
                    'post' => UsersPostShare::where("id", $request->commentable_id)->first()
                ];

            } else {
                $message = [
                    'return' => 'false',
                    'message' => 'Oops Something went wrong.',
                ];
            }
        }

        return response()->json($message);
    }

    public function searchFollowFriend(Request $request)
    {

        if ($request->val_name != null && $request->search_type != null && $request->user_id != null) {


            $results = User::where('active', '1')->where('first_name', 'like', '%' . $request->val_name . '%')->orWhere('last_name', 'like', '%' . $request->val_name . '%')->orWhere('name', 'like', '%' . $request->val_name . '%')->get();

            $follow_u = FollowUser::where('from_user', $request->user_id)->get();

            if ($request->search_type == 'following') {

                $follow_u = FollowUser::where('from_user', $request->user_id)->get();
            } elseif ($request->search_type == 'followers') {

                $follow_u = FollowUser::where('to_user', $request->user_id)->get();
            }

            $searched_users = [];
            $follow_users = [];
            foreach ($results as $result) {
                if (!in_array($result->id, $searched_users)) {
                    array_push($searched_users, $result->id);
                }
            }

            foreach ($follow_u as $users) {

                if ($request->search_type == 'following') {
                    $search_type = $users->to_user;
                } elseif ($request->search_type == 'followers') {
                    $search_type = $users->from_user;
                }

                if (!in_array($search_type, $follow_users)) {
                    array_push($follow_users, $search_type);
                }
            }
            /*array_intersect($follow_users,$searched_users);
            print_r($follow_users);
            print_r($searched_users);

            print "<br>";*/

            $final_users = array_intersect($follow_users, $searched_users);

            $users = User::findMany($final_users);
            if (count($users)) {

                foreach ($users as $user) {
                    echo '<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <div class="ui-block">
                            <div class="friend-item">
                                <div class="friend-item-content">
                                    <div class="more">
                                        <svg class="olymp-three-dots-icon">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="' . asset('assets/icons/icons.svg#olymp-three-dots-icon') . '"></use>
                                        </svg>
                                        <ul class="more-dropdown">
                                            <li>
                                                <a href="javascript:void(0)" class="launching_soon">Report Profile</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="launching_soon">Block Profile</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="launching_soon">Turn Off Notifications</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="friend-avatar">
                                        <div class="author-thumb">
                                            <img src="' . asset($user->profile) . '" alt="">
                                        </div>
                                        <div class="author-content">
                                            <a href="' . route('profileView', $user->slug) . '" class="h6 author-name">' . $user->fullName() . '</a>
                                            
                                            <div class="country">

                                                                                                    ' . $user->fullAddress() . '
                                                                                            </div>
                                        </div>
                                    </div>
                                    <div class="friend-count" data-swiper-parallax="-500">
                                        <a href="javascript:void(0)" class="friend-count-item">
                                            <div class="h6">0</div>
                                            <div class="title">Friends</div>
                                        </a>
                                        <a href="javascript:void(0)" class="friend-count-item">
                                            <div class="h6">0</div>
                                            <div class="title">Photos</div>
                                        </a>
                                        <a href="javascript:void(0)" class="friend-count-item">
                                            <div class="h6">0</div>
                                            <div class="title">Videos</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo "<div class=\"col-sm-12 col-xs-12\">
                            <div class=\"\">
                                <div class=\"friend-item\"><h3 class='text-center'>Data Not Found</h3></div></div></div>";
            }


        }


    }

    public function postView(Request $request)
    {
        $usersPostShareid = $request->post_id;
        $is_shared = $request->is_shared;
        $usersPostId = $request->usersPostId;

        $user_like_posts = Like::select("likeable_id")->where('user_id', Auth::id())->get()->toArray();
        $user_like_posts_array = [];
        foreach ($user_like_posts as $user_like_post) {
            array_push($user_like_posts_array, $user_like_post['likeable_id']);
        }


        /*$shared_posts = UsersPostShare::selectRaw("users_post.*,users_post.id as user_post_id, is_shared,(SELECT COUNT(comments.id) FROM comments WHERE commentable_id =users_post_share.id) as comments_count,users_post_share.user_id as shared_user,users_post_share.id as shared_id")
            ->join('users_post','users_post.id','=','users_post_share.users_post_id')
            ->where('users_post_share.users_post_id', $usersPostId)
            ->where('users_post_share.is_shared',$is_shared)
            ->with('commentsLimited.likes','commentsLimited.user','likes','sharedUser','user')->first();*/


        $shared_posts = UsersPostShare::selectRaw("users_post.*,users_post.id as user_post_id, is_shared,(SELECT COUNT(comments.id) FROM comments WHERE commentable_id =users_post_share.id) as comments_count,users_post_share.user_id as shared_user,users_post_share.id as shared_id")
            ->join('users_post', 'users_post.id', '=', 'users_post_share.users_post_id')
            ->where('users_post_share.id', $usersPostShareid)
            ->with('commentsLimited.user', 'commentsLimited.likes', 'likes', 'sharedUser', 'user')
            ->orderBy('users_post_share.id', 'desc')->first();


        /*$usersPost = UsersPost::where('id', $request->post_id)->where('slug', $request->post_slug);*/
        if (count($shared_posts) > 0) {

            echo view('users.partials.post-detail-view', ['post' => $shared_posts, 'user_like_posts_array' => array_flip($user_like_posts_array)]);
        } else {
            return "Oops something went wrong";
        }
    }


    public function collegeUniversity(Request $request)
    {
        $userCollegeUniversity = User::where('name', 'like', '%' . $request->college_university . '%')->where('user_type', 'work_architecture_college')->get();
        echo view('users.partials.college-company-list', [
            'userCollegeUniversity' => $userCollegeUniversity,
            'typeValid' => "n",
        ]);
    }

    public function companyFirm(Request $request)
    {
        $userCollegeUniversity = User::where('name', 'like', '%' . $request->company_firm_or_college_university . '%')->where('user_type', 'work_architecture_firm_companies')->orWhere('name', 'like', '%' . $request->company_firm_or_college_university . '%')->where('user_type', 'work_architecture_college')->get();
        echo view('users.partials.college-company-list', [
            'userCollegeUniversity' => $userCollegeUniversity,
            'typeValid' => "y",
        ]);
    }


    public function addCollegeCompany(Request $request)
    {
        /* dd($request->college_university_id);*/

        $data = [
            "name" => $request->feed_college_name,
            'email' => $request->feed_college_email,
            "mobile" => $request->feed_college_mobile,
        ];
        $rules = [
            "name" => "required|min:5",
            'email' => "required|email",
            "mobile" => "required|numeric|digits:10",
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            $newFeed = new CollegeCompanyFeed();
            $newFeed->name = $request->feed_college_name;
            $newFeed->email = $request->feed_college_email;
            $newFeed->mobile = $request->feed_college_mobile;
            $newFeed->type = $request->type;
            $newFeed->save();
            $response['return'] = true;
            if ($request->college_university_id != null) {
                if ($request->type == "company_college") {
                    $user = UsersProfessionalDetail::where('id', $request->table_primary_id)->first();
                    $user->company_firm_or_college_university_id = null;
                    $user->company_college_type = null;
                    $user->company_firm_or_college_university = $request->feed_college_name;
                    $user->save();

                }
            }


            if ($request->type == "college") {
                if (isset($request->table_primary_id)) {
                    $user = UsersEducationDetail::where('id', $request->table_primary_id)->first();
                    $user->college_university_id = null;
                    $user->college_university = $request->feed_college_name;
                    $user->save();
                }
            }
            $response['success'] = "Success";
            return Response()->json($response);

        } else {
            $keys = array_keys($validator->getMessageBag()->toArray());
            $response['return'] = false;
            $response['errors'] = $validator->getMessageBag()->toArray();
            $response['errors_keys'] = $keys;
            return Response()->json($response);

        }
    }

    public function addToPortfolio(Request $request)
    {

        $this->validate($request, [
            'id' => 'required'
        ]);

        $id = $request->id;


        //check this post belongs to loggedin user

        $post = UsersPostShare::where("id", $id)->first();
      

        if ($post->user_id != Auth::id()) {
            $res = [
                'return' => false,
                'message' => 'This post does not belongs to you'
            ];
            return response()->json($res);
        }

        $portfolio = Portfolio::where("user_id", Auth::id())
            ->where("users_post_id", $id);

        if ($portfolio->count() > 0) {
            //delete portfolio
            $portfolio->delete();

            $res = [
                'return' => true,
                'message' => 'Post removed from portfolio.',
                'type' => 'remove',
                'count_portfolio' => Portfolio::where("user_id", Auth::id())->count(),
            ];

            return response()->json($res);
        } else {
            //add Portfolio
            $por = new Portfolio();
            $por->user_id = Auth::id();
            $por->users_post_id = $id;
            $por->save();

            $res = [
                'return' => true,
                'message' => 'Post Added to portfolio.',
                'type' => 'add',
                'followers' => Auth::user()->follower,
                'post' => $post,
                'user' => Auth::user(),
                'count_portfolio' => Portfolio::where("user_id", Auth::id())->count(),
            ];
            return response()->json($res);
        }
    }

    //Delete all post
    public function deletePost(Request $request)
    {
        $usersPostId = $request->users_post_id;
        $usersPostShareId = $request->id;
        $is_shared = $request->is_shared;

        //check post belong to user
        $post = UsersPost::where("id", $usersPostId)
            ->where("user_id", Auth::id())->first();


        $uersPostShare = UsersPostShare::
        selectRaw('users_post_share.*,users_post_share.id as shared_id')
            ->where([
                ['id', '=', $usersPostShareId],
                ['users_post_id', '=', $usersPostId],
                ['is_shared', $is_shared],
                ['user_id', Auth::id()]
            ]);
        if ($uersPostShare->count() > 0) {

            $uersPostShare = $uersPostShare->first();

            if ($uersPostShare->is_shared == 'y') {

                // delete all likes whichever belongs to this post
                $uersPostShare->likes()->delete();

                // delete all comments whichever belongs to this post
                $uersPostShare->comments()->delete();

                // delete all portfolio whichever belongs to this post
                /*$uersPostShare->portfolio()->delete();*/
                $post->portfolio()->delete();

                // delete usersPostShare whichever belongs to this post
                $uersPostShare->delete();

            } else if ($uersPostShare->is_shared == 'n') {
                // delete all likes whichever belongs to this post
                $uersPostShare->likes()->delete();


                // delete all comments whichever belongs to this post
                $uersPostShare->comments()->delete();

                //delete all usersPostShare  whichever belongs to this post
                $post->usersPostShareMany()->delete();

                //delete designDetail  whichever belongs to this post
                if ($post->type == "design") {
                    $post->designDetail()->delete();
                }

                //delete post
                $post->delete();
            }

            $res = [
                'return' => true
            ];

            return response()->json($res);
        } else {
            $res = [
                'return' => false
            ];
            return response()->json($res);
        }
    }


    //Delete  post  comments
    public function deletePostComment(Request $request)
    {
        $post_id = $request->id;

        $comment_id = $request->comment_id;


        //check post belong to user
        $postComment = Comment::where("id", $comment_id)
            ->where("user_id", Auth::id())->first();


        if (count($postComment) > 0) {
            //delete post
            $postComment->delete();
            // delete all data whichever belongs to deleted post

            $res = [
                'return' => true,
                'postCommentsCount' => UsersPostShare::selectRaw('users_post_share.id as shared_id')->where('users_post_share.id', $post_id)->first()->commentsLimited->count()
            ];
            return response()->json($res);
        } else {
            $res = [
                'return' => false,

            ];
            return response()->json($res);
        }
    }

    public function postImageRemove(Request $request)
    {
        $usersPost = UsersPost::where([['user_id', Auth::id()], ['slug', $request->post_slug]]);


        if ($request->post_slug != null) {


            File::delete($usersPost->first()->image);
            $usersPost = $usersPost->update([
                'image' => NULL,
            ]);


        } else {
            return "Oops something wrong.";
        }

    }

    public function postStatus(Request $request)
    {
        $rules = array(
            'description' => 'required',
            'post_slug' => 'required',
        );

        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->getMessageBag()->toArray(),]);
        } else {
            $usersPost = UsersPost::where('slug', $request->post_slug)->first();

            /* base64 banner image saved*/
            if (!empty($request->image)) {

                $bannerImageFileName = md5(time() . rand(0000, 9999)) . ".jpg";
                $bannerImagePath = public_path() . "/img/" . $bannerImageFileName;
                Image::make(file_get_contents($request->image))->save($bannerImagePath);

                /*image compression*/
                $filepath = public_path('img/' . $bannerImageFileName);
                $saveImageForCompression = new ImagesForCompression();
                $saveImageForCompression->url = $filepath;
                $saveImageForCompression->status = "n";
                $saveImageForCompression->save();
                dispatch(new CompressImage());

                $file_save = "img/" . $bannerImageFileName;
            } else {

                $file_save = $usersPost->image;
            }

            UsersPost::where('id', $usersPost->id)->where('user_id', Auth::id())->update([
                'description' => $request->description,
                'image' => $file_save
            ]);


        }

    }

    public function skipBtn(Request $request)
    {
        $user = User::where('id', Auth::id())->update([
            'is_skip' => 'y'
        ]);

        if ($user) {
            return response()->json([
                'status_msg' => true,
            ]);
        } else {
            return response()->json([
                'status_msg' => false,
            ]);
        }
    }

    /*invite friend*/

    public function inviteFriend(Request $request)
    {

        $rules = array(
            'email' => 'required|email',
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->getMessageBag()->toArray(),
            ]);
        } else {
            $userCheck = User::where('email', $request->email);
            if ($userCheck->count() == 0) {
                $user = Auth::user();

                /*Mail::send("emails.friend-invitation",[
                    'user_name' => $user->fullName(),
                ], function($m) use($request) {
                    $m->to($request->email)->subject('invitation');

                });*/

                $content = [
                    'title' => 'Hello there!',
                    'title2' => 'Greetings from Team SqrFactor,',

                    'body' => 'Your friend ' . $user->fullName() . ' has invited you to join SqrFactor - a social network for the architecture community where you can post design, articles, follow and interact with the fraternity members and a lot more. ',

                    'link' => 'Watch this amazing introductory video to know our platform better : https://www.youtube.com/watch?v=J5PUIA10vgM',

                    'button' => 'Sign up Now',

                    'button_url' => '/login?active=signup',
                ];

                $receiverAddress = $request->email;
                Mail::to($receiverAddress)->send(new Invitation($content));


                return response()->json([
                    'message' => true
                ]);
            } else {

                return response()->json([
                    'message' => false
                ]);
            }
        }


    }

    /*User social update */

    public function profileSocialUpdate(Request $request)
    {
        $message = array(
            'user_name.unique' => 'That username is taken. Try another.',
            'user_name.alpha_dash' => 'The user name may only contain letters, numbers, and underslot.',
            'user_name.regex' => 'The user name may only contain letters, numbers, and underslot.',

        );

        $rules = array(
            'user_name' => 'required|alpha_dash|regex:/^[(a-zA-Z\s._)(0-9\s)]+$/u|unique:users,user_name,' . Auth::id(),
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'mobile_number' => 'required|numeric|digits:10|unique:users,mobile_number,' . Auth::id(),
            'user_type' => 'required',
            'registerOption' => 'required',
        );

        $validation = Validator::make(Input::all(), $rules, $message);
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->getMessageBag()->toArray()]);
        } else {
            User::where('id', Auth::id())->update([
                'user_name' => $request->user_name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'type' => $request->registerOption,
                'user_type' => $request->user_type,
            ]);


            /*send otp*/

            if ($request->mobile_number != null) {
                // generate otp
                $otp = rand(101010, 999999);

                VerifyOtp::create([
                    "user_id" => Auth::id(),
                    "mobile_number" => $request->mobile_number,
                    "otp" => $otp,

                ]);


                $body = array(
                    "token" => "TcmJjnIq5q",
                    "mob" => $request->mobile_number,
                    "mess" => "Your verification code is" . " " . $otp,
                    "sender" => "SQRSMS",
                    "route" => '1'
                );


                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $url = "http://api.fast2sms.com/sms.php?" . http_build_query($body);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $parsed_json = curl_exec($ch);
                $parsed_json = json_decode($parsed_json);
                /* var_dump($parsed_json);*/
                curl_close($ch);


            }
            /* end send otp*/

            if ($request->email != null) {

                /*welcome email*/

                $fullName = Auth::user()->fullName();
                $content = [
                    'title' => 'Hey ' . $fullName . ',',
                    'title2' => 'Greetings from Team SqrFactor,',

                    'body' => 'Welcome to SqrFactor :) My name is Agnim and I' . "'" . 'm the founder of SqrFactor. We have thoughtfully designed this platform for you to learn, explore and stay connected with the community. I hope you will like it.',

                    'body2' => 'If there' . "'" . 's ever anything that I can help you with, please let me know.',

                ];
                $receiverAddress = $request->email;
                Mail::to($receiverAddress)->send(new Welcome($content));
            }


            return response()->json([
                'getMessageBag' => true,
            ]);

        }

    }


    public function fullNameAuth(Request $request)
    {


        /*alpha_dash*/
        $message = array(
            'user_name.unique' => 'That username is taken. Try another.',
            'user_name.alpha_dash' => 'The user name may only contain letters, numbers, and underslot.',
            'user_name.regex' => 'The user name may only contain letters, numbers, and underslot.'
        );

        $rules = array(
            'user_name' => 'required|unique:users,user_name|alpha_dash|regex:/^[(a-zA-Z\s._)(0-9\s)]+$/u',
        );

        $validation = Validator::make(Input::all(), $rules, $message);

        if ($validation->fails()) {
            if (preg_match('/^[\w\.]+$/', $request->user_name)) {
                {
                    $suggestion = $request->user_name . "_" . rand(1111, 9999);
                    /*echo 'Str is valid';*/
                }
            } else {
                $suggestion = preg_replace("/[^A-Za-z0-9?!]/", '', $request->user_name) . "_" . rand(1010, 9090);
                /*echo 'Str is invalid';*/
            }

            return response()->json(array(
                'errors' => $validation->getMessageBag()->toArray(),
                'suggestion' => $suggestion
            ));

        }


    }

    /*users like post*/
    public function usersPostLike(Request $request)
    {

        /*dd($request->post_id."/".$request->is_shared);*/
        $userPostShare = UsersPostShare::selectRaw('users_post_share.id as shared_id')->where('id', '=', $request->post_id)->first();

        if (count($userPostShare) > 0) {
            $usersPOstCount = $userPostShare->likes()->with('user')->get();


            echo view('users.partials.users-like-li', ['likes' => $usersPOstCount]);

        } else {
            return 'false';
        }

    }

    /*submission like modal data by manoj*/

    public function submissionLike(Request $request)
    {
        $submissionLike = Like::selectRaw('user_id')
            ->where('likeable_id', $request->post_id)
            ->where("likeable_type", "App\\UserCompetitionDesignSubmition");

        if ($submissionLike->count() > 0) {
            $usersPOstCount = $submissionLike->with('user')->get();

            echo view('users.partials.users-like-li', ['likes' => $usersPOstCount]);

        } else {
            return 'false';
        }
    }

    /*comments like*/
    public function usersCommentsLike(Request $request)
    {
        $comments = Comment::where('id', $request->comment_id);
        if ($comments->count() > 0) {
            $usersComments = $comments->first()->likes()->with('user')->get();

            echo view('users.partials.users-like-li', ['likes' => $usersComments]);
        } else {
            return 'false';
        }

    }

    public function userPostShare(Request $request)
    {

        $usersPost = UsersPost::where('slug', $request->post_slug)->first();

        $usersPostShare = UsersPostShare::where([['users_post_id', '=', $usersPost->id], [
            'user_id', '=', Auth::id(),
        ], ['is_shared', '=', 'y']]);

        if ($usersPostShare->count() == 0) {
            UsersPostShare::create([
                'users_post_id' => $usersPost->id,
                'user_id' => Auth::id(),
                'is_shared' => 'y'
            ]);

            return response()->json([
                'status_msg' => true,]);
        } else if ($usersPostShare->count() > 0) {
            return response()->json([
                'status_msg' => false,]);
        }

    }

    public function usersSubmissiondetail(Request $request)
    {

        $usersSubmissiondetail = UserCompetitionDesignSubmition::where('id', $request->submission_id)->with('likes', 'likes.user', 'comments', 'comments.user')->first();

        if (count($usersSubmissiondetail) > 0) {
            $user_like_posts = Like::select("likeable_id")->where('user_id', Auth::id())->get()->toArray();
            $user_like_posts_array = [];
            foreach ($user_like_posts as $user_like_post) {
                array_push($user_like_posts_array, $user_like_post['likeable_id']);
            }
            $user_comments_posts = Comment::select("commentable_id")->where('user_id', Auth::id())->get()->toArray();
            $user_comments_posts_array = [];
            foreach ($user_comments_posts as $user_comment_post) {
                array_push($user_comments_posts_array, $user_comment_post['commentable_id']);
            }
            return view('users.partials.submission-modal', [
                "usersSubmissiondetail" => $usersSubmissiondetail,
                "user_comments_posts_array" => array_flip($user_comments_posts_array),
                "user_like_posts_array" => array_flip($user_like_posts_array)
            ]);
        } else {
            return 'false';
        }
    }

    public function usersSubmissionAdd(Request $request)
    {

        $rules = [
            'commentable_id' => 'required',
            'body' => 'required',
        ];

        $array = array();
        $array['user_id'] = Auth::id();
        $array['commentable_id'] = $request->commentable_id;
        $array['body'] = $request->body;
        $array['commentable_type'] = 'App\\UserCompetitionDesignSubmition';

        $vl = Validator::make($array, $rules);
        if ($vl->passes()) {
            $comment = Comment::create($array);

            $usersSubmissiondetail = Comment::where('id', $comment->id)->with('user')->first();


            if (count($usersSubmissiondetail) > 0) {
                return view('users.partials.comment-li-submission', [
                    "usersSubmissiondetail" => $usersSubmissiondetail,
                ]);
            } else {
                return 'false';
            }

        } else {

            $keys = array_keys($vl->getMessageBag()->toArray());
            $response['return'] = false;
            $response['errors'] = $vl->getMessageBag()->toArray();
            $response['errors_keys'] = $keys;
            return Response()->json($response, 200);

        }
    }


    /*competition update*/

    public function titleCoverUpdate(Request $request)
    {
        /*print_r($request->file('cover_image')->getClientOriginalName());
        exit();*/

        $validation = array(
            'competition_title' => 'required',
            'cover_image' => 'mimes:jpeg,jpg,png',
            'users_competition_slug' => 'required'
        );

        $message = [
            'competition_title.required' => 'Title is required.',
            'cover_image.mimes' => 'upload image in jpeg,jpg,png',
            'users_competition_slug.required' => 'Slug is required.',

        ];

        $validator = Validator::make($request->all(), $validation, $message);

        if ($validator->fails()) {
            $response["return"] = false;
            $response["message"] = "Validation errors";
            $response["error_keys"] = array_keys($validator->getMessageBag()->toArray());
            $response['error'] = $validator->getMessageBag()->toArray();
        } else {

            $userCompetition = UserCompetition::where('slug', $request->users_competition_slug)->where('user_id', Auth::id())->first();

            if (!empty($request->cover_image)) {
                $file = $request->file('cover_image');
                $file_extention = $file->getClientOriginalExtension();
                $file_name = 'cover_competition' . str_random(10) . ".$file_extention";

                Storage::disk("public")->put('competition/test-competition-2/' . $file_name, File::get($request->file('cover_image')));

                $save_img = 'storage/competition/test-competition-2/' . $file_name;

            } else {
                $save_img = $userCompetition->cover_image;
            }


            $userCompetition->update([
                'competition_title' => $request->competition_title,
                'cover_image' => $save_img
            ]);

            //validator pass
            $response["return"] = true;
            $response["message"] = "Success";
        }

        return response()->json($response);

    }

    public function briefUpdate(Request $request)
    {

        $validation = array(
            'berif' => 'required',
            'users_competition_slug' => 'required'
        );

        $message = [
            'berif.required' => 'berif is required.',
            'users_competition_slug.required' => 'Slug is required.',

        ];

        $validator = Validator::make($request->all(), $validation, $message);

        if ($validator->fails()) {
            $response["return"] = false;
            $response["message"] = "Validation errors";
            $response["error_keys"] = array_keys($validator->getMessageBag()->toArray());
            $response['error'] = $validator->getMessageBag()->toArray();
        } else {

            $userCompetition = UserCompetition::where('slug', $request->users_competition_slug)->where('user_id', Auth::id())->first();

            $userCompetition->update([
                'brief' => $request->berif,
            ]);

            //validator pass
            $response["return"] = true;
            $response["message"] = "Success";
        }

        return response()->json($response);
    }


    public function eligibilityCriteriaAwardstherDetailsUpdate(Request $request)
    {

        $validation = array(
            'eligibility_criteria' => 'required',
            'honourable_mentions' => 'required',
            'users_competition_slug' => 'required'
        );

        $message = [
            'eligibility_criteria.required' => 'Eligibility criteria is required.',
            'honourable_mentions.required' => 'Honourable mentions is required.',
            'users_competition_slug.required' => 'Slug is required.',

        ];

        $validator = Validator::make($request->all(), $validation, $message);

        if ($validator->fails()) {
            $response["return"] = false;
            $response["message"] = "Validation errors";
            $response["error_keys"] = array_keys($validator->getMessageBag()->toArray());
            $response['error'] = $validator->getMessageBag()->toArray();
        } else {

            $userCompetition = UserCompetition::where('slug', $request->users_competition_slug)->where('user_id', Auth::id())->first();

            $userCompetition->update([
                'eligibility_criteria' => $request->eligibility_criteria,
                'honourable_mentions' => $request->honourable_mentions,
            ]);

            //validator pass
            $response["return"] = true;
            $response["message"] = "Success";
        }

        return response()->json($response);
    }

    public function juryUpdate(Request $request)
    {

        $validation = array(

            'users_competition_slug' => 'required'
        );

        $message = [

            'users_competition_slug.required' => 'Slug is required.',

        ];

        $validator = Validator::make($request->all(), $validation, $message);

        if ($validator->fails()) {
            $response["return"] = false;
            $response["message"] = "Validation errors";
            $response["error_keys"] = array_keys($validator->getMessageBag()->toArray());
            $response['error'] = $validator->getMessageBag()->toArray();
        } else {

            $userCompetition = UserCompetition::where('slug', $request->users_competition_slug)->where('user_id', Auth::id())->first();

            $userCompetition->userCompetitionJury()->delete();

            //Add Jury
            $userJury = array();
            foreach ($request->jury_fullname as $key => $fullname) {
                $jury_firm_company = $request->jury_firm_company[$key];
                $jury_email = $request->jury_email[$key];
                $jury_contact = $request->jury_contact[$key];

                //upload jury logo
                $path = "";
                if ($request->hasFile('jury_logo.' . $key)) {
                    $str_random = "competition/" . $userCompetition->slug . "/jury/" . str_random() . ".jpg";
                    Storage::disk("public")->put($str_random, File::get($request->file('jury_logo.' . $key)));
                    $path = "storage/" . $str_random;
                }

                $innerArray = [
                    'user_id' => Auth::id(),
                    'jury_id' => $request->jury_id[$key],
                    'competition_id' => $userCompetition->id,
                    'jury_fullname' => $request->jury_fullname[$key],
                    'jury_firm_company' => $jury_firm_company,
                    'jury_email' => $jury_email,
                    'jury_contact' => $jury_contact,
                    'jury_logo' => $path
                ];

                $userJury[] = $innerArray;
            }

            UserCompetitionJury::insert($userJury);
            /*file attachment*/

            //validator pass
            $response["return"] = true;
            $response["message"] = "Success";
        }

        return response()->json($response);
    }

    public function InAssociationWithUpdate(Request $request)
    {
        $validation = array(

            'users_competition_slug' => 'required'
        );

        $message = [

            'users_competition_slug.required' => 'Slug is required.',

        ];

        $validator = Validator::make($request->all(), $validation, $message);

        if ($validator->fails()) {
            $response["return"] = false;
            $response["message"] = "Validation errors";
            $response["error_keys"] = array_keys($validator->getMessageBag()->toArray());
            $response['error'] = $validator->getMessageBag()->toArray();
        } else {

            $userCompetition = UserCompetition::where('slug', $request->users_competition_slug)->where('user_id', Auth::id())->first();

            $userCompetition->userCompetitionPartner()->delete();

            //Add Jury
            //partner
            $userPartner = array();
            foreach ($request->partner_name as $key => $item) {
                //upload partner logo
                $path = "";
                if ($request->hasFile("partner_logo." . $key)) {
                    $str_random = "competition/" . $userCompetition->slug . "/partner/" . str_random() . ".jpg";
                    Storage::disk("public")
                        ->put($str_random, File::get($request->file('partner_logo.' . $key)));
                    $path = "storage/" . $str_random;
                }


                $innerArray = [
                    'user_id' => Auth::id(),
                    'partner_id' => $request->partner_id[$key],
                    'competition_id' => $userCompetition->id,
                    'partner_name' => $request->partner_name[$key],
                    'partner_website' => $request->partner_website[$key],
                    'partner_email' => $request->partner_email[$key],
                    'partner_contact' => $request->partner_contact[$key],
                    'partner_logo' => $path
                ];

                $userPartner[] = $innerArray;
            }

            UserCompetitionPartner::insert($userPartner);

            //validator pass
            $response["return"] = true;
            $response["message"] = "Success";
        }

        return response()->json($response);

    }

    public function downloadAttachment(Request $request)
    {
        $validation = array(

            'users_competition_slug' => 'required',
            /*'attach_documents' => "required|mimes:pdf|max:10000"*/
        );

        $message = [

            'users_competition_slug.required' => 'Slug is required.',


        ];

        $validator = Validator::make($request->all(), $validation, $message);

        if ($validator->fails()) {
            $response["return"] = false;
            $response["message"] = "Validation errors";
            $response["error_keys"] = array_keys($validator->getMessageBag()->toArray());
            $response['error'] = $validator->getMessageBag()->toArray();
        } else {

            $userCompetition = UserCompetition::where('slug', $request->users_competition_slug)->where('user_id', Auth::id())->first();


            $file_attachment = array();
            foreach ($request->file('attach_documents') as $key => $logo) {
                //upload  logo
                $path = "";

                if ($request->hasFile('attach_documents.' . $key)) {

                    $str_random = "competition/" . $userCompetition->slug . "/attachment/" . str_random(20) . "." . $logo->getClientOriginalExtension();
                    Storage::disk("public")->put($str_random, File::get($logo));
                    $path = "storage/" . $str_random;
                }

                $innerArrayAttachment = [
                    'user_id' => Auth::id(),
                    'users_competition_id' => $userCompetition->id,
                    'attach_documents' => $path,
                ];

                $file_attachment[] = $innerArrayAttachment;
            }

            UsersCompetitionsAttachment::insert($innerArrayAttachment);
            //validator pass

            $response["return"] = true;
            $response["message"] = "Success";

        }
        return response()->json($response);
    }


    /*delete competition */

    //Delete all post
    public function DeletePostCompetition(Request $request)
    {
        $competition_slug = $request->competition_slug;
        $competition_id = $request->competition_id;

        //check competition belong to user

        $userCompetition = UserCompetition::where([
            ['id', $competition_id],
            ['slug', $competition_slug],
            ['user_id', Auth::id()],
        ])->first();

        if (count($userCompetition) > 0) {
            /* Prizes & Awards*/
            $userCompetition->usersCompetitionsAward()->delete();
            /*Jury*/
            $userCompetition->userCompetitionJury()->delete();
            /*In Association with*/
            $userCompetition->userCompetitionPartner()->delete();
            /*Download Attachment*/
            $userCompetition->userCompetitionAttachment()->delete();

            foreach ($userCompetition->userCompetitionAttachment as $value) {
                File::delete($value->attach_documents);
            }

            /*competition delete*/
            $userCompetition->delete();

            $res = [
                'return' => true
            ];
        } else {

            $res = [
                'return' => false
            ];
        }

        return response()->json($res);


    }

    public function removeAttachment(Request $request)
    {
        $validation = array(

            'attachment_id' => 'required'
        );

        $message = [

            'attachment_id.required' => 'attachment is required.',

        ];

        $validator = Validator::make($request->all(), $validation, $message);

        if ($validator->fails()) {
            $response["return"] = false;
            $response["message"] = "Validation errors";
            $response["error_keys"] = array_keys($validator->getMessageBag()->toArray());
            $response['error'] = $validator->getMessageBag()->toArray();
        } else {
            $UsersCompetitionsAttachment = UsersCompetitionsAttachment::where([
                ['id', $request->attachment_id],
                ['user_id', Auth::id()]
            ])->first();

            File::delete($UsersCompetitionsAttachment->attach_documents);

            $UsersCompetitionsAttachment->delete();


            //validator pass
            $response["return"] = true;
            $response["message"] = "Success";
        }


        return response()->json($response);
    }


    public function awardDeclareAdd(Request $request)
    {
        $rules = [
            'title' => 'required',
            'time' => 'required',
        ];

        $array = array();

        $array['competition_id'] = $request->competition_id;
        $array['title'] = $request->title;
        $array['time'] = $request->time;
        //$array['design_id'] = $request->award_type;

        $vl = Validator::make($array, $rules);
        if ($vl->passes()) {
            $array_award_item = array();
            $Userdesignsubmissionaward = UsersCompetitionDesignSubmitionAward::create($array);
            foreach ($request->award_type as $key => $value) {
                $array_award_item[$key]['competition_id'] = $request->competition_id;
                $array_award_item[$key]['design_id'] = $value;
                $array_award_item[$key]['result_id'] = $request->result_id[$key];

            }
            $UsersCompetitionDesignSubmitionAwardItem = UsersCompetitionDesignSubmitionAwardItem::insert($array_award_item);

            $response["return"] = true;
            $response["message"] = "Success";
            return Response()->json($response, 200);
        } else {

            $keys = array_keys($vl->getMessageBag()->toArray());
            $response['return'] = false;
            $response['errors'] = $vl->getMessageBag()->toArray();
            $response['errors_keys'] = $keys;
            return Response()->json($response, 200);
        }

    }
}
