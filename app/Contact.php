<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contact extends Model
{
    protected $guarded = [];

    protected $table = 'contacts';


    /**
     * * convert the birthday format for GET (in array or JSON)
     */
    public function getBirthdayAttribute($attr)
    {
        return Carbon::parse($attr)->format('Y-m-d');
    }

    public function setFirstNameAttribute($attr)
    {
        $this->attributes['first_name'] = ucfirst($attr);
    }
    public function setLastNameAttribute($attr)
    {
        $this->attributes['last_name'] = ucfirst($attr);
    }
}
