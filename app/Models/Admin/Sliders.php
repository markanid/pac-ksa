<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sliders extends Model
{
    protected $fillable = ['image','section','heading_1','heading_2','title'];
    use HasFactory;
}
