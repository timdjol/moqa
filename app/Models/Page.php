<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Translatable;
    protected $fillable = ['code', 'title', 'description', 'title_en', 'description_en'];
}