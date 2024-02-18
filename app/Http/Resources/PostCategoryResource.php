<?php
 
namespace App\Http\Resources;
 
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
 
class PostCategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'wp_category_id' => $this->wp_category_id,
            'name'           => $this->wpCategory->name,
            'slug'           => $this->wpCategory->slug
        ];
    }
}
