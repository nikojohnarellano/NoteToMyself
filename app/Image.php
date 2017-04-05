<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'user_id', 'image'
  ];

  public function user()
  {
      $this->belongsTo(User::class);
  }
}
