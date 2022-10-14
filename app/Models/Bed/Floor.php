<?php

namespace App\Models\Bed;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function bedGroups()
    {
        return $this->hasMany(BedGroup::class);
    }
}
