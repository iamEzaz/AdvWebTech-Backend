<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Models\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Mail\Mailer;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;

class adminController extends Controller
{



    //api
    //ALL doctor
    public function alldoctor(Request $req)
    {
        $result = Users::where('type', 'doctor')->get();

        if ($result) {
             return response()->json($result, 200);

        }
    }
    //ALL doctor
    public function Singledoctor(Request $req)
    {
        $result = Users::where('id', $req->id)->first();

        if ($result) {
            return response()->json($result, 200);
        }
    }
    //al patient
    public function allpatient(Request $req)
    {
        $result = Users::where('type', 'patient')->get();

        if ($result) {
            return response()->json($result, 200);
        }
    }
    //al appointment
    public function Allappointment(Request $req)
    {
        $result = Appointment::all();

        if ($result) {
            return response()->json($result, 200);
        }
    }
    //delet patient
    public function deletepatient(Request $req)
    {
        $result = Users::where('id', $req->id)->first();

        if ($result->delete()) {
            return response()->json(["success" => "  Delete Succesfull"], 200);
        } else {
            return response()->json(["msg" => "notfound"], 404);
        }
    }
    public function Adddoctor(Request $req)
    {

        $validator = Validator::make(
            $req->all(),

            [
                'name' => 'required|min:4|max:20',
                'username' => 'required|unique:users,username',
                'email' => 'required|email',
                'password' => 'required|min:6',
                'confirmpassword' => 'required|same:password',
                'department' => 'required',
                'dcid' => 'required|unique:users,dcid',

            ],
            [
                'username.unique' => 'Username must be   Unique',
                'confirmpassword.same' => 'password missmatched'

            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $doctor = new Users();
            $doctor->username = $req->username;
            $doctor->name = $req->name;
            $doctor->type = 'doctor';
            $doctor->email = $req->email;
            $doctor->dcid = $req->dcid;
            $doctor->department = $req->department;
            $doctor->password = $req->password;
            $doctor->save();

            if ($doctor->save()) {
 //Register Success Full Mail
            $sub= ` Succesfull`;
             $body= "Dear  $req->name Wecome to  Ehospital" ;
          Mail::to("$req->email")->send(new Mailer($sub,$body));

                return response()->json([
                    'success' => 'Doctor Add Successful.!',
                ]);
            }
        }
    }

    //add receptionist
    public function AddReciptionist(Request $req)
    {

        $validator = Validator::make(
            $req->all(),

            [
                'name' => 'required|min:4|max:20',
                'username' => 'required|unique:users,username',
                'email' => 'required|email',
                'password' => 'required|min:6',
                'confirmpassword' => 'required|same:password',

            ],
            [
                'username.unique' => 'Username must be   Unique',
                'confirmpassword.same' => 'password missmatched'

            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $receptionist = new Users();
            $receptionist->username = $req->username;
            $receptionist->name = $req->name;
            $receptionist->type = 'receptionist';
            $receptionist->email = $req->email;
            $receptionist->password = $req->password;
            $receptionist->save();

            if ($receptionist ->save()) {


                return response()->json([
                    'success' => 'receptionist  Add Successful.!',
                ]);
            }
        }
    }

  //ALL doctor
  public function allreceptionist(Request $req)
  {
      $result = Users::where('type', 'receptionist')->get();

      if ($result) {
           return response()->json($result, 200);

      }
  }
   //single receptionist
   public function Singlereceptionist(Request $req)
   {
       $result = Users::where('id', $req->id)->first();

       if ($result) {
           return response()->json($result, 200);
       }
   }




//update
    public function Updatedoctor(Request $req)
    {
        $doctor = Users::where('id', $req->id)->first();
        $validator = Validator::make(
            $req->all(),

            [
                'name' => 'required',

                'email' => 'required',
                 'department' => 'required',


            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $doctor->name = $req->name;

            $doctor->email = $req->email;

            $doctor->department = $req->department;

            $doctor->update();

            if ($doctor->update()) {


                return response()->json([
                    'success' => 'Doctor  update Successful.!',
                ]);
            }
        }
    }


    public function Updatereceptionst(Request $req)
    {
        $receptionst = Users::where('id', $req->id)->first();
        $validator = Validator::make(
            $req->all(),

            [
                'name' => 'required',

                'email' => 'required',

                ]
        );
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $receptionst->name = $req->name;

            $receptionst->email = $req->email;



            $receptionst->update();

            if ($receptionst->update()) {


                return response()->json([
                    'success' => 'Doctor  update Successful.!',
                ]);
            }
        }
    }
    //admin profilr
    public function adminprofile(Request $req)
    {
        $user = Users::where('id', $req->id)->first();
        if ($user) {
            return response()->json($user, 200);
        }
    }

    //adminprofile update
    public function Updateadminprfile(Request $req)
    {
        $admin = Users::where('id', $req->id)->first();
        $validator = Validator::make(
            $req->all(),

            [
                'name' => 'required',

                'email' => 'required',



            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {


            $admin->name = $req->name;

            $admin->email = $req->email;



            $admin->update();

            if ( $admin->update()) {


                return response()->json([
                    'success' => 'admin  update Successful.!',
                ]);
            }
            else{
                return response()->json([
                    'failed' => 'profile update failed!',
                ]);

            }
        }
    }
//branch check



}
