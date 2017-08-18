<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\PrivateMessage;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function showMessages($username)
    {
        $user = $this->findByUserName($username);
        $messages = $user->messages()->paginate(4);
        return view('users.show_messages',['user'=>$user,'messages'=>$messages]);
    }

    public function follows($username){
        $user = $this->findByUserName($username);
        return view('users.follows',[
            'user'=>$user
        ]);
    }

    public function follow($username,Request $request)
    {
        $user = $this->findByUserName($username);
        $me = $request->user();
        //if(!isset($me)) return redirect()->route('login');
        $me->follows()->attach($user);
        return redirect()->action( 'UsersController@showMessages',['username'=>$username])
            ->withSuccess('Siguiendo');
    }

    public function unfollow($username,Request $request)
    {
        $user = $this->findByUserName($username);
        $me = $request->user();
        $me->follows()->detach($user);
        return redirect()->action( 'UsersController@showMessages',['username'=>$username])
            ->withSuccess('Dejas de Siguir');
    }

    public function followers($username)
    {
        $user = $this->findByUserName($username);
        return view('users.followers',[
            'user'=>$user
        ]);
    }

    public function sendPrivateMessage($username, Request $request)
    {
        $user = $this->findByUserName($username);
        $me = $request->user();
        $message = $request->input('message');

        $conversation = new Conversation();
        $conversation->save();
        $conversation->users()->attach($me);
        $conversation->users()->attach($user);

        $privateMessage = new PrivateMessage();
        $privateMessage->conversation_id = $conversation->id;
        $privateMessage->user_id = $me->id;
        $privateMessage->message = $message;
        $privateMessage->save();
        return redirect('/conversation/'.$conversation->id);
    }

    public function showMesssage(Conversation $conversation)
    {
        dd($conversation);
    }

    private function findByUserName($username)
    {
        return User::where('username',$username)->firstOrFail();
    }

}
