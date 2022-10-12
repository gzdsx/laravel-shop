<?php

namespace App\Console\Commands;

use App\Models\EcomProductItem;
use Illuminate\Console\Command;

class TransferProductItem extends Command
{
    use Connection;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer-product-item';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach ($this->connection()->table('product_item')->get() as $data) {
            $model = new EcomProductItem();
            $model->fill((array)$data);
            $model->cate_id = $data->catid;
            $model->itemid = $data->itemid;
            $model->seller_id = $data->uid ?? 0;
            $model->save();
        }
        return 0;
    }
}
