<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Response;
use Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {

    }



     public function msg(Request $request){
                    $search = explode(' ',$request->search);
        
        if(!empty($request->search)){

          
            $results = User::where([
            ['active','=','1'],
            ['user_name','!=',NULL],
            ['deleted_at','=',NULL],
            ['first_name','like','%' . $request->search . '%']
            ])->orWhere([
                ['active','=','1'],
                ['user_name','!=',NULL],
                ['deleted_at','=',NULL],
                ['last_name','like','%' . $request->search . '%']
            ])->orWhere([
                ['active','=','1'],
                ['user_name','!=',NULL],
                ['deleted_at','=',NULL],
                ['name','like','%' . $request->search . '%']
            ])->orWhere([
                ['active','=','1'],
                ['user_name','!=',NULL],
                ['deleted_at','=',NULL],
                ['user_name','like','%' . $request->search . '%']
            ])->orWhere([
                ['active','=','1'],
                ['user_name','!=',NULL],
                ['deleted_at','=',NULL],
                ['email','like','%' . $request->search . '%']
            ]);
            if(isset($search[1])){
              $results =  $results->orWhere([
                ['active','=','1'],
                ['user_name','!=',NULL],
                ['deleted_at','=',NULL],
                ['first_name','like','%' . $search[0] . '%'],
                ['last_name','like','%' . $search[1] . '%']
                ])->get();
            }else{
               $results =  $results->get();
            }

            
        }else{
            $results = "";
        }


         if(count($results) > 0 ){
            foreach ($results as $user){
                if(!empty($user->name)){
                    $name = $user->name;
                }elseif(!empty($user->first_name)){
                    $name = $user->first_name." ".$user->last_name;
                }
                /*route*/
                if(Auth::id() == $user->id)
                {
                    $route = route('profile');

                }else{
                   $route = route("profileView",$user->user_name);
                }
                echo '<li id="'.$user->id.'" name="'.$user->user_name.'" class="newuser"><a href="#" class="h6 notification-friend mb-1"><img src="'.asset($user->profile).'" width="50px" height="50px"><span>'.$name.'</span></a></li>';
            }
        }else{
            echo 0;
        }
    }




    public function searchAjax(Request $request){
        $search = explode(' ',$request->search);
        
        if(!empty($request->search)){

          
            $results = User::where([
            ['active','=','1'],
            ['user_name','!=',NULL],
            ['deleted_at','=',NULL],
            ['first_name','like','%' . $request->search . '%']
            ])->orWhere([
                ['active','=','1'],
                ['user_name','!=',NULL],
                ['deleted_at','=',NULL],
                ['last_name','like','%' . $request->search . '%']
            ])->orWhere([
                ['active','=','1'],
                ['user_name','!=',NULL],
                ['deleted_at','=',NULL],
                ['name','like','%' . $request->search . '%']
            ])->orWhere([
                ['active','=','1'],
                ['user_name','!=',NULL],
                ['deleted_at','=',NULL],
                ['user_name','like','%' . $request->search . '%']
            ])->orWhere([
                ['active','=','1'],
                ['user_name','!=',NULL],
                ['deleted_at','=',NULL],
                ['email','like','%' . $request->search . '%']
            ]);
            if(isset($search[1])){
              $results =  $results->orWhere([
                ['active','=','1'],
                ['user_name','!=',NULL],
                ['deleted_at','=',NULL],
                ['first_name','like','%' . $search[0] . '%'],
                ['last_name','like','%' . $search[1] . '%']
                ])->get();
            }else{
               $results =  $results->get();
            }

            
        }else{
            $results = "";
        }
       
        if(count($results) > 0 ){
           
            foreach ($results as $user){
                if(!empty($user->name)){
                    $name = $user->name;
                }elseif(!empty($user->first_name)){
                    $name = $user->first_name." ".$user->last_name;
                }
                /*route*/
                if(Auth::id() == $user->id)
                {
                    $route = route('profile');

                }else{
                   $route = route("profileView",$user->user_name);
                }
                echo '<li><a href="'.$route.'"><img src="'.asset($user->profile).'" ><span>'.$name.'</span></a></li>';
            }
        }else{
            echo 0;
        }
    }

    public function searchResults(Request $request){
       $query = explode(' ',request('query'));

        $search = request('query');
        
        if(!empty($request->query)){

          
            $results = User::where([
            ['active','=','1'],
            ['user_name','!=',NULL],
            ['deleted_at','=',NULL],
            ['first_name','like','%'. request('query') .'%']
            ])->orWhere([
                ['active','=','1'],
                ['user_name','!=',NULL],
                ['deleted_at','=',NULL],
                ['last_name','like','%' . request('query') . '%']
            ])->orWhere([
                ['active','=','1'],
                ['user_name','!=',NULL],
                ['deleted_at','=',NULL],
                ['name','like','%' . request('query') . '%']
            ])->orWhere([
                ['active','=','1'],
                ['user_name','!=',NULL],
                ['deleted_at','=',NULL],
                ['user_name','like','%' . request('query') . '%']
            ])->orWhere([
                ['active','=','1'],
                ['user_name','!=',NULL],
                ['deleted_at','=',NULL],
                ['email','like','%' . request('query') . '%']
            ]);
            if(isset($query[1])){
              $results =  $results->orWhere([
                ['active','=','1'],
                ['user_name','!=',NULL],
                ['deleted_at','=',NULL],
                ['first_name','like','%' . $query[0] . '%'],
                ['last_name','like','%' . $query[1] . '%']
                ])->get();
            }else{
                  $results =  $results->get();
            }

            
        }else{
               $results = "Nothing Found!";
        }

        return view('users.search', compact('results', 'search'));
       
        
    }

}
