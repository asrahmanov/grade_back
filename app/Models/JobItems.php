<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobItems extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'job_parent_id'
    ];
}
