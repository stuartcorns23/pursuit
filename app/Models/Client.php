<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contact', 'address_1', 'address_2', 'city', 'postcode', 'photo_id', 'email', 'telephone', 'icon_color', 'text_color'];

    public function photo()
    {
        return $this->belongsTo('App\Models\Photo');
    }

    public function shiftsCompleted(){
        return $this->hasMany(Shift::class)->whereDate('date', '<=', \Carbon\Carbon::now());
    }

    public function shiftsIncoming(){
        return $this->hasMany(Shift::class)->whereDate('date', '>', \Carbon\Carbon::now());
    }

    public function full_address($sep){
        $output = $this->address_1.$sep;
        if($this->address_2 != ''){ $output .= $this->address_2.$sep; }
        $output .= $this->city.$sep.$this->postcode;
        return $output;
    }

    public function get_image(){
        if($this->photo->exists() && file_exists(asset($this->photo->path))){
            return $this->photo->path;
        }else{
            return "images/client.jpg";
        }
    }
}
