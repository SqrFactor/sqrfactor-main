<?php

namespace App\Http\Controllers\Parse;

use App\ActivationToken;
use App\Mail\Welcome;
use App\User;
use App\UserDetail;
use App\VerifyOtp;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Mail\SendActivationToken;
use Mail;


class SqrFactorController extends Controller
{
    use RegistersUsers;

    public function register(Request $request)
    {
        $message = array(
            'user_name.unique' => 'That username is taken. Try another.',
            'user_name.alpha_dash' => 'The user name may only contain letters, numbers, and underslot.',
            'user_name.regex' => 'The user name may only contain letters, numbers, and underslot.',
            'first_name.regex' => 'The first name may only contain letters(a-z)',
            'last_name.regex' => 'The last name may only contain letters(a-z)',
        );


        $rules = array(
            'user_name' => 'required|unique:users,user_name|alpha_dash|regex:/^[(a-zA-Z\s._)(0-9\s)]+$/u',
            'first_name' => 'required|regex:/^[(a-zA-Z\s)]+$/u',
            'last_name' => 'required|regex:/^[(a-zA-Z\s)]+$/u',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'terms_and_conditions' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|numeric',
            'user_type' => 'required',
            'country' => 'required',
            'registerOption' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules, $message);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        } else {
            if ($request->first_name !== null AND $request->last_name !== null) {
                $name = $request->first_name . ' ' . $request->last_name . '.' . rand(11000, 99999);
            } elseif ($request->name !== null) {
                $name = $request->name . ' ' . rand(10101, 99999);
            } else {
                $name = str_random(15);
            }

            if($request->country != '91')
            {
                $mobile_verify = 'y';
            }else{
                $mobile_verify = 'n';
            }
            $user = User::create([
                'user_name' => $request->user_name,
                'name' => $request->name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'user_type' => $request->user_type,
                'type' => $request->registerOption,
                'terms_and_conditions' => $request->terms_and_conditions,
                'slug' => str_slug($name),
                'profile' => 'assets/images/avatar.png',
                'mobile_verify'=> $mobile_verify,
                'mobile_number' => $request->mobile_number,
            ]);

            UserDetail::create([
                'slug' => str_slug(str_random(20) . "-" . rand(1111, 9999)),
                'user_id' => $user->id,
            ]);

            return response()->json([
                'successMessage' => 'Please now active your account.'
            ]);
        }
    }

    public function register2(Request $request)
    {
        $message = array(
            'user_name.unique' => 'That username is taken. Try another.',
            'user_name.alpha_dash' => 'The user name may only contain letters, numbers, and underslot.',
            'user_name.regex' => 'The user name may only contain letters, numbers, and underslot.',
            'name.required' => 'The field is required.',
        );

        $rules = array(
            'name' => 'required',
            'user_name' => 'required|unique:users,user_name|alpha_dash|regex:/^[(a-zA-Z\s._)(0-9\s)]+$/u',
            'password' => 'required|min:6||confirmed',
            'password_confirmation' => 'required',
            'terms_and_conditions' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|numeric|digits:10|unique:users,mobile_number',
            'user_type' => 'required',
            'registerOption' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        } else {
            if ($request->first_name !== null AND $request->last_name !== null) {
                $name = $request->first_name . '.' . $request->last_name . '.' . rand(11101, 9999);
            } elseif ($request->name !== null) {
                $name = $request->name . '.' . rand(11111, 9999);
            } else {
                $name = str_random(15);
            }

            $user = User::create([
                'name' => $request->name,
                'user_name' => $request->user_name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'user_type' => $request->user_type,
                'type' => $request->registerOption,
                'terms_and_conditions' => $request->terms_and_conditions,
                'slug' => str_slug($name),
                'profile' => 'assets/images/avatar.png',
                'mobile_number' => $request->mobile_number,
            ]);

            UserDetail::create([
                'slug' => str_slug(str_random(20) . "-" . rand(1111, 9999)),
                'user_id' => $user->id,
            ]);


            $token = ActivationToken::create([
                'user_id' => $user->id,
                'token' => str_random(128),
            ]);




            return response()->json([
                'successMessage' => 'Please now active your account.'
            ]);
        }
    }

    // login
    public function login(Request $request)
    {

        $rules = array(
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessagebag()->toArray(),
            ]);
        } else {
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

                if (Auth::user()->active == '1') {
                    $emailActiveLogin = true;
                    $email = Auth::user()->email;
                } elseif (Auth::user()->active == '0') {
                    $email = Auth::user()->email;
                    Auth::guard('web')->logout();

                    $emailActiveLogin = false;
                }

                return response()->json([
                    'successMessage' => [
                        'email' => $email,
                        'emailActiveLogin' => $emailActiveLogin,
                    ]

                ]);
            } else {
                return response()->json([
                    'errorFailed' => "Your password is wrong."
                ]);
            }


        }
    }

    /*verify otp*/
    public function verifyOtp(Request $request)
    {
        $rules = array(
            "otp" => "required|numeric|digits:6"
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->getMessageBag()->toArray(),
            ]);
        }

        $verifyOtp = VerifyOtp::where([["user_id", Auth::id()], ["mobile_number", Auth::user()->mobile_number], ["otp", $request->otp]]);

        if ($verifyOtp->first()) {  /*verify otp*/
            User::where('id', Auth::id())->update([
                'mobile_verify' => 'y',
            ]);
            $verifyOtp->delete();
            return response()->json([
                "messageSuccessVerifyOtp" => "Otp verified successfully.",
            ]);

        } else {

            return response()->json([
                "messageVerifyOtp" => "Otp does not match try again.",
            ]);

        }

        return response()->json([
            "messageVerifyOtp" => "Otp does not match try again.",
        ]);


    }

    /*resend otp*/
    public function resendOtp(Request $request)
    {
        $verifyOtp = VerifyOtp::where("user_id", Auth::id())->delete();

        // generate otp
        $otp = rand(101010, 999999);

        VerifyOtp::create([
            "user_id" => Auth::id(),
            "mobile_number" => Auth::user()->mobile_number,
            "otp" => $otp,

        ]);


        $mobile_number = Auth::user()->mobile_number;
        $body = array(
            "token" => "TcmJjnIq5q",
            "mob" => $mobile_number,
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

        return response()->json(['resentOtp' => 'Otp has been sent to ' . $mobile_number . '.']);

    }

    /*mobile number update*/
    public function mobileUpdate(Request $request)
    {
        $rules = array(
            'mobile_number' => 'required|numeric|digits:10|unique:users,mobile_number',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessagebag()->toArray(),
            ]);
        } else {
            User::where('id', Auth::id())->update([
                'mobile_number' => $request->mobile_number,
            ]);

            $verifyOtp = VerifyOtp::where("user_id", Auth::id())->delete();

            // generate otp
            $otp = rand(101010, 999999);

            VerifyOtp::create([
                "user_id" => Auth::id(),
                "mobile_number" => $request->mobile_number,
                "otp" => $otp,

            ]);


            $mobile_number = $request->mobile_number;
            $body = array(
                "token" => "TcmJjnIq5q",
                "mob" => $mobile_number,
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
            curl_close($ch);
        }
    }


    public function subMSG(Request $request){
        //DB::insert('insert into msgs (from,to,body) values(?,?,?)',[1,2,"Sachin"]);
        DB::table('msgs')->insert(
            array(
                'from' => $request->from,
                'to' => $request->to,
                'body' => $request->message,
                'from_name'=>$request->from_name,
                'to_name'=>$request->to_name
            )
        );
        return response()->json(array('msg'=> 'success'), 200);
    }

    public function getMSG(Request $request){
        $msgs = DB::select('SELECT * FROM msgs');
        return response()->json(array('msg'=> $msgs), 200);
    }

    public function getNOTI(Request $request){
        $user = User::find($request->to);
        $user->msgCount=$user->msgCount+1;
        $user->save();
        return response()->json(array('msg'=> 'success'), 200);
    }

    public function delNOTI(Request $request){
        $user=User::find($request->from);
        $user->msgCount=0;
        $user->save();
        return response()->json(array('msg'=> 'success'), 200);
    }

    public function getCHNT(Request $request){
        $user=User::find($request->from);
        if(!empty($user)){
                if($user->first_name != null && $user->last_name != null)
                {
                    $fullName = ucfirst($user->first_name) ." ". ucfirst($user->last_name);
                }
                elseif($user->name != null)
                {
                    $fullName = ucfirst($user->name);
                }
                else
                {
                    $fullName = null;
                }
        }
        
        $msgCounts=$user->msgCount;
        if($msgCounts>0){
            $msgs=DB::select("SELECT * FROM msgs WHERE id IN (SELECT max(msgs.id) FROM msgs WHERE msgs.to= $request->from GROUP BY msgs.from) ORDER BY msgs.created_at desc");
            $msgs['username'] = $fullName;
            return response()->json(array('allmsgs'=>$msgs), 200);
        }
        else{
            $temp='success';
            return response()->json(array('allmsgs'=>$temp), 200);
        }
        /*$msgs = DB::table('msgs')
                      ->where('to',$request->from)
                      ->orderBy('created_at','asc')
                      ->groupBy('from')
                      ->latest()
                      ->limit($msgCounts)
                      ->get();*/
        //->where('to', $request->from)->orderBy('created_at', 'desc')->groupBy('from')->count();

    }
    public function getallUSERS(Request $request){
        //$users=User::all();

        $users = DB::select("SELECT table1.id as id, table1.user_name as user_name, table2.from, table2.to, table2.body, table2.created_at, table2.from_name, table2.to_name
            FROM users AS table1 
            LEFT JOIN (SELECT * FROM msgs WHERE msgs.id IN(SELECT max(msgs.id) FROM msgs WHERE msgs.to = $request->from GROUP BY msgs.from)) 
             table2 ON table1.id=table2.from where table2.to = $request->from ORDER BY table2.created_at desc");
        
        return response()->json(array('msg'=> $users), 200);
    }

    
    public function fullName(Request $request)
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
}
