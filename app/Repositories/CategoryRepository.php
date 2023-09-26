<?php

namespace App\Repositories;

use App\Contracts\Category\CategoryRepositoryContract;
use App\Dto\Category\CategoryDto;
use App\Dto\Category\CreateCategoryDto;
use App\Dto\Category\SearchCategoryDto;
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
        return Category::query()
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


    public function search(SearchCategoryDto $dto)
    {
        $result = Category::where(function ($q) use ($dto){
            foreach ($dto->whereFields as $key => $value) {
                if (!is_null($value)) {
                    if (in_array($key, ['name', 'description'])) {
                        $q->whereRaw('LOWER(name) LIKE ?', ['%' . $value . '%']);
                    } else {
                        $q->where($key, '=', $value);
                    }
                }
            }
        })
            ->orderBy($dto->sortField, $dto->sortType)
            ->forPage($dto->page, $dto->pageSize)
            ->get(['id', 'name', 'description', 'createdDate', 'active'])
            ->map(function (Category $category) {
                return new CategoryDto(
                    id: $category->id,
                    name: $category->name,
                    description: $category->description,
                    createdDate: $category->createdDate,
                    active: $category->active
                );
            })
            ->toArray();
        return $result;
    }

    public function searchDefault()
    {
        // TODO: Implement searchDefault() method.
    }
}
