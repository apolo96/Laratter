<?php

namespace App\Http\Controllers;

use App\SocialFacebookAccount;
use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteAuthController extends Controller
{
    public function facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        $userSocial = Socialite::driver('facebook')->user();

        $userExisting = User::whereHas('socialFacebookAccounts', function ($query)
        use ($userSocial){
            $query->where('social_id',$userSocial->id);
        })->first();

        if($userExisting !== null)
        {
            auth()->login($userExisting);
            return redirect('/');
        }

        session()->flash('facebookUser',$userSocial);
        return view('users.facebook',['user'=>$userSocial]);
    }

    public function register(Request $request)
    {
        $facebookUserData = session('facebookUser');
        $username = $request->input('username');

        $user = new User();
        $user->name = $facebookUserData->name;
        $user->email = $facebookUserData->email;
        $user->avatar = $facebookUserData->avatar;
        $user->username = $username;
        $user->password = str_random(16);
        $user->save();

        $facebookAccount = new SocialFacebookAccount();
        $facebookAccount->user_id = $user->id;
        $facebookAccount->social_id = $facebookUserData->id;
        $facebookAccount->save();

        auth()->login($user);

        return redirect('/');
    }
}
