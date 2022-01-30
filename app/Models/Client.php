<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contact', 'address_1', 'address_2', 'city', 'postcode', 'photo_id', 'email', 'telephone'];

    public function photo()
    {
        return $this->belongsTo('App\Models\Photo');
    }
}
