<?php
 
namespace App\Http\Resources;
 
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
 
class PostListResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'wp_category_id' => $this->wp_category_id,
            'title'          => $this->wpPost->title,
            'slug'           => $this->wpPost->slug,
            'published_at'   => $this->created_at,
            'updated_at'     => $this->wpPost->post_modified
        ];
    }
}
