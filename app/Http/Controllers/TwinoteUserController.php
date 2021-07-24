<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewTwinoteUser;
use App\Models\TwinoteUser;
use Illuminate\Support\Facades\Mail;

class TwinoteUserController extends Controller
{
    public function register(){
        return View('register');
    }

    public function send(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $token = bin2hex(openssl_random_pseudo_bytes(32));
        
        $find_conflict = TwinoteUser::where('email', $email)->first();
        if($find_conflict){
            return 'Error: このメールアドレスは既に登録されています。';
        }

        $old_registration = NewTwinoteUser::where('email', $email)->first();
        if($old_registration){
            $old_registration->where('email', $email)
            ->update(['password' => $password_hash, 'token' => $token]);
        }else{
            $new_twinote_user = NewTwinoteUser::create([
                'email' => $email,
                'password' => $password_hash,
                'token' => $token
            ]);
        }

        $URL = config('app.url').'/twinote_user/register/complete?token='.$token;

        Mail::send('emails.user_register',
                   ['URL' => $URL],
                   function($message){
                       $message->to('test@localhost')
                       ->subject('仮登録完了 - ツイノート');
                   });
        return View('send');
    }

    public function complete(Request $request){
        $token = $request->input('token');
        
        $new_twinote_user = NewTwinoteUser::where('token', $token)->first();
        if(!$new_twinote_user){
            return 'Error: Tokenが見つかりません。';
        }
        $email = $new_twinote_user->email;
        $password_hash = $new_twinote_user->password;

        $find_conflict = TwinoteUser::where('email', $email)->first();
        if($find_conflict){
            return 'Error: このメールアドレスは既に登録されています。';
        }

        $new_token = bin2hex(openssl_random_pseudo_bytes(32));

        $twinote_user = TwinoteUser::create([
            'email' => $email,
            'password' => $password_hash,
            'token' => $new_token
        ]);
        $new_twinote_user->delete();

        return View('complete');
    }

    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        $twinote_user = TwinoteUser::where('email', $email)->first();
        if(password_verify($password, $twinote_user->password)){
            $request->session()->put('email', $twinote_user->email);
            return redirect('/twinote_user');
        }else{
            return View('login')->with('error', 'メールアドレス又はパスワードが違います。');
        }
    }

    public function mypage(Request $request){
        if(!$request->session()->exists('email')){
            return redirect('/twinote_user/login');
        }

        $email = $request->session()->get('email');
        $twinote_user = TwinoteUser::where('email', $email)->first();
        if(!$twinote_user){
            return 'Error: ユーザーが見つかりません。';
        }
        return View('mypage')->with('token', $twinote_user->token);
    }
}
