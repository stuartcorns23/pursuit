<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Timesheet extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    
    protected $fillable = [
        'user_id', 'week_start', 'week_end', 'shifts', 'mileage', 'additional', 'total_shifts', 'total_wages', 'pay_type', 'comments'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }  

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('timesheet');
    }

    public function scopeUserFilter($query, $user)
    {
        return $query->where('user_id', '=', $user);
    }

    public function scopeDateFilter($query,  $end)
    {
        return $query->where('week_end', '=', $end);
    }


}