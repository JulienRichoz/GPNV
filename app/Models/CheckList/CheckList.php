<?php
namespace App\Models\CheckList

use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class CheckList extends Model
{
  protected $table = 'checkLists';

  protected $stiField = 'checkList_type';

  public function steps()
  {
    return $this->hasMany('App\Models\CheckList\Step', 'checkList_id');
  }
}

?>
