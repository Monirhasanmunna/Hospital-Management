<?php

namespace App\Models\Pathology;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pathologyTest extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(pathologyCategory::class,'category_id');
    }

    public function patients()
    {
        return $this->belongsToMany(pathologyPatient::class,'patient_test','pathology_patient_id','pathology_test_id');
    }
}
