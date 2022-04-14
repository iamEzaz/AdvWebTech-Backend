<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\BookingRoomRequest;
class RoomController extends Controller
{
    //room room 
    public function room(){
        $rooms = DB::table('room')->where('status','avaible')->get();
        return $rooms;
    }

    //per room
    public function perRoom ($id){
        $user = DB::table( 'room' )->where( 'id', $id )->get();
        return $user;
    }

    // booking api 
    public function booking(Request $req,$id){
        $book =  DB::table('booking_table')->insert([
            'roomNo'=>$req->roomNo,
            'phone'=>$req->phone,
            'type'=>$req->type,
            'price'=>$req->price,
            'name'=>$req->patientName,
        ]);

         if($book){
            $result =  DB::table('room')->where('roomNo',$req->roomNo)->update([
                'status'=>'booked'
            ]);
         }
        return $result;
     }

    public function roomView(){
        $rooms = DB::table('room')->where('status','avaible')->get();
        return \view('admin.roomCheck')->with("rooms",$rooms);
    }

    public function roomBookView($id){
        $room = DB::table('room')->find($id);
        return view('admin.bookingRoom')->with('room',$room);
    }

    public function roomBookVerify(BookingRoomRequest $req,$id){
       $result =  DB::table('booking_table')->insert([
            'roomNo'=>$req->roomNo,
            'phone'=>$req->phone,
            'type'=>$req->type,
            'price'=>$req->price,
            'name'=>$req->patientName,
        ]);

        if($result == true){
            DB::table('room')->where('roomNo',$req->roomNo)->update([
                'status'=>'booked'
            ]);
            $req->session()->flash('msg','room booked successfully');
            return redirect()->route('room.roomView');
        }
    }
}
