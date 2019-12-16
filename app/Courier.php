<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
  // Table Name
  protected $table = 'couriers';

  // Primary Key
  public $primaryKey = 'id';

  // Timestamp
  public $timestamps = true;

  // Relationship
  public function cart(){
    return $this->hasOne('App\Cart');
  }
  public function transaction(){
    return $this->hasMany('App\Transaction');
  }
}
