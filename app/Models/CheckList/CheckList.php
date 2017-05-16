<?php
namespace App\Models\CheckList

use App\Models\STI

/**
 *
 */
class CheckList extends STI
{
  protected $table = 'checkLists';
  protected $stiClassField = 'checkList_type';

  public function steps()
  {
    return $this->hasMany('App\Models\CheckList\Step', 'checkList_id');
  }
}

?>
