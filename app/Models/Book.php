<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function authors()
    {
        return $this->belongsToMany(Author::class,'book_author');
    }

    public function borrowRecords()
    {
        return $this->hasMany(BorrowRecord::class);
    }

}
