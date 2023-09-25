<?php

namespace App\Dto\Category;

class UpdateCategoryServiceDto
{
    public function __construct(
        public int $id,
        public string|null $name,
        public string|null $description,
        public bool|null $active,
    )
    {
    }

}
