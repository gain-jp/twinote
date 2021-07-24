<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TwinoteUser;
use App\Models\Name;

class NameController extends Controller
{
    public function edit(Request $request){
        $token = $request->header('token');
        $twitter_id = $request->route('twitter_id');
        $name = $request->input('name');
        $change_twitter_id = $request->route('change_twitter_id');

        $twinote_user = TwinoteUser::where('token', $token)->first();
        if(!$twinote_user){
            return response()->json(['error' => '1', 'message' => 'このトークンを持つユーザーが存在しません。']);
        }
        $twinote_id = $twinote_user->id;
        $user = User::where('twinote_id', $twinote_id)->where('twitter_id', $twitter_id)->first();
        if(!$user){
            $user = User::create([
                'twinote_id' => $twinote_id,
                'twitter_id' => $twitter_id
            ]);
        }
        $old_memo = Name::where('user_id', $user->id)->first();
        if($old_memo){
            $memo = Name::where('user_id', $user->id)->first()
            ->where('change_twitter_id', $change_twitter_id)
            ->update(['name' => $name]);
        }else{
            $memo = Name::create([
                'user_id' => $user->id,
                'name' => $name,
                'change_twitter_id' => $change_twitter_id
            ]);
        }
        
        return response()->json(['error' => '0']);
    }

    public function get(Request $request){
        $token = $request->header('token');
        $twitter_id = $request->route('twitter_id');
        $change_twitter_id = $request->route('change_twitter_id');

        $twinote_user = TwinoteUser::where('token', $token)->first();
        if(!$twinote_user){
            return response()->json(['error' => '1', 'message' => 'このトークンを持つユーザーが存在しません。']);
        }
        $twinote_id = $twinote_user->id;
        $user = User::where('twinote_id', $twinote_id)->where('twitter_id', $twitter_id)->first();
        if(!$user){
            $user = User::create([
                'twinote_id' => $twinote_id,
                'twitter_id' => $twitter_id
            ]);
        }
        $name = Name::where('user_id', $user->id)->where('change_twitter_id', $change_twitter_id)->first();
        if($name){
            return response()->json(['error' => 0, 'name' => $name->name]);
        }else{
            return response()->json(['error' => 0, 'name' => '']);
        }
    }
}
