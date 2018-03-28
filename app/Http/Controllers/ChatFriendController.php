<?php

namespace App\Http\Controllers;

use App\ChatFriend;
use Auth;
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
        //
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
    public function update(Request $request, ChatFriend $chatFriend)
    {
        //
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
}
