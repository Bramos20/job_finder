<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job'; // Make sure this matches your database table name

    protected $fillable = [
        'title',
        'company',
        'link', // Ensure this column exists in your table
    ];
}

