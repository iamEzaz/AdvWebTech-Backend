<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Users;


class LoginController extends Controller {
    public function index() {
        return view( 'login' );
    }

    public function verify( Request $req )
     {
        $result = Users::where('email', $req->email)
        ->where('password', $req->password)->first();

        if ( $result  )
        {

                if ( $result->type == "admin" ) {

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Login Successfully',
                        'id' => $result->id,
                        'name' => $result->name,
                        'email' => $result->email,
                        'type' => $result->type,
                        'username' => $result->username,


                    ]);
                }
                else if ( $result->type == "doctor" ) {

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Login Successfully',
                        'id' => $result->id,
                        'name' => $result->name,
                        'email' => $result->email,
                        'type' => $result->type,
                        'username' => $result->username,
                        'dcid' => $result->dcid,


                    ]);
                }
                else {
                    return response()->json([
                        'status' => 'Not Found',
                        'message' => 'User Not  Found',
                    ]);

                }


        }
        else {
            return response()->json([
                'status' => 'Not Found',
                'message' => 'User Not  Found',
            ]);
        }
    }
}
