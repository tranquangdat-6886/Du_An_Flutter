<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $primaryKey = 'STU_ID';
    public $timestamps = false;
    public function attendance(){
        return $this->hasMany(Attendance::class,'STU_ID','STU_ID');
    }
}