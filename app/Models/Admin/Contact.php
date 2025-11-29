<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['addresses','phones','locations','email','facebook','instagram','linkedin','x'];
    protected $casts = [
        'addresses' => 'array',
        'phones' => 'array',
    ];
    use HasFactory;
}
