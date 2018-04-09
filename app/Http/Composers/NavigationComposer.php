<?php 
namespace App\Http\Composers;

use Illuminate\Contracts\View\View;
use Auth;
use App\User;
use App\Chat;
use App\ChatFriend;
use Stdclass;

class NavigationComposer{

	public function compose(View $view)
	{
		$users = Auth::user()->friends();
		// print_r($users);
		$act = array();
		foreach ($users as $user)
        {
            $act[]= $user->id;
        }
        print_r($act);
		for($i=0;$i<sizeof($act);$i++)
		{
			$chats[$i] = new stdCLass();
			$chats[$i]->name = User::where('id',"=",$act[$i])->select('first_name','last_name','name','profile')->get();
			$chats[$i]->chat = Chat::where('user_from','=',$act[$i])->orderBy('created_at', 'desc')->select('chat','created_at')->first();
		}
		$view->with('chats',$chats);
	}
}