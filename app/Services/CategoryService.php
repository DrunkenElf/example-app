<?php

namespace App\Services;

use App\Contracts\Category\CategoryRepositoryContract;
use App\Contracts\Category\CategoryServiceContract;
use App\Dto\Category\CategoryDto;
use App\Dto\Category\CreateCategoryDto;
use App\Dto\Category\CreateCategoryServiceDto;
use App\Dto\Category\UpdateCategoryDto;
use App\Dto\Category\UpdateCategoryServiceDto;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

class CategoryService implements CategoryServiceContract
{

    public function __construct(
        private readonly CategoryRepositoryContract $categoryRepository,
    )
    {
    }

    public function store(CreateCategoryServiceDto $dto)
    {
        $category = $this->categoryRepository->store(
            new CreateCategoryDto(
                name: $dto->name,
                description: $dto->description,
                createDate: Carbon::now(),
                active: $dto->active
            )
        );
    }

    public function update(UpdateCategoryServiceDto $dto)
    {
        $this->categoryRepository->update(
            new UpdateCategoryDto(
                id: $dto->id,
                name: $dto->name,
                description: $dto->description,
                active: $dto->active
            )
        );
    }

    public function delete(int $id)
    {
        $this->categoryRepository->delete($id);
    }

    public function findById(int $id)
    {
        return $this->categoryRepository->findById($id);
    }
}
