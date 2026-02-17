<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
protected $fillable = ['book_code', 'name', 'author', 'published_year', 'stock', 'price', 'user_id'];
}