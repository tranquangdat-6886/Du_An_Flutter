<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasFactory;
    protected $table = "users";
    protected $primaryKey = "id";

    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'username',
        'password',
        'role',
        'api_token',
        // Thêm trường 'username' vào danh sách fillable
    ];
}
