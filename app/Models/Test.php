<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name'
    ];

    protected $hidden = [
        'type',
        'visible'
    ];

    public function results() {
        return $this->hasMany(Result::class);
    }

    public function interpretations() {
        return $this->hasMany(Interpretation::class);
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }
}
