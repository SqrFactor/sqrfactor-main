<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Auth;

class ProfileFlag
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->profile_flag == 'n' && Auth::user()->is_skip == "n") {
            return redirect()->to(route("profile.edit"));
        }

        /*hire*/
        if (Auth::user()->type == 'hire') {
            /*hire_individual*/
            if (Auth::user()->user_type == 'hire_individual') {

                if (Auth::user()->first_name !== null && Auth::user()->last_name !== null && Auth::user()->userDetail->country_id !== null && Auth::user()->userDetail->state_id !== null && Auth::user()->userDetail->city_id !== null && Auth::user()->userDetail->gender !== null && Auth::user()->mobile_number !== null) {
                    User::where('id', Auth::id())->update([
                        'profile_flag' => 'y'
                    ]);
                }
            }

            if (Auth::user()->user_type == 'real_estate_firm_companies' || Auth::user()->user_type == 'hire_organization') {

                if (Auth::user()->name !== null && Auth::user()->userDetail->country_id !== null && Auth::user()->userDetail->state_id !== null && Auth::user()->userDetail->city_id !== null && Auth::user()->mobile_number !== null) {
                    User::where('id', Auth::id())->update([
                        'profile_flag' => 'y'
                    ]);
                }
            }


        }


        /*work*/

        /*&& Auth::user()->userDetail->course  !== null && Auth::user()->userDetail->college_university  !== null && Auth::user()->userDetail->year_of_admission   !== null && Auth::user()->userDetail->year_of_graduation   !== null*/
        if (Auth::user()->type == 'work') {
            /*work_individual*/
            if (Auth::user()->user_type == 'work_individual') {
                /*insert if not empty*/
                if (Auth::user()->first_name !== null && Auth::user()->last_name !== null && Auth::user()->userDetail->country_id !== null && Auth::user()->userDetail->state_id !== null && Auth::user()->userDetail->city_id !== null && Auth::user()->userDetail->gender !== null && Auth::user()->mobile_number !== null && Auth::user()->usersEducationDetails->first() != null && Auth::user()->usersEducationDetails->first()->course  != null && Auth::user()->usersEducationDetails->first()->college_university  != null && Auth::user()->usersEducationDetails->first()->year_of_admission   != null && Auth::user()->usersEducationDetails->first()->year_of_graduation != null) {
                    User::where('id', Auth::id())->update([
                        'profile_flag' => 'y'
                    ]);
                }

            }
            /*work_individual end*/


            if (Auth::user()->user_type == 'work_architecture_firm_companies' OR Auth::user()->user_type == 'work_architecture_organizations' OR Auth::user()->user_type == 'work_architecture_college') {
                if (Auth::user()->name !== null && Auth::user()->userDetail->country_id !== null && Auth::user()->userDetail->state_id !== null && Auth::user()->userDetail->city_id !== null && Auth::user()->mobile_number !== null) {
                    User::where('id', Auth::id())->update([
                        'profile_flag' => 'y'
                    ]);
                }
            }


        }


        return $next($request);
    }
}
