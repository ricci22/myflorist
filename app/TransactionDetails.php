<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetails extends Model
{
  // Table Name
  protected $table = 'transaction_details';

  // Primary Key
  public $primaryKey = 'id';

  // Timestamp
  public $timestamps = true;

  // Relationship
  public function transaction() {
    return $this->belongsTo('App\Transaction', 'transaction_id', 'id');
  }
  public function flower() {
    return $this->belongsTo('App\Flower', 'flower_id','id');
  }
}
