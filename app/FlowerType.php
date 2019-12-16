<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlowerType extends Model
{
  // Table Name
  protected $table = 'flowerTypes';

  // Primary Key
  public $primaryKey = 'id';

  // Timestamp
  public $timestamps = true;

  // Relationship
  public function flowers(){
    return $this->hasMany('App\Flower');
  }
}
