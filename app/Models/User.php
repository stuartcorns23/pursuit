<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

use App\Models\Role;
use App\Models\Shift;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'company_name',
        'address_1',
        'address_2',
        'city',
        'postcode',
        'accountant_id',
        'photo_id',
        'role_id',
        'admin',
        'confirmed',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function timesheets(){
        return $this->hasMany(Timesheet::class);
    }

    public function photo()
    {
        return $this->belongsTo('App\Models\Photo');
    }

    public function documents()
    {
        return $this->hasMany('App\Models\Document');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function accountant(){
        return $this->belongsTo('App\Models\Accountant');
    }

    public function available(){
        return $this->hasMany('App\Models\Availability');
    }

    public function shifts(){
        return $this->hasMany('App\Models\Shift');
    }


    public function fullname(){
        return $this->first_name.' '.$this->last_name;
    }

    public function random_password($length)
    {
        //A list of characters that can be used in our
        //random password.
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!-.[]?*()';
        //Create a blank string.
        $password = '';
        //Get the index of the last character in our $characters string.
        $characterListLength = mb_strlen($characters, '8bit') - 1;
        //Loop from 1 to the $length that was specified.
        foreach(range(1, $length) as $i){
            $password .= $characters[random_int(0, $characterListLength)];
        }
        return $password;

    }

    public function has_shift($date){
        if($shift = Shift::where('user_id', '=', $this->id)->whereDate('date', $date)->first()){
            return $shift;
        }else{
            return false;
        }
    }

    public function availability($date){
        if($availability = Availability::where('user_id', '=', $this->id)->whereDate('date', $date)->first()){
            return $availability;
        }else{
            return false;
        }
    }

    public function full_address($sep){
        $output = $this->address_1.$sep;
        if($this->address_2 != ''){ $output .= $this->address_2.$sep; }
        $output .= $this->city.$sep.$this->postcode;
        return $output;
    }

    public function get_image(){
        if($this->photo()->exists() && file_exists(asset($this->photo->path))){
            return $this->photo->path;
        }else{
            return "images/profile.jpg";
        }
    }


    /* Laravel 9 */

    /* protected function firstName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value),
            set: fn ($value) => strtolower($value),
        );
    } */

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = Str::replaceFirst('0', '+44', $value);
    }

}
