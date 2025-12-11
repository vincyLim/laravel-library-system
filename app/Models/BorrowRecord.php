<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BorrowRecord extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function librarian()
    {
        return $this->belongsTo(User::class);
    }

    public function return_librarian()
    {
        return $this->belongsTo(User::class);
    }

    public function penalty()
    {
        return $this->hasOne(Penalty::class);
    }

    public function isRequested()
    {
        return $this->start_date == null && $this->end_date == null;
    }

    public function isBorrowed()
    {
        return $this->start_date != null && $this->end_date != null && $this->return_date == null;
    }
    public function isReturned()
    {
        return $this->return_date != null;
    }

    public function isOverdue()
    {
        return $this->isReturned() && $this->end_date < $this->return_date;
    }

    public function isPenaltyPaid()
    {
        return $this->penalty && $this->penalty->isPaid();
    }

    public function scopeGetRequesting(Builder $query)
    {
        return $query->whereNull('start_date')->whereNull('end_date');
    }

    public function scopeGetBorrowing(Builder $query)
    {
        return $query->whereNotNull('start_date')->whereNotNull('end_date')->whereNull('return_date');
    }

    public function scopeGetReturned(Builder $query)
    {
        return $query->whereNotNull('return_date')->whereColumn('end_date', '>', 'return_date');
    }

    public function scopeGetOverdue(Builder $query)
    {
        return $query->whereNotNull('return_date')->whereColumn('end_date', '<', 'return_date');
    }
}
