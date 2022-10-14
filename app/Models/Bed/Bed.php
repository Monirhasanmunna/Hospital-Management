<?php

namespace App\Models\Bed;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function bedtype()
    {
        return $this->belongsTo(BedType::class);
    }

    public function bedgroup()
    {
        return $this->belongsTo(BedGroup::class);
    }
}
