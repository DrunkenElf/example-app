<?php

namespace App\Services;

use App\Contracts\Category\CategoryRepositoryContract;
use App\Contracts\Category\CategoryServiceContract;
use App\Dto\Category\CategoryDto;
use App\Dto\Category\CreateCategoryDto;
use App\Dto\Category\CreateCategoryServiceDto;
use App\Dto\Category\SearchCategoryDto;
use App\Dto\Category\UpdateCategoryDto;
use App\Dto\Category\UpdateCategoryServiceDto;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

use function PHPUnit\Framework\isEmpty;

class CategoryService implements CategoryServiceContract
{

    public function __construct(
        private readonly CategoryRepositoryContract $categoryRepository,
    )
    {
    }

    public function store(CreateCategoryServiceDto $dto)
    {
        return $this->categoryRepository->store(
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
        return $this->categoryRepository->update(
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

    public function search(array|null $params)
    {
        $isEmpty = is_null($params) || count($params) === 0;
        if ($isEmpty) {
            return $this->categoryRepository->searchDefault();
        }

        $params = $this->formatParams($params);
        $name = !is_null($params['name']) ? strtolower($params['name']) : null;
        $description = !is_null($params['description']) ? strtolower($params['description']) : null;
        $pageSize = !is_null($params['pageSize']) ? (int)$params['pageSize'] : 2;
        $page = (!is_null($params['page'])) ? (int)$params['page'] : 0;
        $active = !is_null($params['active']) ? in_array($params['active'], [ '1', 'true']) : null;

        $sortType = (!is_null($params['sort']) && !str_contains($params['sort'], '-')) ? 'ASC' : 'DESC';
        $sortField = 'createdDate';
        if (!is_null($params['sort'])) {
            $tmp = str_replace('-', '', $params['sort']);
            if (in_array($tmp, \Schema::getColumnListing((new Category())->getTable()))) {
                $sortField = $tmp;
            }
        }

        return $this->categoryRepository->search(
            new SearchCategoryDto(
                whereFields: [
                    'name' => $name,
                    'description' => $description,
                    'active' => $active,
                ],
                page: $page,
                pageSize: $pageSize,
                sortType: $sortType,
                sortField: $sortField
            )
        );
    }

    public function formatParams(array $params): array
    {
        return [
            'name' => $params['name'] ?? null,
            'description' => $params['description'] ?? null,
            'active' => $params['active'] ?? null,
            'page' => $params['page'] ?? null,
            'pageSize' => $params['pageSize'] ?? null,
            'sort' => $params['sort'] ?? null
        ];
    }
}
