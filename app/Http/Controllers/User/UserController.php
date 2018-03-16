<?php

namespace App\Http\Controllers\User;

use App\City;
use App\Country;
use App\Http\Controllers\Controller;
use App\ImagesForCompression;
use App\Jobs\CompressImage;
use App\State;
use App\User;
use App\UserDetail;
use App\UserEmployee;
use App\UsersEducationDetail;
use App\UsersEmail;
use App\UserCompetition;
use App\UserCompetitionDesignSubmition;
use App\like;
use App\Comment;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Image;

class UserController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        $countries = Country::orderBy('name', 'asc')->get();

        $states = State::where('country_id', Auth::user()->userDetail->country_id)->orderBy('name', 'asc')->get();

        $cities = City::where('state_id', Auth::user()->userDetail->state_id)->orderBy('name', 'asc')->get();

        $emails = UsersEmail::where('user_id', Auth::id())->get();

        return view('users.partials.hire-work', compact('countries', 'states', 'cities', 'emails'));
    }

    public function hireIndividualBasicDetail(Request $request)
    {
        $message = array(
            'gender.required' => 'Gender is required'
        );

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'gender' => 'required',
        ], $message);

        User::where('id', Auth::id())->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,

        ]);

        UserDetail::where('user_id', Auth::id())->update([
            'aadhar_id' => $request->aadhar_id,
            'address' => $request->address,
            'occupation' => $request->occupation,
            'pin_code' => $request->pin_code,
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'short_bio' => $request->short_bio,
            'facebook_link' => $request->facebook_link,
            'twitter_link' => $request->twitter_link,
            'linkedin_link' => $request->linkedin_link,
            'instagram_link' => $request->instagram_link,
            'looking_for_an_architect' => $request->looking_for_an_architect,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,


        ]);

        if (Auth::user()->first_name !== null && Auth::user()->last_name !== null && Auth::user()->userDetail->country_id !== null && Auth::user()->userDetail->state_id !== null && Auth::user()->userDetail->city_id !== null && Auth::user()->userDetail->gender !== null && Auth::user()->mobile_number !== null) {
            User::where('id', Auth::id())->update([
                'profile_flag' => 'y'
            ]);
        }


        //return redirect()->back()->notify()->flash('Welcome back!', 'success');
        return redirect()->back()->with('success', 'Profile detail updated successfully.');
    }

    public function hireOrganizationBasicDetail(Request $request)
    {


        $this->validate($request, [
            'name_of_the_company' => 'required',

            'country' => 'required',
            'state' => 'required',
            'city' => 'required',

            'types_of_firm_company' => 'required',
            'firm_or_company_name' => 'required',


        ]);
        User::where('id', Auth::id())->update([
            'name' => $request->name_of_the_company]);

        UserDetail::where('user_id', Auth::id())->update([
            'address' => $request->address,
            'pin_code' => $request->pin_code,
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'short_bio' => $request->short_bio,
            'business_description' => $request->business_description,
            'types_of_firm_company' => $request->types_of_firm_company,
            'firm_or_company_name' => $request->firm_or_company_name,
            'firm_or_company_registration_number' => $request->firm_or_company_registration_number,
            'webside' => $request->webside,
            'facebook_link' => $request->facebook_link,
            'twitter_link' => $request->twitter_link,
            'linkedin_link' => $request->linkedin_link,
            'date_of_birth' => $request->date_of_birth,
        ]);

        if (Auth::user()->name !== null && Auth::user()->userDetail->country_id !== null && Auth::user()->userDetail->state_id !== null && Auth::user()->userDetail->city_id !== null && Auth::user()->mobile_number !== null) {
            User::where('id', Auth::id())->update([
                'profile_flag' => 'y'
            ]);
        }

        return redirect()->back()->with('success', 'Detail Updated successfully.');
    }

    /*hire-organization employee -detail*/
    public function hireOrganizationEmployeeDetail()
    {

        $countries = Country::orderBy('name', 'asc')->get();

        $states = State::where('country_id', Auth::user()->userDetail->country_id)->orderBy('name', 'asc')->get();

        $cities = City::where('state_id', Auth::user()->userDetail->state_id)->orderBy('name', 'asc')->get();

        return view('users.hire.hire-organization-employee', compact('countries', 'states', 'cities'));
    }

    public function hireOrganizationEmployeeDetailSave(Request $request)
    {


        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'role' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'phone_number' => 'required|numeric|unique:user_employee,phone_number',
            'email' => 'email|unique:user_employee,email'


        ]);

        if ($request->hasFile('profile')) {
            $file = $request->profile;
            $file_extention = $file->getClientOriginalExtension();
            $file_name = str_random(10) . time() . '.' . $file_extention;

            Storage::disk("public")->put('images/' . $file_name, File::get($request->file('profile')));

            $file_save = 'storage/images/' . $file_name;
        } else {
            $file_save = 'assets/images/avatar.png';
        }


        UserEmployee::create([
            'user_id' => Auth::id(),
            'slug' => str_slug(str_random(20) . "-" . rand(1111, 9999)),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role' => $request->role,
            'phone_number' => $request->phone_number,
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'profile' => $file_save,
            'aadhar_id' => $request->aadhar_id,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Employee added  successfully.');

    }

    /*work */
    public function workIndividualBasicDetail(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'facebook_link' => 'url',
            'twitter_link' => 'url',
            'linkedin_link' => 'url',
            'instagram_link' => 'url',
            'pin_code' => 'numeric',
            'aadhar_id' => 'numeric',
            'date_of_birth' => 'required',
        ]);


        /*implode occupation value */
        if (!empty($request->occupation)) {
            $occupation = implode(',', $request->occupation);
        } else {
            $occupation = null;
        }


        /*save data*/

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
            'describe_yourself' => $request->describe_yourself,
            'facebook_link' => $request->facebook_link,
            'twitter_link' => $request->twitter_link,
            'linkedin_link' => $request->linkedin_link,
            'instagram_link' => $request->instagram_link,
            'date_of_birth' => $request->date_of_birth,


        ]);
        /*insert if not empty*/
        if (Auth::user()->first_name !== null && Auth::user()->last_name !== null && Auth::user()->userDetail->country_id !== null && Auth::user()->userDetail->state_id !== null && Auth::user()->userDetail->city_id !== null && Auth::user()->userDetail->gender !== null && Auth::user()->mobile_number) {
            User::where('id', Auth::id())->update([
                'profile_flag' => 'y'
            ]);
        }


        return redirect()->route('work.workIndividualEducationDetails')->with('success', 'Updated successfully be Continue.');
    }

    public function workIndividualEducationDetails()
    {
        $allEducationDetails = UsersEducationDetail::where('user_id', Auth::id())->get();
        return view('users.work.work-education-details', compact('allEducationDetails'));
    }

    /*public function workIndividualEducationDetailsSave(Request $request)
    {

        $this->validate($request,[
            'course' => 'required',
            'college_university' => 'required',
            'year_of_admission' => 'required',
            'year_of_graduation' => 'required',
        ]);

        if(Auth::user()->first_name != null &&  Auth::user()->last_name != null)
        {
            $slug = Auth::user()->first_name.Auth::user()->last_name;
        }elseif (Auth::user()->name != null)
        {
            $slug = Auth::user()->name;
        }







       return redirect()->back()->with('success','save successfully.');
    }*/

    public function workIndividualProfessionalDetails(Request $request)
    {
        $allProfessionalDetail = $request->user()->usersProfessionalDetail;

        return view('users.work.work-professional-details', compact('allProfessionalDetail'));
    }


    public function workIndividualOtherDetails(Request $request)
    {
        $allOtherDetail = $request->user()->usersDetail;

        return view('users.work.work-other-details', compact('allOtherDetail'));
    }


    /*work-architecture*/

    public function architectureBasicDetailSave(Request $request)
    {  /*dd($request->name_of_the_company);*/

        $this->validate($request, [
            'name_of_the_company' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'short_bio' => 'nullable|max:150',
            /*'bsiness_description' => 'nullable|max:500',*/
            'types_of_firm_company' => 'required',
            'firm_or_company_registration_number' => 'nullable|numeric',
            'firm_or_company_name' => 'nullable|string',
            'facebook_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',

        ]);


        User::where('id', Auth::id())->update([
            'name' => $request->name_of_the_company,
        ]);

     
        UserDetail::where('user_id', Auth::id())->update([
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city_id' => $request->city,
            /*'bsiness_description' => $request->bsiness_description,*/
            'types_of_firm_company' => $request->types_of_firm_company,
            'short_bio' => $request->short_bio,
            'firm_or_company_name' => $request->firm_or_company_name,
            'firm_or_company_registration_number' => $request->firm_or_company_registration_number,
            'facebook_link' => $request->facebook_link,
            'twitter_link' => $request->twitter_link,
            'linkedin_link' => $request->linkedin_link,
            'instagram_link' => $request->instagram_link,


        ]);

        if (Auth::user()->name !== null && Auth::user()->userDetail->country_id !== null && Auth::user()->userDetail->state_id !== null && Auth::user()->userDetail->city_id !== null && Auth::user()->mobile_number !== null) {
            User::where('id', Auth::id())->update([
                'profile_flag' => 'y'
            ]);
        }
        notify()->flash("Updated successfully.",'success');
        return redirect()->route('work.workArchitectureCompanyFirmDetails');



    }

    public function workArchitectureMemberDetail()
    {
        $countries = Country::orderBy('name', 'asc')->get();

        $states = State::where('country_id', Auth::user()->country_id)->orderBy('name', 'asc')->get();

        $cities = City::where('state_id', Auth::user()->state_id)->orderBy('name', 'asc')->get();

        return view('users.work.work-architecture-member-detail', compact('countries', 'states', 'cities'));
    }

    public function workArchitectureMemberDetailSave(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'role' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'phone_number' => 'required|numeric|digits:10|unique:user_employee,phone_number',
            'email' => 'email|unique:user_employee,email'


        ]);

        if ($request->hasFile('profile')) {
            $file = $request->profile;
            $file_extention = $file->getClientOriginalExtension();
            $file_name = str_random(10) . time() . '.' . $file_extention;

            Storage::disk("public")->put('images/' . $file_name, File::get($request->file('profile')));
            $file_save = 'storage/images/' . $file_name;

            /*image compression*/
            $filepath = public_path('storage/images/'.$file_name);
            $saveImageForCompression = new ImagesForCompression();
            $saveImageForCompression->url = $filepath;
            $saveImageForCompression->status = "n";
            $saveImageForCompression->save();
            dispatch(new CompressImage());

        } else {
            $file_save = 'assets/images/avatar.png';
        }


        UserEmployee::create([
            'user_id' => Auth::id(),
            'slug' => str_slug(str_random(20) . "-" . rand(1111, 9999)),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role' => $request->role,
            'phone_number' => $request->phone_number,
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'profile' => $file_save,
            'aadhar_id' => $request->aadhar_id,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Employee added  successfully.');

    }

    public function workArchitectureCompanyFirmDetails()
    {
        return view('users.work.work-architecture-company-firm-details');
    }

    public function workArchitectureCompanyFirmDetailsSave(Request $request)
    {


        $this->validate($request, [
            'year_in_service' => 'required',
            'services_offered' => 'required',
            'firm_size' => 'required',
            'asset_served' => 'required',
            'city_served' => 'required',
            'award_name' => 'required',
            'project_name' => 'required',

        ]);


        UserDetail::where('user_id', Auth::id())->update([
            'year_in_service' => $request->year_in_service,
            'services_offered' => $request->services_offered,
            'firm_size' => $request->firm_size,
            'asset_served' => $request->asset_served,
            'city_served' => $request->city_served,
            'award_name' => $request->award_name,
            'project_name' => $request->project_name,

        ]);

        return redirect()->route('work.workArchitectureMemberDetail')->with('success', 'Updated successfully.');

    }

    public function UserSubmissionList(User $user){
        //dd($user);
      
        $items = UserCompetitionDesignSubmition::where("user_id", $user->id)
        ->orderBy("created_at", "desc")
        ->with('participation', 'likes', 'likes.user', 'comments.user','competition')->simplePaginate();

      
       

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

        return view('users.submissionUser', [
            "items" => $items,
            'user' => $user,
            "user_comments_posts_array" => array_flip($user_comments_posts_array),
            "user_like_posts_array" => array_flip($user_like_posts_array),
            "user_submission" => 'y'
           
        ]);
    }
}
