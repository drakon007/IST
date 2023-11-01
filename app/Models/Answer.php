<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'answer',
        'column',
        'balls'
    ];

    protected $hidden = [
        'question_id',
        'column',
        'balls'
    ];

    public function question() {
        return $this->belongsTo(Question::class);
    }
}
