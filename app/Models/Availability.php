<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'day', 'night'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function am(){

        if($this->day === 1 && $this->night === 0){
            return true;
        }

        return false;

    }

    public function both(){

        if($this->day === 1 && $this->night === 1){
            return true;
        }

        return false;

    }

    public function pm(){

        if($this->day === 0 && $this->night === 1){
            return true;
        }

        return false;

    }

    public function unavailable(){

        if($this->day === 0 && $this->night === 0){
            return true;
        }

        return false;

    }

    public function available(){

        if($this->day === 1 || $this->night === 1){
            return true;
        }

        return false;

    }

    public function scopeDateFilter($query, $dates){
        return $query->whereDate('date', '=', $dates);
    }

    public function scopeUnavailableFilter($query){
        return $query->where('day', '=', 0)->where('night', '=', 0);
    }

    public function scopeAvailableFilter($query){
        return $query->where('day', '=', 1)->orWhere('night', '=', 1);
    }
}
