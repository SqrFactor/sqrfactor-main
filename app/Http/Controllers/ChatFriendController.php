<?php

namespace App\Http\Controllers;

use App\ChatFriend;
use Auth;
use App\Chat;
use Illuminate\Http\Request;


class ChatFriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friends = Auth::user()->friends();
        return view('friend.index',compact('friends'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $friend = new ChatFriend;
        // $new_chat = new Chat;
        // $friend->user_from = Auth::user()->id;
        // $friend->user_to = $request->id;
        // $new_chat->user_from =  Auth::user()->id;
        // $new_chat->user_to = $request->id;
        // $new_chat->chat = $request->chat;
        // $friend->save();
        // $new_chat->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChatFriend  $chatFriend
     * @return \Illuminate\Http\Response
     */
    public function show(ChatFriend $chatFriend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChatFriend  $chatFriend
     * @return \Illuminate\Http\Response
     */
    public function edit(ChatFriend $chatFriend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChatFriend  $chatFriend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChatFriend  $chatFriend
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChatFriend $chatFriend)
    {
        //
    }

    public function sendMessage(Request $request, $id)
    {
        $friend = new ChatFriend;
        $new_chat = new Chat;
        $condition = ChatFriend::where(['user_from'=>Auth::user()->id,'user_to'=>$id])
                                 ->orWhere(['user_from'=>$id,'user_to'=>Auth::user()->id])->get();
        if(isset($condition) && count($condition)>0){                 
            $new_chat->user_from =  Auth::user()->id;
            $new_chat->user_to = $id;
            $new_chat->chat = $request->chat;
            $new_chat->save();
            session()->flash('message','You message has been sent successfully.');
            return redirect()->back();           
        }
        else{ 
            $friend->user_from = Auth::user()->id;
            $friend->user_to = $id;            
            $new_chat->user_from =  Auth::user()->id;
            $new_chat->user_to = $id;
            $new_chat->chat = $request->chat;
            $friend->save();
            $new_chat->save();
            session()->flash('message','You message has been sent successfully.');
            return redirect()->back();
        }
    }

}
