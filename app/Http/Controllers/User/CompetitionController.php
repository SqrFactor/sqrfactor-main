<?php  

namespace App\Http\Controllers\User;
 
use App\CompetitionAssociation;
use App\CompetitionJury;
use App\Http\Controllers\Controller;
use App\Mail\CompetitionAnnouncment;
use App\Mail\CompetitionResultDeclare;
use App\Mail\CompetitionParticipation;
use App\Mail\CompetitionSubmission;
use App\User;
use App\Jobs\CompressImage;
use App\UserCompetition;
use App\UserCompetitionAward;
use App\UserCompetitionDesignSubmition;
use App\UserCompetitionJury;
use App\UserCompetitionPartner;
use App\UserCompetitionRegistrationType;
use App\UsersCompetitionDesignSubmitionAward;
use App\UsersCompetitionDesignSubmitionAwardItem;
use App\UsersCompetitionsAttachment;
use App\UsersCompetitionWallQuestion;
use App\UsersCompetitionWallQuestionComments;
use App\Like;
use App\ImagesForCompression;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\ParticipateUser;
use App\Comment;
use Share;
use Image;

class CompetitionController extends Controller
{
    //Find competition
    public function competitionListFindCompetition()
    {
        $competitionList = UserCompetition::orderBy('id', 'desc')
            ->with('usersCompetitionsAward')
            ->paginate(10);

        return view('users.competition-find', compact('competitionList'));
    }

    //Add new competition section
    public function competitionAdd()
    {
        return view('users.competition');
    }

