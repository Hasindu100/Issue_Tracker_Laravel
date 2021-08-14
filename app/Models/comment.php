<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    function issues() {
        return $this->belongsToMany(isuue::class);
    }

    protected $fillable = [
        "issue_id","body"
    ];

    public function images() {
        return $this->morphMany(Image::class, 'imagable');
    }

    public $timestamps = false;
}
