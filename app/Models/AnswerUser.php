<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerUser extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'test_id',
        'user_id',
        'status',
        'start_at',
        'end_at',
    ];

    protected $hidden = [
        'test_id',
        'user_id',
        'status',
        'start_at',
        'end_at',
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
    public function test() {
        return $this->belongsTo(Test::class);
    }

}
