<?php

namespace App\Http\Controllers\message;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ChatChannel;
use Auth;

class Message extends Controller
{

    public function __construct()
    {

        $this->middleware('auth:web');
    }

    public function index()
    {
        $chatChannels = ChatChannel::where("from_id", Auth::id())
            ->orWhere("to_id", Auth::id())
            ->with('from_user', 'to_user')->get();

        return view('message.message-view', compact('chatChannels'));
    }

    public function channelCreate(Request $request)
    {
        $to_id = $request->user_id;
        $from_id = Auth::id();

        $results = ChatChannel::where([
            ['from_id', '=', $from_id],
            ['to_id', '=', $to_id]
        ])->orWhere([
            ['from_id', '=', $to_id],
            ['to_id', '=', $from_id]
        ])->first();


        if (!empty($results) && count($results) > 0) {

            return $results;
        }else{
           $user_data =  ChatChannel::create([
                "from_id" => $from_id,
                "to_id" => $to_id,
                "channel" => str_random(20)

            ]);
         
           $results =  $user_data;

            return $results;
        }
    }

    public function viewMessage($channel)
    {
        $chatChannels = ChatChannel::where("channel","!=",$channel)
            ->where("from_id", Auth::id())
            ->orWhere("channel","!=",$channel)
            ->Where("to_id", Auth::id())
            ->with('from_user', 'to_user')
            ->get();

        $currentChat = ChatChannel::where("channel", $channel)
            ->where("to_id", Auth::id())
            ->orWhere("channel",$channel)
            ->where("from_id",Auth::id())
            ->with('from_user', 'to_user')
            ->first();

        if ($currentChat == null){
            abort(404);
        }

        return view('message.user-message',[
            'chatChannels' => $chatChannels,
            'currentChannels' => $currentChat
        ]);
    }
}
