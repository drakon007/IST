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
        'status_id'
    ];

    protected $hidden = [
        'type'
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

    public function status() {
        return $this->belongsTo(Status::class);
    }
}
