<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'attempt',
        'result',
        'date'
    ];

    protected $hidden = [
        'test_id',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tets() {
        return $this->belongsTo(Tets::class);
    }
}
