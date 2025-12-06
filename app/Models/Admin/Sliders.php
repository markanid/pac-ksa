<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sliders extends Model
{
    protected $fillable = ['image', 'heading_1','heading_1ar', 'heading_2','heading_2ar', 'title', 'title_ar'];
    use HasFactory;
}
