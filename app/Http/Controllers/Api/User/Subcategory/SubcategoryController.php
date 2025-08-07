<?php

namespace App\Http\Controllers\Api\User\Subcategory;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\JsonResponse;

class SubcategoryController extends Controller
{
    /**
     * GET /api/banners
     * Display a list of banners with only id and image URL from Spatie Media Library.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $subcategories = Subcategory::latest()
            ->get()
            ->map(fn($subcategory) => [
                'id'          => $subcategory->id,
                'category_id' => $subcategory->category_id,
                'name'       => $subcategory->name,
                'image'       => asset($subcategory->image),
            ]);

        return ApiResponseHelper::success(
            __('messages.category_list_retrieved'),
            $subcategories
        );
    }
}
