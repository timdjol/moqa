<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['phone', 'email', 'email2', 'email3', 'address', 'whatsapp', 'telegram', 'instagram'];
}
