<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\UpdateSalaryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserControllerByAdmin extends Controller {
    //render add user page
    public function index() {
        return view( 'admin.addUsers' );
    }

    public function dashboard() {
        $doctors = DB::table( 'users' )->where( 'type', 'doctor' )->get();
        $patients = DB::table( 'users' )->where( 'type', 'patient' )->get();
        $receptionists = DB::table( 'users' )->where( 'type', 'receptionist' )->get();

        $doctor = 0;
        $patient = 0;
        $receptionist = 0;

        //doctor
        foreach ( $doctors as $num ) {
            $doctor += 1;
        }

        //patient
        foreach ( $patients as $num ) {
            $patient += 1;
        }

        //receptionist
        foreach ( $receptionists as $num ) {
            $receptionist += 1;
        }

        return [
            'doctor'       => $doctor,
            'patient'      => $patient,
            'receptionist' => $receptionist,
        ];
    }

    public function login( Request $req ) {
        $result = DB::table( 'users' )
            ->where( 'email', $req->email )
            ->where( 'password', $req->password )
            ->get();

        foreach ( $result as $res ) {
            $username = $res->username;
            $type = $res->type;
            $id = $res->id;
            $active = $res->active;
            $image = $res->image;
            $password= $res->password;
            $email= $res->email;
        }

        if ( count( $result ) > 0 ) {
            if ( $active == 1 ) {
                if ( $type == "doctor" ) {
                    return [
                        'username'=>$username,
                        "id"=>$id,
                        "active"=>$active,
                        "password"=>$password,
                        "type"=>$type,
                        "email"=>$email
                    ];
                } else if ( $type == "receptionist" ) {
                    return [
                        'username'=>$username,
                        "id"=>$id,
                        "active"=>$active,
                        "password"=>$password,
                        "type"=>$type,
                        "email"=>$email
                    ];

                    //admin
                } else if ( $type == "admin" ) {
                    return [
                        'username'=>$username,
                        "id"=>$id,
                        "active"=>$active,
                        "password"=>$password,
                        "type"=>$type,
                        "email"=>$email
                    ];

                } else {
                    
                }
            }else{
                return ['invalid'=>"Your account is blocked .Please contact to Admin"];
            }
        }else{
            return ['invalid'=>"invalid email or password"];
        }

    }

    public function list() {
        $users = DB::table( 'users' )->get();
        return $users;
    }
    // view user details
    public function userDetails( $id ) {
        $user = DB::table( 'users' )->where( 'id', $id )->get();
        return $user;
    }

    public function add( AddUserRequest $req ) {
        DB::table( 'users' )->insert( [
            'name'       => '',
            'username'   => $req->username,
            'email'      => $req->email,
            'password'   => $req->password,
            'type'       => $req->type,
            'bloodGroup' => "",
            'phone'      => $req->phone,
            'address'    => "",
            'image'      => "",
            'active'     => '1',
            'salary'     => '',
            'workShift'  => '',
        ] );
        $users = DB::table( 'users' )->get();
        return $users;
    }

    public function edit( EditUserRequest $req, $id ) {
        DB::table( 'users' )
            ->where( 'id', $id )
            ->update( [
                'username' => $req->username,
                'email'    => $req->email,
                'phone'    => $req->phone,
                'active'   => $req->active,
            ] );
        $users = DB::table( 'users' )->get();
        return $users;
    }

    public function delete( $id ) {
        $result = DB::table( 'users' )->where( 'id', $id )->delete();
        $users = DB::table( 'users' )->get();
        return $users;
    }

    //transaction
    public function transaction() {
        $transactions = DB::table( 'transaction' )->get();
        return $transactions;
    }

    //doctor Review
    public function doctor() {
        $doctors = DB::table( 'doctor_review' )->get();
        return $doctors;
    }

    //user report
    public function report( Request $req ) {
        $reports = DB::table( 'report' )->get();
        return $reports;
    }

    // update user report
    public function editReport( Request $req, $id ) {
        DB::table( 'report' )
            ->where( 'id', $id )
            ->update( [
                'status' => $req->status,
            ] );
        $reports = DB::table( 'report' )->get();
        return $reports;
    }

    // change password 

    public function password(Request $req,$id){
        $result = DB::table( 'users' )
        ->where( 'id', $id )
        ->update( [
            'password' => $req->newPassword,
        ] );

        
    }

    //workSchedul
    public function schedule() {
        $result = DB::table( 'users' )->get();
        $schedules = [];

        foreach ( $result as $user ) {
            if ( $user->type == 'doctor' || $user->type == 'receptionist' ) {
                array_push( $schedules, $user );
            }
        }

        return $schedules;
    }

    public function editWorkSchedule( Request $req, $id ) {
        DB::table( 'users' )
            ->where( 'id', $id )
            ->update( [
                'workshift' => $req->workShift,
            ] );
        $result = DB::table( 'users' )->get();
        $schedules = [];

        foreach ( $result as $user ) {
            if ( $user->type == 'doctor' || $user->type == 'receptionist' ) {
                array_push( $schedules, $user );
            }
        }

        return $schedules;
    }

    // manage salary
    public function salary() {
        $result = DB::table( 'users' )->get();
        $users = [];

        foreach ( $result as $user ) {
            if ( $user->type == 'doctor' || $user->type == 'receptionist' ) {
                array_push( $users, $user );
            }
        }
        return $users;
    }

    //per user salary
    public function perSalary( $id ) {
        $user = DB::table( 'users' )->where( 'id', $id )->get();
        return $user;
    }

    // block user
    public function block1( $id ) {
        DB::table( 'users' )
            ->where( 'id', $id )
            ->update( [
                'active' => '0',
            ] );
        $users = DB::table( 'users' )->get();
        return $users;
    }

    public function editSalary( Request $req, $id ) {
        DB::table( 'users' )
            ->where( 'id', $id )
            ->update( [
                'salary' => $req->updateSalary,
            ] );
        
            $result = DB::table( 'users' )->get();
            $users = [];
    
            foreach ( $result as $user ) {
                if ( $user->type == 'doctor' || $user->type == 'receptionist' ) {
                    array_push( $users, $user );
                }
            }
            return $users;

    }

    //add user
    public function addUser( AddUserRequest $req ) {

        if ( $req->type == 'patient' ) {
            DB::table( 'users' )->insert( [
                'name'       => '',
                'username'   => $req->username,
                'email'      => $req->email,
                'password'   => $req->password,
                'type'       => $req->type,
                'bloodGroup' => "",
                'phone'      => "",
                'address'    => "",
                'image'      => "",
                'active'     => '1',
                'salary'     => '',
                'workShift'  => '',
            ] );
        } else {

            DB::table( 'users' )->insert( [
                'name'       => '',
                'username'   => $req->username,
                'email'      => $req->email,
                'password'   => $req->password,
                'type'       => $req->type,
                'bloodGroup' => "",
                'phone'      => "",
                'address'    => "",
                'image'      => "",
                'active'     => '1',
                'salary'     => $req->salary,
                'workShift'  => '',
            ] );
        }

        $req->session()->flash( 'msg', 'User added successfully' );
        return \redirect()->route( 'user.viewUserList' );
        // echo $req->type;
    }

    public function viewUserList() {
        $users = DB::table( 'users' )->get();
        return view( 'admin.viewUserList' )->with( 'userlist', $users );
        // return $user;
    }

    public function liveSearch( Request $request ) {
        //ajax method
        if ( $request->ajax() ) {

            // if serach input null than hide the table
            if ( $request->search == '' ) {
                $output = "";
            } else {

                $data = DB::table( 'users' )->where( 'username', 'LIKE', '%' . $request->search . '%' )
                    ->get();

                $output = '';

                if ( count( $data ) > 0 ) {

                    $output = "<table border=1 class='table' style='background:#fff;max-width:700px;margin-left:60px'>
                                <tr>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Type</th>
                            </tr>";

                    foreach ( $data as $row ) {

                        $output .= "
                            <tr>
                                <td>{$row->name}</td>
                                <td>{$row->username}</td>
                                <td>{$row->email}</td>
                                <td>{$row->type}</td>
                            </tr>";
                    }

                    $output .= '</table>';
                } else {

                    $output .= '<li class="list-group-item">' . 'No results Found' . '</li>';
                }
            }
            return $output;
        }

    }

    public function doctorReview() {
        $doctors = DB::table( 'doctor_review' )->get();
        return view( 'admin.viewDoctorReview' )->with( 'doctors', $doctors );
    }
    public function transactionHistory() {
        $transactions = DB::table( 'transaction' )->get();
        return view( 'admin.userTransactionHistory' )->with( "transactionlist", $transactions );
    }
    public function userReport( Request $req ) {
        $reports = DB::table( 'report' )->get();
        return \view( 'admin.userReport' )->with( 'reportlist', $reports );
    }

    public function userReportStatus( Request $req, $id ) {
        DB::table( 'report' )
            ->where( 'id', $id )
            ->update( [
                'status' => $req->status,
            ] );
        $req->session()->flash( 'msg', 'Report status update successfully' );
        return redirect()->route( 'user.userReport' );
        // echo $req->problem;
        // dd($req->status);
    }
    public function editUserView( $id ) {
        $user = DB::table( 'users' )->find( $id );
        return \view( 'admin.editUser' )->with( 'user', $user );
    }

    public function editUser( EditUserRequest $req, $id ) {
        DB::table( 'users' )
            ->where( 'id', $id )
            ->update( [
                'username' => $req->username,
                'email'    => $req->email,
                'phone'    => $req->phone,
                'active'   => $req->active,
            ] );

        $req->session()->flash( 'msg', 'User update successfully' );
        return \redirect()->route( 'user.viewUserList' );
    }
    public function deleteUser( Request $req, $id ) {
        // if($req->ajax()){

        DB::table( 'users' )
            ->where( 'id', $id )
            ->delete();
        // }
        $req->session()->flash( 'msg', 'User deleted successfully' );
        return \redirect()->route( 'user.viewUserList' );
    }
    public function blockUser( Request $req, $id ) {
        DB::table( 'users' )
            ->where( 'id', $id )
            ->update( [
                'active' => '0',
            ] );
        $req->session()->flash( 'msg', 'User blocked successfully' );
        return \redirect()->route( 'user.viewUserList' );
    }

    public function viewUserDetails( $id ) {
        $user = DB::table( 'users' )->find( $id );
        return view( 'admin.viewUserDetails' )->with( 'user', $user );
    }

    public function manageSalaryIndex() {
        $result = DB::table( 'users' )->get();
        $users = [];

        foreach ( $result as $user ) {
            if ( $user->type == 'doctor' || $user->type == 'receptionist' ) {
                array_push( $users, $user );
            }
        }
        return view( 'admin.manageSalary' )->with( 'users', $users );
    }

    //update salary show page
    public function updateSalaryIndex( $id ) {
        $user = DB::table( 'users' )->find( $id );
        return view( 'admin.updateSalary' )->with( 'user', $user );
    }

    public function updateSalaryVerify( UpdateSalaryRequest $req, $id ) {
        DB::table( 'users' )
            ->where( 'id', $id )
            ->update( [
                'salary' => $req->updateSalary,
            ] );

        $req->session()->flash( 'msg', 'salary updated successfully' );
        return redirect()->route( 'user.manageSalaryIndex' );
    }

    public function workSchedulIndex() {
        $result = DB::table( 'users' )->get();
        $users = [];

        foreach ( $result as $user ) {
            if ( $user->type == 'doctor' || $user->type == 'receptionist' ) {
                array_push( $users, $user );
            }
        }

        return view( 'admin.workSechedul' )->with( 'users', $users );
    }

    public function workSchedul( Request $req, $id ) {
        DB::table( 'users' )
            ->where( 'id', $id )
            ->update( [
                'workshift' => $req->workShift,
            ] );
        $req->session()->flash( 'msg', 'work status updated' );
        return redirect()->route( 'user.workSchedulIndex' );
    }

}
