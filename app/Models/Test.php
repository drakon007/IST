<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class Test extends Model
{
    use HasFactory, HasTrixRichText;

    public $timestamps = false;

    protected $fillable = [
        'description',
        'type',
        'name',
        'status_id'
    ];

    protected $hidden = [
        'description',
        'type',
        'name',
        'status_id'
    ];

    public function interpretations() {
        return $this->belongsToMany(Interpretation::class);
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function answers_users() {
        return $this->hasMany(AnswerUser::class);
    }
}
