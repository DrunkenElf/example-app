<?php

namespace App\Http\Controllers;

use App\Contracts\Category\CategoryServiceContract;
use App\Dto\Category\CreateCategoryServiceDto;
use App\Dto\Category\UpdateCategoryServiceDto;
use App\Helpers\BooleanFormatHelper;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryServiceContract $categoryService,
    )
    {
    }

    public function store(CreateCategoryRequest $request)
    {
        $dto = new CreateCategoryServiceDto(
            name: $request->string('name'),
            description: $request->string('description'),
            active: BooleanFormatHelper::toBoolean($request->string('active'))
        );

        $createCategory = $this->categoryService->store($dto);

        $this->successResponse();
    }

    public function update(UpdateCategoryRequest $request)
    {
        return $this->categoryService->update(
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

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pageSize' => ['sometimes', 'numeric', 'min:1', 'max:9'],
            'page' => ['sometimes', 'numeric'],
            'active' => ['sometimes', 'nullable', Rule::in(['0', '1', 'true', 'false'])],
            'sort' => ['sometimes', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->failed());
        }

        $result = $this->categoryService->search(request()->query->all());

        return response()->json(CategoryResource::collection($result));
    }

}
