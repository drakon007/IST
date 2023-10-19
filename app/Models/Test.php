<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'type',
        'name',
        'status'
    ];

    protected $hidden = [
        'type',
        'status'
    ];

    public function results() {
        return $this->hasMany(Result::class);
    }
    public function interpretations() {
        return $this->belongsToMany(Interpretation::class);
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }
}
