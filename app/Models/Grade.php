<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Grade extends Model
{
    use HasFactory;

     protected $fillable = [
         'title'
         ];

     public static function get($key): Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
     {
         return Grade::query()->where('is_hidden' , 0)->find($key);
     }

    public static function create($title): Model|\Illuminate\Database\Eloquent\Builder
    {
         return Grade::query()->create(['title' => $title]);
     }

     public static function updateGrade(Request $request)
     {
         return Grade::query()->where('id' , $request->id)->update($request->all());
     }

     public static function deleteGrade(Request $request): int
     {
         GradeItems::query()->where('grade_parent_id', $request->id)->delete();
         return Grade::query()->where('id', $request->id)->delete();
     }

     public static function getList()
     {
         return Grade::query()->where('is_hidden' , 0)->get();
     }

    public static function getListWithItems()
    {
        return Grade::query()->where('is_hidden' , 0)->get();
    }

    public static function deleteParent($id)
    {
        return Grade::query()->where('id' , $id)->update(['is_hidden' => TRUE]);
    }
}
