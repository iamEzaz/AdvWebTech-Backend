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

                if ( $result->type == "doctor" ) {

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
                // else if ( $type == "receptionist" ) {
                //     // $req->session()->put( 'uname', $username );
                //     // $req->session()->put( 'type', $type );
                //     // $req->session()->put( 'password', $req->password );
                //     // $req->session()->put( 'id', $id );

                //     return redirect( '/reception/dashboard' );

                //     //admin
                // }
                // else if ( $type == "admin" ) {
                //     $req->session()->put( 'uname', $username );
                //     $req->session()->put( 'type', $type );
                //     $req->session()->put( 'password', $req->password );
                //     $req->session()->put( 'id', $id );
                //     $req->session()->put( 'image', $image );

                //     return redirect()->route( 'admin.dashboard' );
                // }



        }
        else {
            return response()->json([
                'status' => 'Not Found',
                'message' => 'User Not  Found',
            ]);
        }
    }
}
