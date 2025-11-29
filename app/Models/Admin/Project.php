<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name','category_id', 'date', 'country', 'industry', 'website', 'desktop_image', 'mobile_image', 'image_alt_tag', 'meta_title', 'meta_description', 'keyword', 'slug'];
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
