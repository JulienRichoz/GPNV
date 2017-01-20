<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\StudentClass;
use App\Models\User;
use DB;

class AdminController extends Controller
{
  // Return the view admin
  function show()
  {
      return view('admin');
  }

  function test()
  {
    function GetXML($BaseUrl, $AlterStudents=false){
      $requestString = "api_key".env('CPNV_KEY');
      if($AlterStudents){
        $requestString = "alter[extra]students".$requestString;
      }

      $secret = env('CPNV_SECRET');
      $signature = md5($requestString.$secret);
      $URL = "api_key=".env('CPNV_KEY')."&signature=".$signature;
      if($AlterStudents){
        $URL = $BaseUrl."&api_key=".env('CPNV_KEY')."&signature=".$signature;
      }
      else{
        $URL = $BaseUrl."?api_key=".env('CPNV_KEY')."&signature=".$signature;
      }

      $ch = curl_init($URL);
      curl_setopt($ch, CURLOPT_URL, $URL);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $xml = simplexml_load_string(curl_exec ($ch));
      curl_close($ch);

      return $xml;
    }

    $MainXML = GetXML("http://intranet.cpnv.ch/info/classes.xml?alter[extra]=students",true);

    $NewClasses = [];
    $UpdateClasses = [];
    $NewTeachers = [];
    $UpdateTeachers = [];
    $NewStudents = [];
    $UpdateStudents = [];

    $UsersID = [];

    foreach ($MainXML as $C) {
      #echo $C->Id.' -- '.$C->Name.' -- '.$C->FriendlyId.'<br/>';

      //Get Class and Save it
      $Class = new StudentClass(
        $C->Id,
        $C->FriendlyId,
        $C->Name);

      try{
        if(!StudentClass::find($Class->id)){
          $Class->save();
          #echo "Class save in db<br/>";
        }
      }
      catch (Exception $e) {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
      }

      //Get teacher and Save it
      $IDTeacher = $C->Master->Link->Id;
      $TeacherSML = GetXML("http://intranet.cpnv.ch/teachers/".$IDTeacher.".xml");

      if(User::find($TeacherSML->Id)){
        $Teacher = User::find($TeacherSML->Id);
        $Update=True;
      }
      else{
        $Teacher = new User();
        $Update=False;
      }

      $Teacher->id=(string)$TeacherSML->Id;
      $Teacher->firstname=(string)$TeacherSML->Firstname;
      $Teacher->lastname=(string)$TeacherSML->Lastname;
      $Teacher->mail=(string)$TeacherSML->CorporateEmail;
      $Teacher->role_id=2;
      $Teacher->class_id=$Class->id;
      $Teacher->state_id=1;
      $Teacher->friendlyid=(string)$TeacherSML->FriendlyId;

      array_push($UsersID, $TeacherSML->Id);

      try{
        if(User::find($TeacherSML->Id)!=$Teacher){
          $Teacher->save();
          if($Update){
            array_push($UpdateTeachers, $Teacher);
          }
          else{
            array_push($NewTeachers, $Teacher);
          }
          #echo "Teacher ".$Teacher->friendlyid." save in db<br/>";
        }
      }
      catch (Exception $e) {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
      }

      foreach ($C->Students->Student as $S) {
        $StudentXML = GetXML("http://intranet.cpnv.ch/students/".$S->Link->Id.".xml");

        if(User::find($StudentXML->Id)){
          $Student = User::find($StudentXML->Id);
          $Update=True;
        }
        else{
          $Student = new User();
          $Update=False;
        }

        $Student->id=$StudentXML->Id;
        $Student->firstname=$StudentXML->Firstname;
        $Student->lastname=$StudentXML->Lastname;
        $Student->mail=$StudentXML->CorporateEmail;
        $Student->role_id="1";
        $Student->class_id=$Class->id;
        $Student->state_id="1";
        $Student->friendlyid=$StudentXML->FriendlyId;

        array_push($UsersID, $StudentXML->Id);

        try{
          if(User::find($StudentXML->Id)!=$Student){
            $Student->save();
            if($Update){
              array_push($UpdateStudents, $Student);
            }
            else{
              array_push($NewStudents, $Student);
            }
          }
        }
        catch (Exception $e) {
          echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
      }
    }

    $DisabledUsers = [];

    $Users = User::all();
    foreach($Users as $User) {
      if(!in_array($User->id, $UsersID) && $User->state_id!=2){
        $User->state_id=2;
        $User->save();
        array_push($DisabledUsers, $User);
      }
    }
    /*
    echo "New Teachers: ".count($NewTeachers)."</br>";
    echo "Update Teachers: ".count($UpdateTeachers)."</br>";
    echo "New Students: ".count($NewStudents)."</br>";
    echo "Update Students: ".count($UpdateStudents)."</br>";

    echo count($UsersID);
    */

    return view('admin')->with(['NewTeachers' => $NewTeachers,
      'NewStudents' => $NewStudents,
      'UpdateTeachers' => $UpdateTeachers,
      'UpdateStudents' => $UpdateStudents,
      'DisabledUsers' => $DisabledUsers
    ]);
  }
}