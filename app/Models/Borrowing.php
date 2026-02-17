<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Borrowing extends Model
{
    protected $fillable = ['user_id', 'book_id', 'borrow_date', 'return_date', 'status'];

    public function getStatusAttribute($value)
    {
        if ($value === 'returned') {
            return 'returned';
        }

        if (Carbon::parse($this->return_date)->isPast() && !Carbon::parse($this->return_date)->isToday()) {
            return 'overdue';
        }

        return $value;
    }

    public function user() { return $this->belongsTo(User::class); }
    public function book() { return $this->belongsTo(Book::class); }
}