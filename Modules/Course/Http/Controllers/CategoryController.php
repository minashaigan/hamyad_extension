<?php

namespace Modules\Course\Http\Controllers;

use App\Transformers\CategoryTransformer;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use Modules\Course\Entities\Category;
use Spatie\Fractalistic\Fractal;

class CategoryController extends Controller
{
    /**
     * Display a listing of the category.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::all();
        $categories = Fractal::create()->collection($categories, new CategoryTransformer())
            ->toArray();

        return view('course::category_index')->with(['categories' => $categories]);
    }

    /**
     * Show the specified course.
     *
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $category = Category::query()->find($id);
        $category = Fractal::create()->item($category, new CategoryTransformer())
            ->toArray();

        return view('course::category_show')->with(['category' => $category]);
    }
}