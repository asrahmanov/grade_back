<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRegularJobs extends Model
{
    use HasFactory;

    protected $fillable = [
      'job_group_id',
        'job_item_id',
        'user_id'
    ];
}
