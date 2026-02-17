<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BorrowingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'borrow_date' => $this->borrow_date,
            'return_date' => $this->return_date,
            'status' => $this->status,
            'user' => [
                'id' => $this->user->id ?? null,
                'name' => $this->user->name ?? 'Unknown',
            ],
            'book' => [
                'id' => $this->book->id ?? null,
                'title' => $this->book->name ?? 'Unknown',
            ],
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}