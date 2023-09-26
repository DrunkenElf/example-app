<?php

namespace App\Http\Resources;

use App\Dto\Category\CategoryDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array<string, float|int|null>
     */
    public function toArray(Request $request): array
    {
        /** @var CategoryDto $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'createdDate' => $this->createdDate,
            'active' => $this->active,
        ];
    }
}
