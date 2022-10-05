<?php

namespace App\Http\Controllers\Api\Page;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\PageCategory;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $query = PageCategory::query();
        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->get()
        ]);
    }
}
