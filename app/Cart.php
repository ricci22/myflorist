<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  // Table Name
  protected $table = 'carts';

  // Primary Key
  public $primaryKey = 'id';

  // Timestamp
  public $timestamps = true;

  // Relationship
  public function courier(){
    return $this->belongsTo('App\Courier', 'courier_id','id');
  }
  public function user(){
    return $this->belongsTo('App\User', 'user_id','id');
  }
  public function cartDetails(){
    return $this->hasMany('App\CartDetail');
  }
}
