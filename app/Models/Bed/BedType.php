<?php

namespace App\Models\Bed;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedType extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function beds()
    {
        return $this->hasMany(Bed::class);
    }
}
