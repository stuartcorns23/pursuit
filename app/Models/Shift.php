<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Client;

class Shift extends Model
{
    use HasFactory;

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function scopeCompletedFilter($query, $status){
        return $query->whereDate('date', '>=', \Carbon\Carbon::now());
    }
}
