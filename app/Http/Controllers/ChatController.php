<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use App\User;

class ChatController extends Controller
{
    
    public function __cosntruct()
    {
        $this->middleware('auth');
    }

    public function addMessage(Request $request) 
    {
        $this->validate($request, ['message' => 'required']);

        $user = User::find($request->input('user_id'));
        $name = $user->first_name.' '.$user->last_name;

        $chat = new Chat();
        $chat->user_id = $request->input('user_id');
        $chat->user_name = $name;
        $chat->message = htmlspecialchars($request->input('message'));
        $chat->save();

        return 200;
    }

    public function getMessages()
    {
        $messages = Chat::orderBy('id','DESC')->get();

        return $messages;
    }
}
