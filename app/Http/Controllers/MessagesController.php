<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMessageRequest;
use App\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function show(Message $message)
    {
        return view('messages.show', ['message' => $message]);
    }

    public function create(CreateMessageRequest $request)
    {
        $user = $request->user();
        $message = new Message();
        $message->content = $request->input('message');
        $message->image = 'http://www.lorempixel.com/600/338?'.mt_rand(0,100);
        $message->user_id = $user->id;
        $message->save();
        return redirect()->action('MessagesController@show',['message'=>$message->id]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        //$messages = Message::with('user')->where('content','LIKE','%'.$query.'%')->get();
        $messages = Message::search($query)->get();
        $messages->load('user');
        return view('messages.search',['messages'=>$messages]);
    }
}
