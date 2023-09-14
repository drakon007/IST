<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interpretation extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'range'
    ];

    protected $hidden = [
        'test_id',
    ];
    
    public function test() {
        return $this->belongsTo(Test::class);
    }
}
