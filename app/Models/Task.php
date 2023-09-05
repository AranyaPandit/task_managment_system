<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'url',
        'status',
        'images',
        'user_id',
        'assign_by',
    ];
}
