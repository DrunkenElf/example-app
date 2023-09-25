<?php

namespace App\Repositories;

use App\Contracts\Category\CategoryRepositoryContract;
use App\Dto\Category\CategoryDto;
use App\Dto\Category\CreateCategoryDto;
use App\Dto\Category\UpdateCategoryDto;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryContract
{

    public function store(CreateCategoryDto $dto)
    {
        $category = Category::query()
            ->create([
                'name' => $dto->name,
                'description' => $dto->description,
                'createdDate' => $dto->createDate,
                'active' => $dto->active
            ]);

        return $category->toDto();
    }

    public function update(UpdateCategoryDto $dto)
    {
        Category::query()
            ->where('id', $dto->id)
            ->update($dto->toArray());
    }

    public function delete(int $id)
    {
        Category::destroy($id);
    }

    public function findById(int $id): CategoryDto
    {
        $category =  Category::find($id);

        if (isset($category)) {
            return $category->toDto();
        }

        throw new \Exception();
    }
}
