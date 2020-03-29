<?php

namespace App\Http\Controllers\Admin;

use App\Models\Block;
use App\Models\BlockItem;
use App\Traits\Common\BlockTrait;
use Illuminate\Http\Request;

class BlockController extends BaseController
{
    use BlockTrait;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Exception
     */
    public function blocks()
    {

        $items = Block::paginate(20);
        return $this->view('admin.block.blocks', [
            'items'=>$items,
            'pagination'=>$items->render()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteBlocks(Request $request)
    {
        $items = $request->post('items', []);
        Block::whereIn('block_id', $items)->delete();
        BlockItem::where('block_id', $items)->delete();
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveBlock(Request $request)
    {
        $block_id = $request->input('block_id');
        $block = $request->post('block');
        if ($block['block_name']) {
            if ($block_id) {
                Block::find($block_id)->update($block);
            } else {
                Block::create($block);
            }
        }
        return ajaxReturn();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function blockItems(Request $request)
    {
        $block_id = $request->input('block_id');
        $block = Block::find($block_id);
        $items = $block->items()->paginate(10);
        $pagination = $items->render();
        return $this->view('admin.block.items', compact('block_id', 'block', 'items', 'pagination'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function batchUpdateItems(Request $request)
    {
        $delete = $request->post('delete', []);
        if ($delete) {
            BlockItem::whereIn('id', $delete)->delete();
        }

        $items = $request->post('items',[]);
        if ($items) {
            $displayorder = 0;
            foreach ($items as $id => $item) {
                $item['displayorder'] = $displayorder++;
                BlockItem::where('id', $id)->update($item);
            }
        }
        return $this->messager()->render();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newitem(Request $request)
    {
        $id = $request->input('id', 0);
        $block_id = $request->input('block_id', 0);
        $block = Block::find($block_id);
        if ($id) {
            $item = $block->items()->find($id);
        } else {
            $item = new BlockItem();
        }

        return $this->view('admin.block.newitem', compact('id', 'block_id', 'block', 'item'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function saveItem(Request $request)
    {
        $id = $request->input('id', 0);
        $block_id = $request->input('block_id', 0);
        $newitem = $request->post('item', []);

        $block = Block::find($block_id);
        if ($id) {
            $block->items()->find($id)->update($newitem);
        } else {
            $block->items()->create($newitem);
        }
        return $this->messager()->setLinks([
                [trans('common.go back'), url()->previous()],
                [trans('common.back list'), admin_url('block/items?block_id=' . $block_id)]
            ])->render();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function setImage(Request $request)
    {
        $id = $request->input('id');
        $image = $request->input('image');
        if ($id && $image) {
            BlockItem::find($id)->update(['image' => $image]);
        }
        return ajaxReturn();
    }
}
