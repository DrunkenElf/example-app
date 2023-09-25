<?php

namespace App\Http\Controllers;

use App\Contracts\Category\CategoryServiceContract;
use App\Dto\Category\CreateCategoryServiceDto;
use App\Dto\Category\UpdateCategoryServiceDto;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryServiceContract $categoryService,
    )
    {
    }

    public function store(CreateCategoryRequest $request)
    {
        //dd($request);
        $dto = new CreateCategoryServiceDto(
            name: $request->string('name'),
            description: $request->string('description'),
            active: $request->boolean('active')
        );

        $createCategory = $this->categoryService->store($dto);

        $this->successResponse();
    }

    public function update(UpdateCategoryRequest $request)
    {
        $updateCategory = $this->categoryService->update(
            new UpdateCategoryServiceDto(
                id: $request->integer('id'),
                name: $request->string('name'),
                description: $request->string('description'),
                active: $request->boolean('active')
            )
        );


    }

    public function delete(int $id)
    {
        $this->categoryService->delete($id);
    }

    public function findById(int $id)
    {
        $tmp = $this->categoryService->findById($id);

        return response()->json(CategoryResource::make($tmp));
    }

    public function search(\Request $request)
    {
        dd($request);
    }

}
