<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $fillable = [
        'name','email','image','birth_date'
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
