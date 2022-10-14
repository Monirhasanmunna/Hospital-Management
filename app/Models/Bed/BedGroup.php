<?php

namespace App\Models\Bed;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedGroup extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }
}
