<?php

namespace App\Contracts\Category;

use App\Dto\Category\CreateCategoryServiceDto;
use App\Dto\Category\UpdateCategoryServiceDto;

interface CategoryServiceContract
{
    public function store(CreateCategoryServiceDto $dto);

    public function update(UpdateCategoryServiceDto $dto);

    public function delete(int $id);

    public function findById(int $id);
}
