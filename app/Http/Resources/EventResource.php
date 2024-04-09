<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        #resource ini hanya  untuk data tunggal
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
