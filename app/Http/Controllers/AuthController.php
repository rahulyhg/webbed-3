<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Log;
use Validator;
use Exception;
use Redirect;
use Session;
use Sangria\IMAPAuth;
use Sangria\JSONResponse;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request) {
        try {
            $validator = Validator::make($request->all(),[
                'roll_no'  => 'required|digits:9',
                'password' => 'required'
            ]);

            //check for valid parameters
            if($validator->fails()) {
                $response = "Invalid params"; //$validator->errors()->all();
                return JSONResponse::response(400, $response);
            }

            $roll_no  = $request->input('roll_no');
            $username = $roll_no."@nitt.edu";

            $password = $request->input('password');
            
            if(IMAPAuth::tauth($roll_no,$password)) {
            //if(true) {
                Log::info($roll_no." has logged in");
                Session::put([
                    'roll_no' => $roll_no,
                ]);

                return JSONResponse::response(200);
            } else {
                Log::info($roll_no." has attempted to login and failed");
                return JSONResponse::response(401);
            }
        } catch (Exception $e) {
            $status_code = 500;
            $response = $e->getMessage()." ".$e->getLine();
            Log::error($response);        
            return JSONResponse::response($status_code,$response);
        }
    }
}
