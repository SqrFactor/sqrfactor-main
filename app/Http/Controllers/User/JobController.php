<?php

namespace App\Http\Controllers\User;

use App\Country;
use App\JobEducationalQualification;
use App\JobSkills;
use App\UsersJob;
use App\JobApply;
use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    /* Authentication*/
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /*add*/
    public function job()
    {
        /*fetch all country*/
        $countries = Country::orderBy('name', 'asc')->get();
        return view('users.job')->with([
            'countries' => $countries,
        ]);
    }

    /*save job*/

    public function jobSave(Request $request)
    {
        
        $this->validate($request, [
            'job_title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'type_of_position' => 'required',
            'work_experience' => 'required',
            'firm' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'salary_type' => 'required',
            'minimum' => 'required',
            'maximum' => 'required',
            'datetimepicker' => 'required',
        ]);


        $userJob = UsersJob::create([
            'slug' => str_slug($request->job_title),
            'user_id' => Auth::id(),
            'job_title' => $request->job_title,
            'description' => $request->description,
            'category' => $request->category,
            'type_of_position' => $request->type_of_position,
            'work_experience' => $request->work_experience,
            'firm' => $request->firm,
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'salary_type' => $request->salary_type,
            'maximum_salary' => $request->maximum,
            'minimum_salary' => $request->minimum,
            'job_offer_expires_on' => $request->datetimepicker,
        ]);

        /*job skills*/


        foreach ($request->skills as $skill) {
            if (!empty($skill)) {
                JobSkills::create([
                    'slug' => str_slug(str_random(20) . rand(1111, 9999)),
                    'users_job_id' => $userJob->id,
                    'skills' => $skill,
                ]);
            }

        }

        /*Educational Qualification*/

        foreach ($request->educational_qualification as $value) {
            if (!empty($value)) {
                JobEducationalQualification::create([
                    'slug' => str_slug(str_random(20) . rand(1111, 9999)),
                    'users_job_id' => $userJob->id,
                    'educational_qualification' => $value,
                ]);
            }
        }

        return redirect()->back()->with('success', 'saved successfully...');
    }


    public function jobList()
    {
        $joblist = UsersJob::orderBy('id', 'desc')
            ->with('skills', 'educationalQualification')
            ->paginate(10);
        return view('users.job-list', compact('joblist'));
    }

    public function jobDetail(UsersJob $userJob)
    {

        $userJob->load('skills', 'educationalQualification', 'city', 'state', 'country');
        $data_array = array();
        foreach ($userJob->skills as $key => $skill) {
            $data_array['skill'][$key] = $skill->skills;
        }

        foreach ($userJob->educationalQualification as $key => $qualification) {
            $data_array['educational_qualification'][$key] = $qualification->educational_qualification;
        }
        return view('users.job-detail', [
            'userJob' => $userJob,
            'skill' => implode(',', $data_array['skill']),
            'qualifaiction' => implode(',', $data_array['educational_qualification']),
        ]);
    }

    public function applyJob(Request $request)
    {
        $useExistJob = JobApply::where('user_id', Auth::id())
            ->count();
        if ($useExistJob <= 0) {
            $jobApply = JobApply::Insert([
                'user_id' => Auth::id(),
                'users_job_id' => $request->user_job_id,
                'created_at' => time(),
            ]);
            if ($jobApply) {


                
                $response['return'] = true;
                $response['message'] = "Participate added Successfully";
                return Response()->json($response, 200);
            } else {
                $response['return'] = false;
                return Response()->json($response, 200);
            }
        } else {
            $response['return'] = false;
            $response['message'] = "you already applied for job";
            return Response()->json($response, 200);
        }
    }

         public function viewApplicant()
        {
            $joblist = JobApply::orderBy('id', 'desc')
                ->with('userJobDetail', 'user')->get();
            return view('users.partials.applicant-list', compact('joblist'));

        }

    


}
