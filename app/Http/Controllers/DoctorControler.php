<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorControler extends Controller
{
    //Docotoprofile
    public function Doctoprofile(Request $req)
    {
        $user = Users::where('id', $req->id)->first();
        if ($user) {
            return response()->json($user, 200);
        }
    }
    //update doctor profile

    public function Updatedoctorprfile(Request $req)
    {
        $doctor = Users::where('id', $req->id)->first();
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


            $doctor->name = $req->name;

            $doctor->email = $req->email;



            $doctor->update();

            if ($doctor->update()) {


                return response()->json([
                    'success' => 'doctor  update Successful.!',
                ]);
            } else {
                return response()->json([
                    'failed' => 'profile update failed!',
                ]);
            }
        }
    }

    //appointments
    public function Appointment(Request $req)

    {
        //return Appointment::all();
        $user = Appointment::where('dcid', $req->id)->get();
        if ($user) {
            return response()->json($user, 200);
        }
    }
    //dlrappointments
    public function DeleteAppointment(Request $req)

    {

        $result = Appointment::where('id', $req->id)->first();

         if ($result->delete()) {
             return response()->json(["success" => "  Delete Succesfull"], 200);
         } else {
             return response()->json(["msg" => "notfound"], 404);
         }
    }
    //update status
    public function Updateaptstatus(Request $req)
    {
        $apt = Appointment::where('id', $req->id)->first();


        $apt->status = 'done';

        $apt->update();

            if ($apt->update()) {
              return response()->json([
                    'success' => 'Status  update Successful.!',
                ]);
            } else {
                return response()->json([
                    'failed' => 'Status  update failed!',
                ]);
            }
        }
//al patient
public function Allpatient()
{
    $result = Users::where('type', 'patient')->get();

    if ($result) {
        return response()->json($result, 200);
    }
}




    }

