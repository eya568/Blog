<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded = [];
    Public function user()
    {
        return $this->belongsTo(User::class);
    }
    Public function publication()
    {
        return $this->belongsTo(Publication::class);
    }
}

