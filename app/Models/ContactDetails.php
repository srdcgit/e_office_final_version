<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'name',
        'ministry_department',
        'state',
        'designation',
        'organitation',
        'email',
        'address',
        'pin_code',
        'phone_number',
        'country',
        'city'
    ];

    public function misnistry()
    {
        return $this->belongsTo(Ministry::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
