<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class issue extends Model
{
    use HasFactory;

    function comments() {
        return $this->hasMany(comment::class);
    }

    function categories() {
        return $this->belongsToMany(category::class,'issue_categories');
    }

    function subcategories() {
        return $this->belongsToMany(subcategory::class);
    }

    protected $fillable = [
        "title","body","uuid","slug"
    ];

    public function images() {
        return $this->morphMany(Image::class, 'imagable');
    }

    public $timestamps = false;
}
