<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $primaryKey = 'EVE_ID';
    public $timestamps = false;

    public function attendance(){
        return $this->hasMany(Attendance::class,'EVE_ID','EVE_ID');
    }
}