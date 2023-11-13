<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'result',
        'test_id',
        'user_id',
        'attempts',
        'status_id',
    ];

    protected $hidden = [
        'result',
        'test_id',
        'user_id',
        'attempts',
        'status_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tests() {
        return $this->belongsTo(Test::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }
}
