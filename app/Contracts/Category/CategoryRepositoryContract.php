<?php

namespace App\Contracts\Category;

use App\Dto\Category\CategoryDto;
use App\Dto\Category\CreateCategoryDto;
use App\Dto\Category\SearchCategoryDto;
use App\Dto\Category\UpdateCategoryDto;

interface CategoryRepositoryContract
{
    public function store(CreateCategoryDto $dto);

    public function update(UpdateCategoryDto $dto);

    public function delete(int $id);

    public function findById(int $id): CategoryDto;

    public function search(SearchCategoryDto $dto);

    public function searchDefault();
}
