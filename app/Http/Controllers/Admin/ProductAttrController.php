<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductAttrs;
use Illuminate\Http\Request;

class ProductAttrController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchAttrs(Request $request)
    {
        $attr_title = $request->input('attr_title');
        if ($request->has('attr_value')) {
            $attr_value = $request->input('attr_value');
            $items = ProductAttrs::where('attr_title', $attr_title)
                ->where('attr_value', 'like', "%$attr_value%")
                ->get();
        } else {
            $items = ProductAttrs::where('attr_title', 'like', "%$attr_title%")
                ->groupBy('attr_title')
                ->limit(10)->orderBy('attr_id')
                ->get();
        }

        return jsonSuccess(['items' => $items]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAttrs(Request $request)
    {
        $attr_title = $request->input('attr_title');
        $attr_value = $request->input('attr_value');
        if ($attr_title && $attr_value) {
            $attr = ProductAttrs::where(compact('attr_title', 'attr_value'))->first();
            if (!$attr) {
                $attr = ProductAttrs::create(compact('attr_title', 'attr_value'));
            }
            return jsonSuccess(['attr' => $attr]);
        }
        return jsonSuccess([]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAttrs(Request $request)
    {
        if ($request->has('attr_id')) {
            ProductAttrs::whereKey($request->input('attr_id'))->delete();
        }

        if ($request->has('attr_title')) {
            ProductAttrs::where('attr_title', $request->input('attr_title'))->delete();
        }

        return jsonSuccess();
    }
}
