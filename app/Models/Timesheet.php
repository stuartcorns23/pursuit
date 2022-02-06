<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 'week_start', 'week_end', 'shifts', 'mileage', 'additional', 'total_shifts', 'total_wages'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }    


}