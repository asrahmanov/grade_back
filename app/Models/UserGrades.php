<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGrades extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'grade_parent_id',
      'status',
        'grade_id'
    ];

    public static function get($id)
    {
        return UserGrades::query()->where('user_id', $id)->join('grades' , 'user_grades.grade_parent_id' , '=' , 'grades.id')->where('grades.is_hidden', 0)->get(['grade_id' , 'grade_parent_id', 'title']);
    }


    public static function create($user_id , $grade_id)
    {
        return UserGrades::query()->create(['user_id' => $user_id , 'grade_parent_id' => $grade_id]);
    }

    public static function updateStatus($user_id, $grade_id, $status)
    {
        return UserGrades::query()->where(['user_id' => $user_id , 'grade_id' => $grade_id])->update(['status' => $status]);
    }
}
