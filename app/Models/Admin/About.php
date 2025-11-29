<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = ['welcome', 'welcome_ar', 'glimbse','glimbse_ar', 'our_journey', 'our_journey_ar', 'vision', 'vision_ar', 'mission', 'mission_ar', 'whychoose', 'whychooseus_ar','image'];
    use HasFactory;
}
