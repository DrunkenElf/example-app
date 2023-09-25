<?php

namespace App\Dto\Category;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

class CreateCategoryDto
{
    public function __construct(
        public string $name,
        public string|null $description,
        public Carbon $createDate,
        public bool $active,
    )
    {
    }
}
