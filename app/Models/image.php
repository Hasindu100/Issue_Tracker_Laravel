<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    use HasFactory;

    protected $fillable = [
        "imagable_type","imagable_id","size","path","name","extention"
    ];

    public function imageble() {
        return $this->morphTo();
    }

    public $timestamps = false;
}
