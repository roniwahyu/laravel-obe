<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CPL extends Model
{
    use HasFactory;
    public function cpmks()
    {
        return $this->hasMany(CPMK::class);
    }
}
