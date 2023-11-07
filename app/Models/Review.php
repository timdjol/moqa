<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use Translatable;
    protected $fillable = ['title', 'title_en', 'description', 'description_en', 'image'];
}
