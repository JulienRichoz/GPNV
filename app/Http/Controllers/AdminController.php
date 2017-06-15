<?php

/*
  Use to manage the admin page of the site.
  Get user from intranet.cpnv.ch
*/

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

  /**
   * Synchronise intranet.cpnv.ch and gpnv
   * @return view admin
   */
  function synchro()
  {

    /**
     * Use to get xml from intranet.cpnv.ch
     *
     * @param $BaseUrl The xml url
     * @param $AlterStudents use to know if we want student from BaseUrl
     * @return xml return as array
     */
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

    // Use to get all the users and their categories
    $NewClasses = [];
    $UpdateClasses = [];
    $NewTeachers = [];
    $UpdateTeachers = [];
    $NewStudents = [];
    $UpdateStudents = [];
    $UsersID = [];

    // Get teacher
    $TeacherXML = GetXML("http://intranet.cpnv.ch/info/teachers.xml");

    foreach ($TeacherXML as $TeacherXML) {
      //Get teacher and Save it
      $IDTeacher = $TeacherXML->Id;

      if(User::find($TeacherXML->Id)){
        $Teacher = User::find($TeacherXML->Id);
        $Update=True;
      }
      else{
        $Teacher = new User();
        $Update=False;
      }

      $Teacher->id=(string)$TeacherXML->Id;
      $Teacher->firstname=(string)$TeacherXML->Firstname;
      $Teacher->lastname=(string)$TeacherXML->Lastname;
      $Teacher->mail=(string)$TeacherXML->CorporateEmail;
      $Teacher->role_id=2;
      $Teacher->class_id=1;
      $Teacher->state_id=1;
      $Teacher->friendlyid=(string)$TeacherXML->FriendlyId;

      array_push($UsersID, $TeacherXML->Id);

      try{
        if(User::find($TeacherXML->Id)!=$Teacher){
          $Teacher->save();
          if($Update){
            array_push($UpdateTeachers, $Teacher);
          }
          else{
            array_push($NewTeachers, $Teacher);
          }

        }
      }
      catch (Exception $e) {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
      }

    }

    // Get class and student by class
    // Get all classes from info section
    $MainXML = GetXML("http://intranet.cpnv.ch/info/classes.xml?alter[extra]=students",true);

    foreach ($MainXML as $C) {
      //Get Class and Save it
      $Class = new StudentClass(
        $C->Id,
        $C->FriendlyId,
        $C->Name);

      try{
        if(!StudentClass::find($Class->id)){
          $Class->save();
        }
      }
      catch (Exception $e) {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
      }

      // Get all the students from the classes
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

    // Save user to db if not exist or has benn edited
    $Users = User::all();
    foreach($Users as $User) {
      if(!in_array($User->id, $UsersID) && $User->state_id!=2){
        $User->state_id=2;
        $User->save();
        array_push($DisabledUsers, $User);
      }
    }

    // indicate if update was done
    if(count($NewStudents)==0 && count($UpdateTeachers)==0 && count($UpdateStudents)==0 && count($DisabledUsers)==0){
      $Update = false;
    }
    else{
      $Update = true;
    }

    return view('admin')->with(['NewTeachers' => $NewTeachers,
      'NewStudents'    => $NewStudents,
      'UpdateTeachers' => $UpdateTeachers,
      'UpdateStudents' => $UpdateStudents,
      'DisabledUsers'  => $DisabledUsers,
      'Update'         => $Update
    ]);
  }
}
