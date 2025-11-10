<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'gender',
    'email',
    'age_id',
    'opinion',
    'is_send_email',


    ];

    // 年代リレーション
    public function age()
    {
        return $this->belongsTo(Age::class);
    }
}
