<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function send(Request $req)
    {
        /**
         * ['user_id' => $user_id, 'message' => $message] = $req->all(['user_id', 'message]);
         *
         * OR
         *
         * $user_id = $req->post('user_id');
         * $message = $req->post('message');
         *
         * AND THEN
         *
         * $status = (new Message(['user_id' => $user_id, 'message' => $message])->save();
         *
         * OR
         *
         * $message = new Message();
         * $message->user_id = $user_id;
         * $message->message = $message
         * $status = $message->save();
         */
        $status = (new Message($req->all(['user_id', 'message'])))->save();

        if ($status) {
            return json_encode(['status' => 'success']);
        }

        return json_decode(['status' => 'failure']);
    }
}
