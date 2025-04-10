<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'description',
    'status',
    'published_at',
    'user_id',
  ];

  protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
    'scheduled_at' => 'datetime',
    'published_at' => 'datetime'
  ];

  public function user()
  {
      return $this->belongsTo(User::class, 'user_id');
  }

}