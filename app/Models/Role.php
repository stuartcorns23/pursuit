<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Role;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    public function users(){
        $this->belongsTo(User::class);
    }

    public function role(){
        $this->belongsTo(Role::class);
    }
}