    public function competitionSave(Request $request)
    {
        $rules = [
            'cover_image' => 'required|mimes:jpeg,bmp,png',
            'competition_title' => 'required|unique:users_competition,competition_title',
            'competition_brief' => 'required',
            'eligibility_criteria' => 'required',
            'award_type.*' => 'required',
            'award_amount.*' => 'required',
            'award_currency.*' => 'required',
            'award_extra.*' => 'required',
            'honourable_mentions' => 'required',
            'schedule_start_date_of_registration' => 'required',
            'schedule_close_date_of_registration' => 'required',
            'schedule_closing_date_of_project_submission' => 'required',
            'schedule_announcement_of_the_winner' => 'required',
            'competition_type' => 'required',
        ];

        $message = [

        ];

        $vl = Validator::make($request->all(), $rules, $message);

        if ($vl->passes()) {

            $slug = str_slug($request->competition_title);

            //upload banner image
            $imagepath = "competition/" . $slug . "/" . $slug . "_cover.jpg";
            Storage::disk("public")->put($imagepath, File::get($request->cover_image));

            $userCompetition = UserCompetition::create([
                'user_id' => Auth::id(),
                'slug' => $slug,
                'cover_image' => 'storage/' . $imagepath,
                'competition_title' => $request->competition_title,
                'brief' => $request->competition_brief,
                'eligibility_criteria' => $request->eligibility_criteria,
                'jury_type' => $request->jury_type,
                'honourable_mentions' => $request->honourable_mentions,
                'schedule_start_date_of_registration' => $request->schedule_start_date_of_registration,
                'schedule_close_date_of_registration' => $request->schedule_close_date_of_registration,
                'schedule_closing_date_of_project_submission' => $request->schedule_closing_date_of_project_submission,
                'schedule_announcement_of_the_winner' => $request->schedule_announcement_of_the_winner,
                'competition_type' => $request->competition_type,
                'early_bird_registration_start_date' => $request->early_bird_registration_start_date,
                'early_bird_registration_end_date' => $request->early_bird_registration_end_date,
                'advance_registration_start_date' => $request->advance_registration_start_date,
                'advance_registration_end_date' => $request->advance_registration_end_date,
                'last_minute_registration_start_date' => $request->last_minute_registration_start_date,
                'last_minute_registration_end_date' => $request->last_minute_registration_end_date,
                'partner_type' => $request->partner_type,
                'reg_from' => $request->reg_form,
                'reg_url' => $request->url
            ]);

            //Add Jury
            $userJury = array();

            foreach ($request->jury_fullname as $key => $fullname) {
                $jury_firm_company = $request->jury_firm_company[$key];
                $jury_email = $request->jury_email[$key];
                $jury_contact = $request->jury_contact[$key];

                //upload jury logo
                $path = "";
                if ($request->hasFile('jury_logo.' . $key)) {
                    $str_random = "competition/" . $slug . "/jury/" . str_random() . ".jpg";
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


            $file_attachment = array();
            if (!empty($request->file('attach_documents'))) {
                foreach ($request->file('attach_documents') as $key => $logo) {
                    //upload  logo
                    $path = "";
                    if ($request->hasFile('attach_documents.' . $key)) {
                        $str_random = "competition/" . $slug . "/attachment/" . str_random(20) . "." . $logo->getClientOriginalExtension();
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
            }


            //Insert awards
            $awards = array();
            foreach ($request->award_type as $key => $award_type) {
                $innerArray = [
                    'user_id' => Auth::id(),
                    'competition_id' => $userCompetition->id,
                    'award_type' => $request->award_type[$key],
                    'award_amount' => $request->award_amount[$key],
                    'award_currency' => $request->award_currency[$key],
                    'award_extra' => $request->award_extra[$key]
                ];

                $awards[] = $innerArray;
            }

            UserCompetitionAward::insert($awards);

            //Registration type
            $registrationType = array();
            if ($request->competition_type != "free") {
                foreach ($request->early_bird_registration_type as $key => $value) {
                    $innerArray = [
                        'user_id' => Auth::id(),
                        'competition_id' => $userCompetition->id,
                        'type' => $value,
                        'currency' => $request->early_bird_registration_currency[$key],
                        'amount' => $request->early_bird_registration_amount[$key],
                        'registration_type' => "early_bird"
                    ];

                    $registrationType[] = $innerArray;
                }

                foreach ($request->advance_registration_type as $key => $value) {
                    $innerArray = [
                        'user_id' => Auth::id(),
                        'competition_id' => $userCompetition->id,
                        'type' => $value,
                        'currency' => $request->advance_registration_currency[$key],
                        'amount' => $request->advance_registration_amount[$key],
                        'registration_type' => "advance"
                    ];

                    $registrationType[] = $innerArray;
                }


                foreach ($request->last_minute_registration_type as $key => $value) {
                    $innerArray = [
                        'user_id' => Auth::id(),
                        'competition_id' => $userCompetition->id,
                        'type' => $value,
                        'currency' => $request->last_minute_registration_currency[$key],
                        'amount' => $request->last_minute_registration_amount[$key],
                        'registration_type' => "last_minute"
                    ];

                    $registrationType[] = $innerArray;
                }

                UserCompetitionRegistrationType::insert($registrationType);
            }

            //partner
            $userPartner = array();
            foreach ($request->partner_name as $key => $item) {
                //upload partner logo
                $path = "";
                if ($request->hasFile("partner_logo." . $key)) {
                    $str_random = "competition/" . $slug . "/partner/" . str_random() . ".jpg";
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
            $response["slug"] = $userCompetition->slug;
        } else {
            //error
            $response["return"] = false;
            $response["message"] = "Validation errors";
            $response["error_keys"] = array_keys($vl->getMessageBag()->toArray());
            $response['error'] = $vl->getMessageBag()->toArray();
        }

        return response()->json($response);
    }

    /*edit competition*/

    /*public function competitionEdit(UserCompetition $userCompetition)
    {
//        $userCompetition->load('userCompetitionJury',
//            'usersCompetitionsAward',
//            'userCompetitionRegistrationType',
//            'userCompetitionPartner',
//            'userCompetitionAttachment');
//
//        return view('users.competition-edit', compact('userCompetition'));

        $userCompetition
            ->load('usersCompetitionsAward',
                'userCompetitionJury.user',
                'userCompetitionJury.user.userDetail',
                'userCompetitionJury.user.userDetail.city',
                'userCompetitionPartner',
                'userCompetitionPartner.user',
                'userCompetitionAttachment',
                'userCompetitionRegistrationType');

        return view('users.competition-detail',[
            'competition' => $userCompetition,
            'edit' => 'true'
        ]);
    }*/

    /*
     * Search Competition AutoComplete
     * */
    public function competitionsJurySearch(Request $request)
    {
        $usersCompetitionsJury = User::select("id", "mobile_number", "first_name", "email", "last_name")
            ->where('first_name', 'LIKE', '%' . $request->search . '%')
            ->where("active", "1")
            ->where("user_type", "work_individual")
            ->orWhere("last_name", "LIKE", "%" . $request->search . "%")
            ->where("active", "1")
            ->where("user_type", "work_individual")
            ->get();

        echo view('users.partials.competitions-jury-dom', compact('usersCompetitionsJury'));
    }

    public function participateSearch(Request $request)
    {

        $usersParticipate = User::select("id", "user_type", "first_name", "name", "last_name")
            ->where('first_name', 'LIKE', '%' . $request->search . '%')
            ->where("active", "1")
            ->where("id", "!=", Auth::id())
            ->orWhere("last_name", "LIKE", "%" . $request->search . "%")
            ->where("active", "1")
            ->where("id", "!=", Auth::id())
            ->orWhere("name", "LIKE", "%" . $request->search . "%")
            ->where("active", "1")
            ->where("id", "!=", Auth::id())
            ->orWhere("user_name", "LIKE", "%" . $request->search . "%")
            ->where("active", "1")
            ->where("id", "!=", Auth::id())
            ->get();

        echo view('users.partials.participate-search', compact('usersParticipate'));
    }

    /*
     *
     * Search Partner Autocomplete
     * */

    function competitionsPartnerSearch(Request $request)
    {
        $usersCompetitionsJury = User::select("id", "mobile_number", "name", "email")
            ->where('name', 'LIKE', '%' . $request->search . '%')
            ->where("active", "1")
            ->where("user_type", "!=", "work_individual")
            ->get();

        echo view('users.partials.competitions-partner-dom', compact('usersCompetitionsJury'));
    }

    public function competitionDetail(UserCompetition $userCompetition)
    {
        $userCompetition
            ->load('usersCompetitionsAward',
                'userCompetitionJury.user',
                'userCompetitionJury.user.userDetail',
                'userCompetitionJury.user.userDetail.city',
                'userCompetitionPartner',
                'userCompetitionPartner.user',
                'userCompetitionAttachment',
                'userCompetitionRegistrationType');

        return view('users.competition-detail', [
            'competition' => $userCompetition
        ]);
    }

    public function competitionWall(UserCompetition $userCompetition)
    {
        $competition = $userCompetition
            ->load('userCompetitionWallQuestion',
                'userCompetitionWallQuestion.user',
                'userCompetitionWallQuestion.comments',
                'userCompetitionWallQuestion.comments.user');

        return view('users.competition-wall', compact('competition'));
    }

    public function competitionWallQuestionAdd(Request $request)
    {
        $data['subject'] = $request->subject;
        $data['description'] = $request->description;
        $data['users_competition_id'] = $request->users_competition_id;

        $rules = [
            'users_competition_id' => 'required|exists:users_competition,id',
            'subject' => 'required|min:3',
            'description' => 'required|min:10'
        ];

        $vl = Validator::make($data, $rules);

        if ($vl->passes()) {
            $question = new UsersCompetitionWallQuestion();
            $question->user_id = Auth::id();
            $question->users_competition_id = $data['users_competition_id'];
            $question->subject = $data['subject'];
            $question->description = $data['description'];
            $question->save();

            $response['return'] = true;
            $response['data'] = $question;
            $response['message'] = "Post Successfully";
            return Response()->json($response, 200);
        } else {
            $keys = array_keys($vl->getMessageBag()->toArray());
            $response['return'] = false;
            $response['errors'] = $vl->getMessageBag()->toArray();
            $response['errors_keys'] = $keys;
            return Response()->json($response, 200);
        }
    }

    public
    function competitionWallAnnouncement(Request $request)
    {

       
        $data['announcement'] = $request->announcement;
        $data['users_competition_id'] = $request->users_competition_id;
        $rules = [
            'users_competition_id' => 'required|exists:users_competition,id',
            'announcement' => 'required|min:10'
        ];

        $vl = Validator::make($data, $rules);

        if ($vl->passes()) {
            $announcement = new UsersCompetitionWallQuestion();
            $announcement->user_id = Auth::id();
            $announcement->users_competition_id = $data['users_competition_id'];
            $announcement->is_announcement = 'y';
            $announcement->subject = $request->announcement_title;
            $announcement->description = $data['announcement'];
            $announcement->save();

            //Send Email to all the Participatens
            $participantes = ParticipateUser::select('user_id')->where("compition_id", $data['users_competition_id'])->with('user')->get();
            $competition = UserCompetition::select("competition_title")->where("id",$data['users_competition_id'])->first();
            foreach ($participantes as $par) {
                $content = [
                    'name' => $par->user->fullName(),
                    'competition_title' => $competition->competition_title,
                    'subject' => $request->announcement_title,
                    'description' => $data['announcement']
                ];

                Mail::to($par->user->email)->send(new CompetitionAnnouncment($content));
            }

            $response['return'] = true;
            $response['data'] = $announcement;
            $response['message'] = "Post Successfully";
            return Response()->json($response, 200);
        } else {
            $keys = array_keys($vl->getMessageBag()->toArray());
            $response['return'] = false;
            $response['errors'] = $vl->getMessageBag()->toArray();
            $response['errors_keys'] = $keys;
            return Response()->json($response, 200);
        }
    }

    public function competitionWallQuestionUpdate(Request $request)
    {
        $data['subject'] = $request->subject;
        $data['description'] = $request->description;
        $data['question_id'] = $request->question_id;
        $rules = [
            'question_id' => 'required|exists:users_competition_wall_question,id',
            'subject' => 'required|min:3',
            'description' => 'required|min:10'
        ];
        $vl = Validator::make($data, $rules);
        if ($vl->passes()) {
            $question = UsersCompetitionWallQuestion::where('id', $data['question_id'])->first();
            $question->subject = $data['subject'];
            $question->description = $data['description'];
            $question->save();

            $response['return'] = true;
            $response['data'] = $question;
            $response['message'] = "Post Update Successfully";
            return Response()->json($response, 200);
        } else {
            $keys = array_keys($vl->getMessageBag()->toArray());
            $response['return'] = false;
            $response['errors'] = $vl->getMessageBag()->toArray();
            $response['errors_keys'] = $keys;
            return Response()->json($response, 200);

        }
    }

    public function competitionWallQuestionDelete(Request $request)
    {
        $data['question_id'] = $request->question_id;
        $rules = [
            'question_id' => 'required|exists:users_competition_wall_question,id',
        ];
        $vl = Validator::make($data, $rules);
        if ($vl->passes()) {

            UsersCompetitionWallQuestion::where('id', $data['question_id'])->delete();

            $response['return'] = true;
            $response['message'] = "Question Deleted Successfully";
            return Response()->json($response, 200);
        } else {
            $keys = array_keys($vl->getMessageBag()->toArray());
            $response['return'] = false;
            $response['errors'] = $vl->getMessageBag()->toArray();
            $response['errors_keys'] = $keys;
            return Response()->json($response, 200);

        }
    }

    public function competitionWallQuestionCommentAdd(Request $request)
    {
        $data['comment'] = $request->comment;
        $data['question_id'] = $request->users_competition_wall_question_id;
        $rules = [
            'question_id' => 'required|exists:users_competition_wall_question,id',
            'comment' => 'required|min:3',
        ];
        $vl = Validator::make($data, $rules);
        if ($vl->passes()) {
            $comment = new UsersCompetitionWallQuestionComments();
            $comment->user_id = Auth::id();
            $comment->users_competition_wall_question_id = $data['question_id'];
            $comment->comment = $data['comment'];
            $comment->save();

            $data = UsersCompetitionWallQuestionComments::where("id", $comment->id)->with('user')->first();

            $response['return'] = true;
            $response['data'] = $data;
            $response['message'] = "Commented Successfully";
            return Response()->json($response, 200);
        } else {

            $keys = array_keys($vl->getMessageBag()->toArray());
            $response['return'] = false;
            $response['errors'] = $vl->getMessageBag()->toArray();
            $response['errors_keys'] = $keys;
            return Response()->json($response, 200);

        }
    }

    public function competitionWallQuestionCommentUpdate(Request $request)
    {
        $data['comment_id'] = $request->comment_id;
        $data['comment_description'] = $request->comment_description;
        $rules = [
            'comment_id' => 'required|exists:users_competition_wall_question_comments,id',
            'comment_description' => 'required|min:10'
        ];
        $vl = Validator::make($data, $rules);
        if ($vl->passes()) {
            $comment = UsersCompetitionWallQuestionComments::where('id', $data['comment_id'])->first();
            $comment->comment = $data['comment_description'];
            $comment->save();
            $response['return'] = true;
            $response['data'] = $comment;
            $response['message'] = "Comment Update Successfully";
            return Response()->json($response, 200);
        } else {
            $keys = array_keys($vl->getMessageBag()->toArray());
            $response['return'] = false;
            $response['errors'] = $vl->getMessageBag()->toArray();
            $response['errors_keys'] = $keys;
            return Response()->json($response, 200);

        }
    }

    public function competitionWallQuestionCommentDelete(Request $request)
    {
        $data['comment_id'] = $request->comment_id;
        $rules = [
            'comment_id' => 'required|exists:users_competition_wall_question_comments,id',
        ];
        $vl = Validator::make($data, $rules);
        if ($vl->passes()) {
            UsersCompetitionWallQuestionComments::where('id', $data['comment_id'])->delete();
            $response['return'] = true;
            $response['message'] = "Comment Deleted Successfully";
            return Response()->json($response, 200);
        } else {
            $keys = array_keys($vl->getMessageBag()->toArray());
            $response['return'] = false;
            $response['errors'] = $vl->getMessageBag()->toArray();
            $response['errors_keys'] = $keys;
            return Response()->json($response, 200);

        }
    }

    public function participateAdd(Request $request)
    {
        $rules = [
            'compition_id' => 'required'       ];

        /*
            mehenat ka code
            |unique:users_competitions_participate_user,compition_id,NULL,id,user_id,' . Auth::id(), 

        $message = [
            'compition_id' => "You have already participated in this competition. Submit your design"
        ];*/

        $array = array();
        $array['user_id'] = Auth::id();
        $array['compition_id'] = $request->compition_id;

        $vl = Validator::make($array, $rules);
        if ($vl->passes()) {
            //submit data
            foreach ($request->participate as $key => $value) {
                $index = $key + 1;
                $array['participate_id' . $index] = $request->participate_id[$key];
                $array['participate_name' . $index] = $request->participate[$key];
            }

            foreach ($request->mentor as $key => $value) {
                $index = $key + 1;
                $array['mentor_id' . $index] = $request->mentor_id[$key];
                $array['mentor_name' . $index] = $request->mentor[$key];
            }

            //Generate code for competition
            $competition = UserCompetition::select("competition_title", "user_id")->where("id", $request->compition_id)->first();
            $words = preg_split("/\s+/", $competition->competition_title);
            $acronym = "";
            foreach ($words as $w) {
                $acronym .= $w[0];
            }
            $code = strtoupper($acronym . str_random(6));

            $array['code'] = $code;

            ParticipateUser::create($array);

            //send mail about design to all 5 participation
            $competition_organizer = $competition->user->fullName();
            $content = [
                'name' => Auth::user()->fullName(),
                'competition_title' => $competition->competition_title,
                'competition_organizer' => $competition_organizer,
                'competition_code' => $code,
            ];
            Mail::to(Auth::user()->email)->send(new CompetitionParticipation($content));

            if (isset($array['participate_id2']) && !empty($array['participate_id2']) && $array['participate_id2'] != null) {
                $user = User::where("id", $array['participate_id2'])->first();
                $content = [
                    'name' => $user->fullName(),
                    'competition_title' => $competition->competition_title,
                    'competition_organizer' => $competition_organizer,
                    'competition_code' => $code,
                ];
                Mail::to($user->email)->send(new CompetitionParticipation($content));
            }

            if (isset($array['participate_id3']) && !empty($array['participate_id3']) && $array['participate_id3'] != null) {
                $user = User::where("id", $array['participate_id3'])->first();
                $content = [
                    'name' => $user->fullName(),
                    'competition_title' => $competition->competition_title,
                    'competition_organizer' => $competition_organizer,
                    'competition_code' => $code,
                ];
                Mail::to($user->email)->send(new CompetitionParticipation($content));
            }

            if (isset($array['participate_id4']) && !empty($array['participate_id4']) && $array['participate_id4'] != null) {
                $user = User::where("id", $array['participate_id4'])->first();
                $content = [
                    'name' => Auth::user()->fullName(),
                    'competition_title' => $competition->competition_title,
                    'competition_organizer' => $competition_organizer,
                    'competition_code' => $code,
                ];
                Mail::to($user->email)->send(new CompetitionParticipation($content));
            }

            if (isset($array['participate_id5']) && !empty($array['participate_id5']) && $array['participate_id5'] != null) {
                $user = User::where("id", $array['participate_id5'])->first();
                $content = [
                    'name' => Auth::user()->fullName(),
                    'competition_title' => $competition->competition_title,
                    'competition_organizer' => $competition_organizer,
                    'competition_code' => $code,
                ];
                Mail::to($user->email)->send(new CompetitionParticipation($content));
            }

            $response['return'] = true;
            $response['message'] = "Participate added Successfully";
            return Response()->json($response, 200);
        } else {

            $keys = array_keys($vl->getMessageBag()->toArray());
            $response['return'] = false;
            $response['errors'] = $vl->getMessageBag()->toArray();
            $response['errors_keys'] = $keys;
            return Response()->json($response, 200);

        }

    }

    /*
     * method to check user has already participated in that competition or not
     * 1 = he has Participated
     * 0 = he has not Participated
     * */
    public function participateCheckExist(Request $request)
    {
        $participateUser = ParticipateUser::where('user_id', Auth::id())
            ->where("compition_id", $request->competition_id)
            ->count();

        if ($participateUser <= 0) {

            //Also check if user has field is details
            if (Auth::user()->profile_flag == "n") {
                $response['return'] = false;
                $response['message'] = 'Please fill all your profile details in order to take part in this competition';
                $response['code'] = 1;
                return response()->json($response);
            }

            //User can take participate
            $response['return'] = true;
            $response['message'] = 'success';
            $response['code'] = 3;
            return response()->json($response);
        } else {
            $response['return'] = false;
            $response['message'] = 'You have already participated in this competition. Please submit your design';
            $response['code'] = 2;
            return response()->json($response);
        }
    }


    /*
     * Submit design to a competition
     * */
    public function competitionSubmitDesign(UserCompetition $userCompetition)
    {
        //Also check if user has field is details
        if (Auth::user()->profile_flag == "n") {
            notify()->flash("Oops!", "warning", [
                'text' => 'Please fill all your profile details in order to take part in this competition'
            ]);
            return redirect()->route("profile.edit");
        }

        //Check user has participated in this competition or not
        $participate_user_count = ParticipateUser::select("id")->where('user_id', Auth::id())
            ->where("compition_id", $userCompetition->id);

        if ($participate_user_count->count() <= 0) {
            notify()->flash("Oops!", "warning", [
                'text' => 'Please first participate in this competition in order to submit design'
            ]);
            return redirect()->back();
        }

        $user_competition_participation = $participate_user_count->first();


        //User ne design phela to submit ny kar di?
        /*$user_competition_design_submition_count = UserCompetitionDesignSubmition::where("user_id", Auth::id())
            ->where("competition_id", $userCompetition->id)
            ->where("competition_participation_id", $user_competition_participation->id)
            ->count();

        if ($user_competition_design_submition_count > 0) {
            notify()->flash("Oops!", "warning", [
                'text' => 'You have already submitted design for this competition'
            ]);
            return redirect()->back();
        }*/

        //show submit design view
        return view('users.competition-submit-design', [
            'competition' => $userCompetition,
            'competition_participation' => $user_competition_participation
        ]);
    }

    public function competitionEditSubmitDesign(Request $request)
    {
       $submission = UserCompetitionDesignSubmition::where('id',$request->id)->first();
      

       return view('users.competition-submit-edit-design', [
            'submission' => $submission
        ]);
        
    }


    public function competitionSubmissionDesignSave(Request $request)
    {
        $vl = Validator::make($request->all(), [
            'design_title' => 'required|min:6',
            'design_cover_image' => 'required|mimes:jpeg,png,jpg',
            'design_pdf' => 'mimes:pdf',
            'competition_id' => 'required',
            'competition_participation_id' => 'required'
        ], [
            'design_pdf.mimes' => 'Please only upload pdf file'
        ]);

        if ($vl->passes()) {

            //Also check if user has field is details
            if (Auth::user()->profile_flag == "n") {
                $response['return'] = false;
                $response['error_keys'] = ['custom_error'];
                $response['error'] = [
                    'custom_error' => ['Please fill all your profile details in order to take part in this competition']
                ];
                return response()->json($response);
            }

            //Check user has participated in this competition or not
            $participate_user_count = ParticipateUser::where('user_id', Auth::id())
                ->where("compition_id", $request->competition_id)->orderBy('id','desc');

            if ($participate_user_count->count() <= 0) {
                $response['return'] = false;
                $response['error_keys'] = ['custom_error'];
                $response['error'] = [
                    'custom_error' => ['Please first participate in this competition in order to submit design']
                ];
                return response()->json($response);
            }

            //User ne design phela to submit ny kar di?
            /*$user_competition_design_submition_count = UserCompetitionDesignSubmition::where("user_id", Auth::id())
                ->where("competition_id", $request->competition_id)
                ->where("competition_participation_id", $request->competition_participation_id)
                ->count();

            if ($user_competition_design_submition_count > 0) {
                $response['return'] = false;
                $response['error_keys'] = ['custom_error'];
                $response['error'] = [
                    'custom_error' => ['You have already submitted design for this competition']
                ];
                return response()->json($response);
            }*/

            //upload cover image


            

          /*  if (!empty($request->image)) {
                $mediumImageFileName = md5(time() . rand(0000, 9999)) . ".jpg";
                $mediumImagePath = public_path() . "/img/medium/" . $mediumImageFileName;

                Image::make(file_get_contents($request->image))->save($mediumImagePath);

              
                    $filepath = public_path('img/medium/' . $mediumImageFileName);

                    $saveImageForCompression = new ImagesForCompression();
                    $saveImageForCompression->url = $filepath;
                    $saveImageForCompression->status = "n";
                    $saveImageForCompression->save();

                    dispatch(new CompressImage());

                    echo asset("img/medium/" . $mediumImageFileName);
                }

            */



            $cover_image = "";
            if ($request->hasFile("design_cover_image")) {
                $file = $request->file("design_cover_image");
                $file_path = "competition_submission/" . md5($request->competition_id) . "/cover_image/" . str_random(20) . "." . $file->getClientOriginalExtension();
                    Storage::disk("public")->put($file_path, File::get($file));

                    $filepath = public_path($file_path);

                    $saveImageForCompression = new ImagesForCompression();
                    $saveImageForCompression->url = $filepath;
                    $saveImageForCompression->status = "n";
                    $saveImageForCompression->save();

                    dispatch(new CompressImage());

                $cover_image = "storage/" . $file_path;
            }

            //upload Pdf id any
            $pdf_file = "";
            if ($request->hasFile("design_pdf")) {
                $file = $request->file("design_pdf");
                $file_path = "competition_submission/" . md5($request->competition_id) . "/pdf/" . str_random(20) . "." . $file->getClientOriginalExtension();
                Storage::disk("public")->put($file_path, File::get($file));
                $pdf_file = "storage/" . $file_path;
            }

            /*
             * Get competition code from participate_user table if exits if not generate & save it
             * */
            $participate_user_count = $participate_user_count->first();
         
            if ($participate_user_count->code != null){
                $code = $participate_user_count->code;
            }else{
                //Generate code & save it to participate table also
                $words = preg_split("/\s+/", $request->competition_title);
                $acronym = "";
                foreach ($words as $w) {
                    $acronym .= $w[0];
                }

                $code = strtoupper($acronym . str_random(6));

                //Update it to particiapte table
                $participate_user_count->code = $code;
                $participate_user_count->save();
            }

            UserCompetitionDesignSubmition::insert([
                'user_id' => Auth::id(),
                'competition_id' => $request->competition_id,
                'competition_participation_id' => $request->competition_participation_id,
                'title' => $request->design_title,
                'cover' => $cover_image,
                'body' => $request->design_body,
                'pdf' => $pdf_file,
                'code' => $code
            ]);

            //send mail
            $competition = UserCompetition::select("competition_title")
                ->where("id", $request->competition_id)->first();

            $content = [
                'name' => Auth::user()->fullName(),
                'competition_title' => $competition->competition_title
            ];

            Mail::to(Auth::user()->email)->send(new CompetitionSubmission($content));

            if (isset($participate_user_count['participate_id2']) && !empty($participate_user_count['participate_id2']) && $participate_user_count['participate_id2'] != null) {
                $user = User::where("id", $participate_user_count['participate_id2'])->first();
                $content = [
                    'name' => $user->fullName(),
                    'competition_title' => $competition->competition_title
                ];

                Mail::to($user->email)->send(new CompetitionSubmission($content));
            }

            if (isset($participate_user_count['participate_id3']) && !empty($participate_user_count['participate_id3']) && $participate_user_count['participate_id3'] != null) {
                $user = User::where("id", $participate_user_count['participate_id3'])->first();
                $content = [
                    'name' => $user->fullName(),
                    'competition_title' => $competition->competition_title
                ];

                Mail::to($user->email)->send(new CompetitionSubmission($content));
            }

            if (isset($participate_user_count['participate_id4']) && !empty($participate_user_count['participate_id4']) && $participate_user_count['participate_id4'] != null) {
                $user = User::where("id", $participate_user_count['participate_id4'])->first();
                $content = [
                    'name' => $user->fullName(),
                    'competition_title' => $competition->competition_title
                ];

                Mail::to($user->email)->send(new CompetitionSubmission($content));
            }

            if (isset($participate_user_count['participate_id5']) && !empty($participate_user_count['participate_id5']) && $participate_user_count['participate_id5'] != null) {
                $user = User::where("id", $participate_user_count['participate_id5'])->first();
                $content = [
                    'name' => $user->fullName(),
                    'competition_title' => $competition->competition_title
                ];

                Mail::to($user->email)->send(new CompetitionSubmission($content));
            }

            $response['return'] = true;
            $response['message'] = "success";
            return response()->json($response);
        } else {
            $response['return'] = false;
            $response['error_keys'] = array_keys($vl->getMessageBag()->toArray());
            $response['error'] = $vl->getMessageBag()->toArray();
            return response()->json($response);
        }
    }

    /*code of editing competition submission design*/

    public function competitionSubmissionDesignEdit(Request $request)
    {
       
        $vl = Validator::make($request->all(), [
            'design_title' => 'required|min:6',
            'design_cover_image' => 'mimes:jpeg,png,jpg',
            'design_pdf' => 'mimes:pdf',
            'competition_id' => 'required',
            'submission_id' =>'required'
        ], [
            'design_pdf.mimes' => 'Please only upload pdf file'
        ]);

        if ($vl->passes()) {
            //upload cover image
            $cover_image = "";
            if ($request->hasFile("design_cover_image")) {
                $file = $request->file("design_cover_image");
                $file_path = "competition_submission/" . md5($request->competition_id) . "/cover_image/" . str_random(20) . "." . $file->getClientOriginalExtension();
                Storage::disk("public")->put($file_path, File::get($file));
                $cover_image = "storage/" . $file_path;
            }else{
                 $userDesignPdf =  UserCompetitionDesignSubmition::select('cover')->where('id',$request->submission_id)->first();
               $cover_image = $userDesignPdf->cover;
            }

            //upload Pdf id any
            $pdf_file = "";
            if ($request->hasFile("design_pdf")) {
                $file = $request->file("design_pdf");
                $file_path = "competition_submission/" . md5($request->competition_id) . "/pdf/" . str_random(20) . "." . $file->getClientOriginalExtension();
                Storage::disk("public")->put($file_path, File::get($file));
                $pdf_file = "storage/" . $file_path;
            }else{
               $userDesignPdf =  UserCompetitionDesignSubmition::select('pdf')->where('id',$request->submission_id)->first();
               $pdf_file = $userDesignPdf->pdf;
            }
           
         
            $CompetitionDesign = UserCompetitionDesignSubmition::where('id',$request->submission_id)->first();;
            $CompetitionDesign->title = $request->design_title;
            $CompetitionDesign->cover = $cover_image;
            $CompetitionDesign->body = $request->design_body;
            $CompetitionDesign->pdf = $pdf_file;
            $CompetitionDesign->save();

            /*UserCompetitionDesignSubmition::insert([
                'user_id' => Auth::id(),
                'competition_id' => $request->competition_id,
                'title' => $request->design_title,
                'cover' => $cover_image,
                'body' => $request->design_body,
                'pdf' => $pdf_file
            ]);*/

            $response['return'] = true;
            $response['message'] = "success";
            return response()->json($response);
        } else {
            $response['return'] = false;
            $response['error_keys'] = array_keys($vl->getMessageBag()->toArray());
            $response['error'] = $vl->getMessageBag()->toArray();
            return response()->json($response);
        }
    }

    /*
     * Fetch competition Submission view & Parse files
     * */
    public function competitionSubmission(UserCompetition $userCompetition)
    {
        $items = UserCompetitionDesignSubmition::where("competition_id", $userCompetition->id)->orderBy("created_at", "desc")->with('participation', 'likes', 'likes.user', 'comments.user')->simplePaginate(9);

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

        return view('users.competition-submission', [
            'competition' => $userCompetition,
            "items" => $items,
            "user_comments_posts_array" => array_flip($user_comments_posts_array),
            "user_like_posts_array" => array_flip($user_like_posts_array),
            "submissionFlag" => 'y'
        ]);
    }

    public function competitionSubmissionHTTP()
    {
        $type = Input::get("type");
        $competition_id = Input::get("competition");

        $query = UserCompetitionDesignSubmition::where("competition_id", $competition_id);
       
        if ($type == "newest") {
            $query->orderBy("created_at", "desc");
        } else if ($type == "oldest") {
            $query->orderBy("created_at", "asc");
        }

        $items = $query->with('participation', 'likes', 'likes.user', 'comments.user')->limit(20)->get();

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
     
        return view('users.partials.competition-submission-card', [
            "items" => $items,
            "user_comments_posts_array" => array_flip($user_comments_posts_array),
            "user_like_posts_array" => array_flip($user_like_posts_array),
            "submissionFlag" => 'y'
        ]);
    }


    public function competitionSubmissionLike(Request $request)
    {

        $data['likeable_id'] = $request->like_id;
        $data['user_id'] = Auth::id();


        $rules = [
            'likeable_id' => 'required'
        ];

        $vl = Validator::make($data, $rules);

        if ($vl->passes()) {
            $likes = new Like();
            $count_like = Like::where("user_id", Auth::id())
                ->where("likeable_id", $data['likeable_id'])
                ->where("likeable_type", "App\\UserCompetitionDesignSubmition");
            if ($count_like->count() > 0) {
                $count_like->delete();
                $response['return'] = true;
                $response['data'] = $likes;
                $response['count'] = Like::where("likeable_id", $data['likeable_id'])
                    ->where("likeable_type", "App\\UserCompetitionDesignSubmition")->count();
                $response['message'] = "Post Successfully";
                return Response()->json($response, 200);
            } else {
                $likes->user_id = Auth::id();
                $likes->likeable_type = 'App\\UserCompetitionDesignSubmition';
                $likes->likeable_id = $data['likeable_id'];
                $likes->created_at = date("Y-m-d h:i:s");
                $likes->save();
                $response['return'] = true;
                $response['data'] = $likes;
                $response['count'] = Like::where("likeable_id", $data['likeable_id'])
                    ->where("likeable_type", "App\\UserCompetitionDesignSubmition")->count();
                $response['message'] = "Post Successfully";
                return Response()->json($response, 200);
            }

        } else {
            $keys = array_keys($vl->getMessageBag()->toArray());
            $response['return'] = false;
            $response['errors'] = $vl->getMessageBag()->toArray();
            $response['errors_keys'] = $keys;
            return Response()->json($response, 200);
        }

    }


    public function competitionResult(UserCompetition $userCompetition)
    {

        $userCompetition->load('usersCompetitionDesignSubmitionAward',
            'usersCompetitionDesignSubmitionAward.usersCompetitionDesignSubmitionAwardItem',
            'usersCompetitionDesignSubmitionAward.usersCompetitionDesignSubmitionAwardItem.usersCompetitionsAward',
            'usersCompetitionDesignSubmitionAward.usersCompetitionDesignSubmitionAwardItem.usersCompetitionsDesign',
            'usersCompetitionDesignSubmitionAward.usersCompetitionDesignSubmitionAwardItem.usersCompetitionsDesign.participation',
            'usersCompetitionDesignSubmitionAward.usersCompetitionDesignSubmitionAwardItem.usersCompetitionsDesign.likes',
            'usersCompetitionDesignSubmitionAward.usersCompetitionDesignSubmitionAwardItem.usersCompetitionsDesign.likes.user',
            'usersCompetitionDesignSubmitionAward.usersCompetitionDesignSubmitionAwardItem.usersCompetitionsDesign.comments.user');

        //with('participation', 'likes', 'likes.user', 'comments.user')->get();

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


        return view('users.competition-results', [
            'competition' => $userCompetition,
            "user_comments_posts_array" => array_flip($user_comments_posts_array),
            "user_like_posts_array" => array_flip($user_like_posts_array)
        ]);

    }

    /*
     * Competition result submission admin
     *
     * */
    public function competitionAdmin(UserCompetition $userCompetition)
    {
        if ($userCompetition->user_id != Auth::id()) {
            abort(404);
        }

        $userCompetition->load('usersCompetitionsAward',
            'userCompetitionSubmission',
            'userCompetitionSubmission.user');

        return view('users.competition-admin', [
            'competition' => $userCompetition
        ]);
    }

    /*
     * Competition result submission admin save
     * */
    public function competitionAdminResultDeclareSave(Request $request)
    {

        // print_r($request->result_id);

        // print_r($request->award_type);
        // exit;
        $rules = [
            'title' => 'required',
            'time' => 'required',
        ];

        $array = array();
        $array['competition_id'] = $request->competition_id;
        $array['title'] = $request->title;
        $array['time'] = $request->time;

        $vl = Validator::make($array, $rules);
        if ($vl->passes()) {
            $array_award_item = array();
            $userdesignsubmissionaward = UsersCompetitionDesignSubmitionAward::create($array);
            foreach ($request->award_type as $key => $value) {
                if ($value != 0) {
                    $array_award_item[$key]['competition_id'] = $request->competition_id;
                    $array_award_item[$key]['design_id'] = $value;
                    $array_award_item[$key]['result_id'] = $request->result_id[$key];
                    $array_award_item[$key]['users_competition_design_submition_award_id'] = $userdesignsubmissionaward->id;
                }
            }

            UsersCompetitionDesignSubmitionAwardItem::insert($array_award_item);
            $userParticipate = ParticipateUser::where('compition_id',$request->competition_id)->distinct()->orderBy('id', 'desc')->get();
            $competitionDetail =  UserCompetition::select("slug","competition_title")->where('id',$request->competition_id)->first();
           

            // if(!empty($userParticipate) && count($userParticipate) > 0){

            //     foreach ($userParticipate as $key => $participate) {
                   
            //            if (isset($participate->participate_id1) && !empty($participate->participate_id1) && $participate->participate_id1 != null) {
            //                 $user = User::where("id",$participate->participate_id1)->first();
            //                 $content = [
            //                     'name' => $user->fullName(),
            //                     'competition_title' => $competitionDetail->competition_title,
            //                     'slug' => $competitionDetail->slug
            //                 ];

            //                 Mail::to($user->email)->send(new CompetitionResultDeclare($content));
            //             }

            //             if (isset($participate->participate_id2) && !empty($participate->participate_id2) && $participate->participate_id2 != null) {
            //                 $user = User::where("id",$participate->participate_id2)->first();
            //                 $content = [
            //                     'name' => $user->fullName(),
            //                     'competition_title' => $competitionDetail->competition_title,
            //                      'slug' => $competitionDetail->slug
            //                 ];

            //                 Mail::to($user->email)->send(new CompetitionResultDeclare($content));
            //             }

            //             if (isset($participate->participate_id3) && !empty($participate->participate_id3) && $participate->participate_id3 != null) {
            //                 $user = User::where("id",$participate->participate_id3)->first();
            //                 $content = [
            //                     'name' => $user->fullName(),
            //                     'competition_title' => $competitionDetail->competition_title,
            //                      'slug' => $competitionDetail->slug
            //                 ];

            //                 Mail::to($user->email)->send(new CompetitionResultDeclare($content));
            //             }

            //             if (isset($participate->participate_id4) && !empty($participate->participate_id4) && $participate->participate_id4 != null) {
            //                 $user = User::where("id",$participate->participate_id4)->first();
            //                 $content = [
            //                     'name' => $user->fullName(),
            //                     'competition_title' => $competitionDetail->competition_title,
            //                      'slug' => $competitionDetail->slug
            //                 ];

            //                 Mail::to($user->email)->send(new CompetitionResultDeclare($content));
            //             }

            //             if (isset($participate->participate_id5) && !empty($participate->participate_id5) && $participate->participate_id5 != null) {
            //                 $user = User::where("id",$participate->participate_id5)->first();
            //                 $content = [
            //                     'name' => $user->fullName(),
            //                     'competition_title' => $competitionDetail->competition_title,
            //                      'slug' => $competitionDetail->slug
            //                 ];

            //                 Mail::to($user->email)->send(new CompetitionResultDeclare($content));
            //             }

            //             if (isset($participate->mentor_id1mentor_id2) && !empty($participate->mentor_id1mentor_id2) && $participate->mentor_id1mentor_id2 != null) {
            //                 $user = User::where("id",$participate->mentor_id1mentor_id2)->first();
            //                 $content = [
            //                     'name' => $user->fullName(),
            //                     'competition_title' => $competitionDetail->competition_title,
            //                      'slug' => $competitionDetail->slug
            //                 ];

            //                 Mail::to($user->email)->send(new CompetitionResultDeclare($content));
            //             }

            //             if (isset($participate->mentor_id2) && !empty($participate->mentor_id2) && $participate->mentor_id2 != null) {
            //                 $user = User::where("id",$participate->mentor_id2)->first();
            //                 $content = [
            //                     'name' => $user->fullName(),
            //                     'competition_title' => $competitionDetail->competition_title,
            //                      'slug' => $competitionDetail->slug
            //                 ];

            //                 Mail::to($user->email)->send(new CompetitionResultDeclare($content));
            //             }
            //         }

            // }
           

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


    public function competitionUpdate(Request $request)
    {
        $userCompetition = UserCompetition::where('slug', $request->users_competition_slug)->first();
        $rules = [
            'cover_image' => 'required|mimes:jpeg,bmp,png',
            'competition_title' => 'required|unique:users_competition,competition_title,' . $userCompetition->id,
            'competition_brief' => 'required',
            'eligibility_criteria' => 'required',
            'award_type.*' => 'required',
            'award_amount.*' => 'required',
            'award_currency.*' => 'required',
            'award_extra.*' => 'required',
            'honourable_mentions' => 'required',
            'schedule_start_date_of_registration' => 'required',
            'schedule_close_date_of_registration' => 'required',
            'schedule_closing_date_of_project_submission' => 'required',
            'schedule_announcement_of_the_winner' => 'required',
            'competition_type' => 'required',
        ];

        $message = [

        ];

        $vl = Validator::make($request->all(), $rules, $message);

        if ($vl->passes()) {

            $slug = str_slug($request->competition_title);

            //upload banner image
            $imagepath = "competition/" . $slug . "/" . $slug . "_cover.jpg";
            Storage::disk("public")->put($imagepath, File::get($request->cover_image));

            $userCompetition = UserCompetition::where('slug', $request->users_competition_slug)->update([
                'user_id' => Auth::id(),
                /* 'slug' => $slug,*/
                'cover_image' => 'storage/' . $imagepath,
                'competition_title' => $request->competition_title,
                'brief' => $request->competition_brief,
                'eligibility_criteria' => $request->eligibility_criteria,
                'jury_type' => $request->jury_type,
                'honourable_mentions' => $request->honourable_mentions,
                'schedule_start_date_of_registration' => $request->schedule_start_date_of_registration,
                'schedule_close_date_of_registration' => $request->schedule_close_date_of_registration,
                'schedule_closing_date_of_project_submission' => $request->schedule_closing_date_of_project_submission,
                'schedule_announcement_of_the_winner' => $request->schedule_announcement_of_the_winner,
                'competition_type' => $request->competition_type,
                'early_bird_registration_start_date' => $request->early_bird_registration_start_date,
                'early_bird_registration_end_date' => $request->early_bird_registration_end_date,
                'advance_registration_start_date' => $request->advance_registration_start_date,
                'advance_registration_end_date' => $request->advance_registration_end_date,
                'last_minute_registration_start_date' => $request->last_minute_registration_start_date,
                'last_minute_registration_end_date' => $request->last_minute_registration_end_date,
                'partner_type' => $request->partner_type,
                'reg_from' => $request->reg_form,
                'reg_url' => $request->url
            ]);

            //Add Jury


            $userJury = array();

            foreach ($request->jury_fullname as $key => $fullname) {
                $jury_firm_company = $request->jury_firm_company[$key];
                $jury_email = $request->jury_email[$key];
                $jury_contact = $request->jury_contact[$key];

                //upload jury logo
                $path = "";
                if ($request->hasFile('jury_logo.' . $key)) {
                    $str_random = "competition/" . $slug . "/jury/" . str_random() . ".jpg";
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
            foreach ($request->user_competition_jury_id as $key => $value) {


                //$val = $request->user_competition_jury_id[$key];

                if ($request->user_competition_jury_id[$key] != null) {
                    UserCompetitionJury::where('id', $request->user_competition_jury_id[$key])->update($userJury);
                } else {
                    UserCompetitionJury::insert($userJury);
                }

            }


            /*file attachment*/

            $file_attachment = array();
            if (!empty($request->file('attach_documents'))) {
                foreach ($request->file('attach_documents') as $key => $logo) {
                    //upload  logo
                    $path = "";
                    if ($request->hasFile('attach_documents.' . $key)) {
                        $str_random = "competition/" . $slug . "/attachment/" . str_random(20) . "." . $logo->getClientOriginalExtension();
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
            }


            //Insert awards


            $awards = array();
            foreach ($request->award_type as $key => $award_type) {
                $innerArray = [
                    'user_id' => Auth::id(),
                    'competition_id' => $userCompetition->id,
                    'award_type' => $request->award_type[$key],
                    'award_amount' => $request->award_amount[$key],
                    'award_currency' => $request->award_currency[$key],
                    'award_extra' => $request->award_extra[$key]
                ];

                $awards[] = $innerArray;
            }

            UserCompetitionAward::insert($awards);

            //Registration type
            $registrationType = array();
            if ($request->competition_type != "free") {
                foreach ($request->early_bird_registration_type as $key => $value) {
                    $innerArray = [
                        'user_id' => Auth::id(),
                        'competition_id' => $userCompetition->id,
                        'type' => $value,
                        'currency' => $request->early_bird_registration_currency[$key],
                        'amount' => $request->early_bird_registration_amount[$key],
                        'registration_type' => "early_bird"
                    ];

                    $registrationType[] = $innerArray;
                }

                foreach ($request->advance_registration_type as $key => $value) {
                    $innerArray = [
                        'user_id' => Auth::id(),
                        'competition_id' => $userCompetition->id,
                        'type' => $value,
                        'currency' => $request->advance_registration_currency[$key],
                        'amount' => $request->advance_registration_amount[$key],
                        'registration_type' => "advance"
                    ];

                    $registrationType[] = $innerArray;
                }


                foreach ($request->last_minute_registration_type as $key => $value) {
                    $innerArray = [
                        'user_id' => Auth::id(),
                        'competition_id' => $userCompetition->id,
                        'type' => $value,
                        'currency' => $request->last_minute_registration_currency[$key],
                        'amount' => $request->last_minute_registration_amount[$key],
                        'registration_type' => "last_minute"
                    ];

                    $registrationType[] = $innerArray;
                }

                UserCompetitionRegistrationType::insert($registrationType);
            }

            //partner

            $userPartner = array();
            foreach ($request->partner_name as $key => $item) {
                //upload partner logo
                $path = "";
                if ($request->hasFile("partner_logo." . $key)) {
                    $str_random = "competition/" . $slug . "/partner/" . str_random() . ".jpg";
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
            $response["slug"] = $userCompetition->slug;
        } else {
            //error
            $response["return"] = false;
            $response["message"] = "Validation errors";
            $response["error_keys"] = array_keys($vl->getMessageBag()->toArray());
            $response['error'] = $vl->getMessageBag()->toArray();
        }

        return response()->json($response);
    }

    function submissionDelete(Request $request)
    {
        $data['submission_id'] = $request->submission_id;

        $rules = [
            'submission_id' => 'required'
        ];

        $vl = Validator::make($data, $rules);

        if ($vl->passes()) {
          
            UserCompetitionDesignSubmition::where('id',$data['submission_id'])->delete();
            $response['return'] = true;
            $response['message'] = "Submission Deleted Successfully";
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
