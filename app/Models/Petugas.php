<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model implements AuthenticatableContract {
    use HasFactory, Authenticatable;

    protected $table = 'petugas';
    protected $fillable = ['username', 'password'];
    public $timestamps = false;

    // Hash the password before saving, if needed
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }
}
