<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GradeItems extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'grade_parent_id'
    ];

    public static function get($key): Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
        return GradeItems::query()->where('is_hidden', 0)->find($key);
    }

    public static function create($title , $id): Model|\Illuminate\Database\Eloquent\Builder
    {
        return GradeItems::query()->create(['title' => $title , 'grade_parent_id' => $id]);
    }

    public static function updateGrade(Request $request): int
    {
        return GradeItems::query()->where('id' , $request->id)->update($request->all());
    }

    public static function deleteGrade(Request $request): int
    {
        return GradeItems::query()->where('id', $request->id)->delete();
    }

    public static  function getListItems($id): \Illuminate\Database\Eloquent\Collection|array
    {
        return GradeItems::query()->where('grade_parent_id' , $id)->where('is_hidden', 0)->get();
    }

    public static function deleteItem($id)
    {
        return GradeItems::query()->where('id' , $id)->update(['is_hidden' , 1]);
    }
}
