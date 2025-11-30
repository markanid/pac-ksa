<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'details', 'name_ar', 'details_ar', 'meta_title', 'description', 'image', 'image_alt_tag', 'keyword', 'slug'];
    use HasFactory;
}
