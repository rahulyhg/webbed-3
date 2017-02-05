<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Chats;
use Log;
use Validator;
use Exception;
use Redirect;
use Session;
use Sangria\IMAPAuth;
use Sangria\JSONResponse;

class ChatController extends Controller
{
    public function storeChats(Request $request) {
        try {
            $validator = Validator::make($request->all(),[
                'from_roll'  => 'required|digits:9',
                'to_roll'  => 'required|digits:9',
                'msg' => 'required'
            ]);

            //check for valid parameters
            if($validator->fails()) {
                $response = "Invalid params"; //$validator->errors()->all();
                return JSONResponse::response(400, $response);
            }

            $from_roll  = $request->input('from_roll');
            $to_roll  = $request->input('to_roll');
            $message = $request->input('msg');

            $chat = new Chats();
            $chat->fromId = $from_roll;
            $chat->toId = $to_roll;
            $chat->message = $message;

            $chat->save();
            return JSONResponse::response(200);

        } catch (Exception $e) {
            return JSONResponse::response(500, $e->getMessage(). " ". $e->getLine());
        }
    }
}
