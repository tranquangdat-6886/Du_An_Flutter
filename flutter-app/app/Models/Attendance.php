<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendances';
    public $timestamps = false;
    protected $primaryKey = 'ATT_ID';

    public function event(){
        return $this->belongsTo(Event::class,'EVE_ID','EVE_ID');
    }
    public function student(){
        return $this->belongsTo(Student::class,'STU_ID','STU_ID');
    }
}