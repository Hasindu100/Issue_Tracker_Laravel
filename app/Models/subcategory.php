<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
    use HasFactory;

    function issue() {
        return $this->belongsToMany(issue::class);
    }

    protected $fillable = [
        "category_id","name","description"
    ];

    public $timestamps = false;
}
