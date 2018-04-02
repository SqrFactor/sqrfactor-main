<?php

namespace App\Http\Controllers\Message;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ChatChannel;
//use Auth;

class ChatController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth:web');
    }

    public function index()
    {
        // $chatChannels = ChatChannel::where("from_id", Auth::id())
        //     ->orWhere("to_id", Auth::id())
        //     ->with('from_user', 'to_user')->get();

        return view('messages-final.messages-view');
    }

   
}
