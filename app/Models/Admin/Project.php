<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'name_ar', 'desktop_image', 'image_alt_tag', 'meta_title', 'meta_description', 'keyword', 'slug'];
}
