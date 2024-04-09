<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EventSimpleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => EventSimpleResource::collection($this->collection),
            # resource juga bisa digunakan didalam collection
            # daripada mengembalikan semua data dari model secara utuh 
            # lebih baik menggunakan resource berfungsi seperti filter apa aja yang akan ditampilin
            'total' => count($this->collection),
        ];
    }
}
