<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
  protected $table = 'classes';
  protected $fillable = ['id', 'name', 'friendlyId'];

  function __construct($ID=null, $FriendlyID=null, $Name=null) {
    $this->id = $ID;
    $this->friendlyId = $FriendlyID;
    $this->name = $Name;
  }

  public function getName(){
      return $this->name;
  }

}
