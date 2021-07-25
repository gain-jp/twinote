<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AIController extends Controller
{
    public function get(Request $request){
        $text = $request->input('text');
        $json = json_encode(['text' => $text]);
        $output = $this->communication($json);
        $output_json = json_encode(['text' => $output]);
        return $output_json;
    }

    public function communication($json){
        $fp = stream_socket_client("tcp://".config('app.ai_address').":".config('app.ai_port'), $errno, $errstr, 5);
        if (!$fp) {
            return ['error' => 1, 'message' => $errstr.','.$errno];
        } else {
            $buff = '';
            fwrite($fp, $json);
            while (!feof($fp)) {
                $buff = $buff.fgets($fp, 1024);
            }
            fclose($fp);
            return $buff;
        }
    }
}
