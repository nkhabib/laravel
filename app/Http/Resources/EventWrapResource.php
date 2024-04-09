<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventWrapResource extends JsonResource
{
    public static $wrap = "value";
    # ini digunakan jika ingin mengganti nama variabel yang biasanya "data" menjadi nama lain
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'judul' => $this->judul_event,
            'konten' => $this->detail,
            'tanggal' => $this->tgl,
            'jam' => $this->waktu,
            'lokasi' => $this->tempat,
            'penyelenggara' => $this->penyelenggara
        ];
    }
}
