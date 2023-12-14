<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class  Interpretation extends Model
{
    use HasFactory, HasTrixRichText;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'max',
        'min',
        'column',
        'test_id',
    ];

    protected $hidden = [
        'name',
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
