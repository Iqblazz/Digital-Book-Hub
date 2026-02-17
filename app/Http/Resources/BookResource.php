<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'book_code' => $this->book_code,
            'title' => $this->name,
            'author' => $this->author,
            'year' => $this->published_year,
            'stock' => $this->stock,
            'price' => $this->price,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}