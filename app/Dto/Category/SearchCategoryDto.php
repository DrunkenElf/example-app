<?php

namespace App\Dto\Category;

class SearchCategoryDto
{
    public function __construct(
        public array $whereFields,
        public int $page,
        public int $pageSize,
        public string $sortType,
        public string $sortField,
    )
    {
    }
}
