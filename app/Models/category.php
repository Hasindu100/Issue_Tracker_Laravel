<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    function subcategory() {
        return $this->hasMany(Subcategory::class);
    }

    function issues() {
        return $this->belongsToMany(issue::class,'issue_categories');
    }

    protected $fillable = [
        "title","body","uuid","slug"
    ];

    public $timestamps = false;
}
