<?php

namespace App\Http\Resources;

use App\Dto\Category\CategoryDto;
use Illuminate\Http\Request;

class CategoryResource extends \Illuminate\Http\Resources\Json\JsonResource
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
