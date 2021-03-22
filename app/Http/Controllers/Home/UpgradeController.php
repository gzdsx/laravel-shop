<?php

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Jobs\CopyImage;
use App\Models\ProductItem;
use App\Models\ProductCate;
use App\Models\ProductCategory;
use App\Models\ProductCollect;
use App\Models\ProductContent;
use App\Models\ProductImage;
use App\Models\Material;
use App\Models\Order;
use App\Models\PostCollect;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Contracts\OrderServiceInterface;
use App\Support\VideoParser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpgradeController extends Controller
{

    public function index(Request $request)
    {
//        foreach (ProductCate::all() as $cate) {
//            ProductItem::where('itemid', $cate->itemid)->update(['catid' => $cate->catid]);
//        }
//        foreach (Transaction::all() as $transaction) {
//            Order::where('order_id', $transaction->order_id)->update(['transaction_id' => $transaction->transaction_id]);
//        }
//        return 'ok';

//        return Order::with(['transaction' => function (Builder $builder) {
//            return $builder->where('payer_id', 1000000);
//        }])->toSql();

        User::whereKey(1042820)->update(['password' => bcrypt('12345678')]);
    }

    protected function transferItems()
    {
        $items = $this->connection()->table('item')->where('shop_id', 1812)->orderBy('itemid')->get();
        foreach ($items as $item) {
            $i = new ProductItem();
            $i->fill((array)$item)->save();
            $c = new ProductCate();
            $c->fill((array)$item)->save();
        }
    }

    protected function transferContents()
    {
        $ids = ProductItem::withoutGlobalScopes()->get()->pluck('itemid');
        $contents = DB::connection('cugeng')->table('item_content')->whereIn('itemid', $ids)->get();
        foreach ($contents as $con) {
            ProductContent::where('itemid', $con->itemid)->update(['content' => $con->content]);
        }
    }

    protected function transferCatlogs()
    {
        foreach ($this->connection()->table('item_catlog')->get() as $catlog) {
            $c = new ProductCategory();
            $c->fill((array)$catlog);
            $c->save();
        }
    }

    protected function transferImages()
    {
        $ids = ProductItem::withoutGlobalScopes()->get()->pluck('itemid');
        $contents = $this->connection()->table('item_image')->whereIn('itemid', $ids)->get();
        foreach ($contents as $con) {
            $img = new ProductImage();
            $img->fill((array)$con)->save();
        }
    }

    protected function copyImages()
    {
        foreach (ProductImage::all() as $item) {
            $thumb = $item->getOriginal('thumb');
            $image = $item->getOriginal('image');
            dispatch_now(new CopyImage('/vdata/www/www.cugeng.cn/storage/app/public/' . $thumb, material_path($thumb)));
            dispatch_now(new CopyImage('/vdata/www/www.cugeng.cn/storage/app/public/' . $image, material_path($image)));
        }

        foreach (ProductItem::withoutGlobalScopes()->get() as $item) {
            $thumb = $item->getOriginal('thumb');
            $image = $item->getOriginal('image');
            dispatch_now(new CopyImage('/vdata/www/www.cugeng.cn/storage/app/public/' . $thumb, material_path($thumb)));
            dispatch_now(new CopyImage('/vdata/www/www.cugeng.cn/storage/app/public/' . $image, material_path($image)));
        }

        foreach (ProductCategory::all() as $item) {
            dispatch_now(new CopyImage('/vdata/www/www.cugeng.cn/storage/app/public/' . $item->getOriginal('icon'), material_path($item->getOriginal('icon'))));
        }
    }

    protected function transferMaterials()
    {
        $ids = ProductImage::all()->map(function (ProductImage $im) {
            return $im->getOriginal('thumb');
        });

        foreach ($this->connection()->table('material')->whereIn('thumb', $ids)->get() as $material) {
            $m = new Material();
            $m->fill((array)$material);
            $m->save();
        }
    }

    /**
     * @return \Illuminate\Database\Connection|\Illuminate\Database\ConnectionInterface
     */
    protected function connection()
    {
        return DB::connection('cugeng');
    }

}
