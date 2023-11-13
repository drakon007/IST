<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    public function tests() {
        return $this->belongsToMany(Test::class);
    }
    public function results() {
        return $this->belongsToMany(Result::class);
    }
}
