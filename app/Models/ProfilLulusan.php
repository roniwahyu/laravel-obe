<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilLulusan extends Model
{
    use HasFactory;
    public function profilLulusans()
    {
        return $this->hasMany(ProfilLulusan::class);
    }
}
