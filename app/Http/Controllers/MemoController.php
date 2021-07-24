<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TwinoteUser;
use App\Models\Memo;

class MemoController extends Controller
{
    public function edit(Request $request){
        $token = $request->header('token');
        $twitter_id = $request->route('twitter_id');
        $memo = $request->input('memo');

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
        $old_memo = Memo::where('user_id', $user->id)->first();
        if($old_memo){
            $memo = Memo::where('user_id', $user->id)->first()
            ->update([
                'memo' => $memo
            ]);
        }else{
            $memo = Memo::create([
                'user_id' => $user->id,
                'memo' => $memo
            ]);
        }
        
        return response()->json(['error' => '0']);
    }

    public function get(Request $request){
        $token = $request->header('token');
        $twitter_id = $request->route('twitter_id');

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
        $memo = Memo::where('user_id', $user->id)->first();
        if($memo){
            return response()->json(['error' => 0, 'memo' => $memo->memo]);
        }else{
            return response()->json(['error' => 0, 'memo' => '']);
        }
    }
}
