<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserTest extends DuskTestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_toppage()
    {
        $response = $this->get('/');

        $response->assertStatus(200)
                 ->assertViewIs('welcome')
                 ->assertSee('特定のTwitterユーザーに対し');
    }

    public function test_register(){
        $this->browse(function (Browser $browser){
            $browser->visit('/')
                ->assertSee('特定のTwitterユーザーに対し');
                #->type('test@localhost', 'email')
                #->type('password', 'password')
                #->type('.email', 'test@localhost')
                #->press('仮登録')
                #->see('仮登録が完了しました。 メールをご確認ください。');
            /*Mail::assertSent(
                ContactMail::class,
                function ($mail) use ($user) {
                    return $mail->to[0]['address'] === $user->email;
                }
            );*/
        });
    }
}
