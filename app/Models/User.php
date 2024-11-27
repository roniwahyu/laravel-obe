<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    // Add the 'name' field (and any other fields) to the $fillable array
    protected $fillable = [
        'name',      // Add this field
        'email',     // Example of other fields
        'password',  // Example of other fields
    ];
}
