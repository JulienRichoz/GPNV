<?php
namespace App\Models\CheckList

use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class Step extends Model
{
  protected $table = 'checkList_Items';

  public function checkList()
  {
    return $this->belongsTo('App\Models\CheckList\CheckList', 'checkList_id');
  }
}

?>
