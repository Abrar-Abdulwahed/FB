<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    protected $fillable = ['name','message','type','start_date','end_date','country','gender','min_age','max_age'];
    protected $dates = ['start_date', 'end_date'];
}
