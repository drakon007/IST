<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class Question extends Model
{
    use HasFactory, HasTrixRichText;

    public $timestamps = false;

    protected $fillable = [
        'question',
        'test_id'
    ];

    public function test() {
        return $this->belongsTo(Test::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }
}
