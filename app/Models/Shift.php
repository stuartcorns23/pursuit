<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Client;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'client_id', 'contact_name', 'date', 'start_time', 'finish_time', 'details', 'charge', 'rate', 'status', 'responded_date', 'completed'];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeCompletedFilter($query, $status){
        return $query->whereDate('date', '>=', \Carbon\Carbon::now());
    }
}
