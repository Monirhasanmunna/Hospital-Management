<?php

namespace App\Models\Pathology;

use App\Models\RefferedAmountDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pathologyPatient extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function referral()
    {
        return $this->belongsTo(pathologyReferral::class,'referral_id');
    }

    public function doctor()
    {
        return $this->belongsTo(pathologyDoctor::class,'doctor_id');
    }

    public function tests()
    {
        return $this->belongsToMany(pathologyTest::class,'patient_test','pathology_patient_id','pathology_test_id');
    }

    public function refferel_payment()
    {
        return $this->hasOne(RefferedAmountDetail::class,'patient_id','id');
    }
}
