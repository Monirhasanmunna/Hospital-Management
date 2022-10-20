<?php

namespace App\Models;

use App\Models\Pathology\pathologyPatient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefferedAmountDetail extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id','refd_amount','refd_paid_amount','doctor_paid','refferel_paid'];

    public function patinet()
    {
        return $this->belongsTo(pathologyPatient::class,'patient_id','id');
    }
}
