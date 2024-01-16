<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        $comments = $this->whenLoaded('comments') ? $this->comments->sortByDesc('created_at') : [];

        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "user_id" => $this->user_id,
            "user" => $this->user->name,
            "category_id" => $this->category_id,
            "category" => $this->category->name,
            "createAtFormated" => $this->created_at->diffForHumans(),
            "created_at" => $this->created_at,
            "status" => $this->status,
            "is_comment" => $this->is_comment,
            "totalComments" => count($this->comments),
            //   "comments" => CommentResource::collection($this->whenLoaded('comments')),
            "comments" => CommentResource::collection($comments),

        ];
    }
}
