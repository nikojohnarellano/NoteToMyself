<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'user_id', 'website'
  ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
