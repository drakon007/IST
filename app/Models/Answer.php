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
        'balls',
        'question_id',
    ];

    protected $hidden = [
        'question_id',
        'column',
        'balls',
        'question_id',
    ];

    public function question() {
        return $this->belongsTo(Question::class);
    }
    public function answerUsers() {
        return $this->belongsToMany(AnswerUser::class);
    }

}
