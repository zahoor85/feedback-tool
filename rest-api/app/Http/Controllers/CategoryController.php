<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    //
    public function index(Request $request)
    {
        return new CategoryCollection(Category::all());
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->all());
        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $category->update($request->all());
        return new CategoryResource(Category::find($category->id));
    }

    public function destory(Category $category){

        $category->destroy($category);
        return response()->json([], 204);
    }
}
