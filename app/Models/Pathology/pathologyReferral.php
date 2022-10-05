<?php

namespace App\Models\Pathology;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pathologyReferral extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function patients()
    {
        return $this->hasMany(pathologyPatient::class);
    }
}
