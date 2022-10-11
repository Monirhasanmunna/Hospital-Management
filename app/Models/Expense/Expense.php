<?php

namespace App\Models\Expense;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    
    protected $fillable = ['category_id','date','amount','details'];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class,'category_id','id');
    }
}
