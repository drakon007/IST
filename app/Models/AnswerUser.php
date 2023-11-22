<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'result_id',
        'test_id',
        'user_id',
        'attempts',
        'status_id',
    ];

    protected $hidden = [
        'result_id',
        'test_id',
        'user_id',
        'attempts',
        'status_id',
    ];

    public function answers() {
        return $this->belongsToMany(Answer::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function result() {
        return $this->belongsTo(Result::class);
    }

}
