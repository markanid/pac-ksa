<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name','description','image', 'image_alt_tag', 'keyword', 'slug','details','meta_title'];
    use HasFactory;
}
