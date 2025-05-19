<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $fillable = ['name','position','salary', 'hire_date','department_id'];
    //

    public function department(){
        return $this->belongsTo(Department::class,'department_id','id');
    }
}
