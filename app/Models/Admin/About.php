<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = ['welcome', 'welcome_ar', 'hspolicy','hspolicy_ar', 'our_journey', 'our_journey_ar', 'vision', 'vision_ar', 'commitment', 'commitment_ar', 'whychooseus', 'whychooseus_ar','image'];
    use HasFactory;
}
