<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            "id" => $this->id,
            "content" => $this->content,
            "user_id"=>$this->user_id,
            "user" => $this->user->name,
            "createAtFormated" => $this->created_at->diffForHumans(),
            "created_at" => $this->created_at
        ];
    }
    
}
