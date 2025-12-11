<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function borrowRecord()
    {
        return $this->belongsTo(BorrowRecord::class);
    }

    public function isPaid()
    {
        return $this->status == 'paid';
    }
}
