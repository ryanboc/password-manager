<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Password extends Model
{
    use HasFactory;

    protected $fillable = ['site_name', 'username', 'password', 'user_id'];

    // Encrypt password before saving
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Crypt::encryptString($value);
    }

    // Decrypt password when retrieving
    public function getPasswordAttribute($value)
    {
        return Crypt::decryptString($value);
    }
}
