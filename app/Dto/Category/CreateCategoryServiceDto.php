<?php

namespace App\Dto\Category;

use Illuminate\Support\Facades\Date;

class CreateCategoryServiceDto
{
    public function __construct(
        public string $name,
        public string|null $description,
        public bool $active,
    )
    {
    }
}
