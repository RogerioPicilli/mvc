<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Address extends Model
{
    protected $fillable = ['address', 'number', 'complement', 'zipcode', 'city', 'state'];

    public function user() 
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
}
