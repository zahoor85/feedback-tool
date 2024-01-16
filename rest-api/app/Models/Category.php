<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Feedback;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ["name"];

    protected $hidden = [
        'updated_at'
    ];
}
