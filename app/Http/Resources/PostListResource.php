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
            'excerpt'        => $this->wpPost->post_excerpt,
            'thumbnail'      => $this->wpPost->thumbnail?->attachment?->url,
            'created_at'     => $this->wpPost->post_date,
            'updated_at'     => $this->wpPost->post_modified
        ];
    }
}
