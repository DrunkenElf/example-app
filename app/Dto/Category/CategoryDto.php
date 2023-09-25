<?php

namespace App\Dto\Category;

use Carbon\Carbon;

class CategoryDto
{
    public function __construct(
        public int $id,
        public string $name,
        public string|null $description,
        public Carbon $createdDate,
        public bool $active,
    )
    {
    }
}
