<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  Interpretation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'description',
        'max',
        'min',
        'column',
        'test_id',
    ];

    protected $hidden = [
        'description',
        'max',
        'min',
        'column',
        'test_id',
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
