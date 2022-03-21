<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accountant extends Model
{
    use HasFactory;

    protected $guarded = []; 
    
    
    public function full_address($sep){
        $output = $this->address_1.$sep;
        if($this->address_2 != ''){ $output .= $this->address_2.$sep; }
        $output .= $this->city.$sep.$this->postcode;
        return $output;
    }
}
