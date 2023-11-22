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
        'user_id',
    ];

    protected $hidden = [
        'result',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
