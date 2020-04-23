<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItemAttrs;
use Illuminate\Http\Request;

class ItemAttrController extends BaseController
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
            $items = ItemAttrs::where('attr_title', $attr_title)
                ->where('attr_value', 'like', "%$attr_value%")
                ->get();
        } else {
            $items = ItemAttrs::where('attr_title', 'like', "%$attr_title%")
                ->groupBy('attr_title')
                ->limit(10)->orderBy('attr_id')
                ->get();
        }

        return ajaxReturn(['items' => $items]);
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
            $attr_value = $request->input('attr_value');
            $result = ItemAttrs::where('attr_title', $attr_title)
                ->where('attr_value', $attr_value)->first();
            if (!$result) {
                $result = ItemAttrs::create(compact('attr_title', 'attr_value'));
            }

            $values = ItemAttrs::where('attr_title', $attr_title)->get(['attr_id', 'attr_value']);
            return ajaxReturn(['result' => [
                'attr_title' => $attr_title,
                'attr_values' => $values
            ]]);
        } else {
            return ajaxReturn([]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAttrs(Request $request)
    {
        if ($request->has('attr_id')) {
            ItemAttrs::whereKey($request->input('attr_id'))->delete();
        }

        if ($request->has('attr_title')) {
            ItemAttrs::where('attr_title', $request->input('attr_title'))->delete();
        }

        return ajaxReturn();
    }
}
