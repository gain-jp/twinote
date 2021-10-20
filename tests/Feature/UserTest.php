<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Mail\Registered;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_toppage()
    {
        $response = $this->get('/');

        $response->assertStatus(200)
                 ->assertViewIs('welcome')
                 ->assertSee('特定のTwitterユーザーに対し');
    }

    public function test_register_login(){
        $this->register();
        $this->login();
    }

    public function register(){
        Mail::fake();
        $response = $this->post('/twinote_user/register/send', ['email' => 'test@localhost', 'password' => 'password']);
        $response->assertSee('仮登録が完了');
        global $URL;
        $URL = '';
        Mail::assertSent(
            Registered::class,
            function ($mail){
                global $URL;
                $URL = $mail->URL;
                return $mail->hasTo('test@localhost');
            }
        );
        $token = explode('token=', $URL)[1];
        $response = $this->get('/twinote_user/register/complete?token='.$token);
        $response->assertSee('本登録が完了しました');
    }

    public function login(){
        $response = $this->post('/twinote_user/login', ['email' => 'test@localhost', 'password' => 'password']);
        $response->assertRedirect('/twinote_user');
    }
}
