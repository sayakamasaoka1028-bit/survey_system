<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    // ここを追加
    protected $fillable = ['name', 'email', 'age_id', 'opinion'];
}
