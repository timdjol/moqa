<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use Translatable;
    protected $fillable = ['title', 'title_en', 'image', 'link'];
}
