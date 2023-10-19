<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interpretation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'description',
        'max',
        'min'
    ];

    protected $hidden = [
        'max',
        'min',
        'test_id',
    ];

    public function tests() {
        return $this->belongsToMany(Test::class);
    }
}
