<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flower extends Model
{
  // Table Name
  protected $table = 'flowers';

  // Primary Key
  public $primaryKey = 'id';

  // Timestamp
  public $timestamps = true;

  // Relationship
  public function flowerType(){
    return $this->belongsTo('App\FlowerType', 'flowerTypes_id','id');
  }
  public function cartDetail(){
    return $this->hasOne('App\CartDetail');
  }
  public function transactionDetails() {
    return $this->hasMany('App\TransactionDetails');
  }
}
