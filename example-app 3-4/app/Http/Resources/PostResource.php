<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class PostResource extends JsonResource
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
            "id"=> $this->id,
            "title"=> $this->title,
            "description"=> $this->description,
            // user has ALL data from the db BUT we want specific cols. so create a userResource
            "user"=> new UserResource($this->user) 
        ];
    }
}
