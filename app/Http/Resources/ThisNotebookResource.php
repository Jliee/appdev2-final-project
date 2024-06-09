<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThisNotebookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'notebook id' => (string)$this->id,
            'title' => $this->title,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'pages' => PageResource::collection($this->whenLoaded('pages')),
        ];
    }
}
