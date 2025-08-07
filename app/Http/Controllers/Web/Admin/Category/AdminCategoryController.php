<?php

namespace App\Http\Controllers\Web\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Web\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Dashboard\CategoryService;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $query = Category::latest();


        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }


        $categories = $query->paginate(10);


        return view('Admin.pages.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('Admin.pages.categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {

        $this->categoryService->store($request->validated());
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');;
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('Admin.pages.categories.edit', compact('Category'));
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $this->categoryService->update($id, $request->validated());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');;
    }

    public function destroy($id)
    {
        $this->categoryService->delete($id);
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');;
    }
}
