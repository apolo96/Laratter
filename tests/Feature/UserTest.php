<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Support\Facades\App;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    use InteractsWithDatabase;

    public function testCanSeeUserPage()
    {
        $user = factory(User::class)->create();
        $response = $this->get('/user/'.$user->username);
        $response->assertSee($user->username);
    }

    public function testCanLogin()
    {
        $user = factory(User::class)->create();
        $response = $this->post('/login',[
            'email'=>$user->email,
            'password'=>'secret'
        ]);
        $this->seeIsAuthenticatedAs($user);
    }

    public function testCanFollow()
    {
        $user = factory(User::class)->create();
        $other = factory(User::class)->create();

        $response = $this->actingAs($user)->post(' /user/'.$other->username.'/follow');
        $this->assertDatabaseHas('followers',[
            'user_id' => $user->id,
            'follower_id'=> $other->id
        ]);
    }
}
