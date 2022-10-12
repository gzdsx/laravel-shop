<?php

namespace App\Console\Commands;

use App\Models\EcomProductCategory;
use Illuminate\Console\Command;

class TransferProductCategory extends Command
{
    use Connection;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer-product-category';

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
        foreach ($this->connection()->table('product_category')->get() as $data) {
            $model = new EcomProductCategory();
            $model->cate_id = $data->catid;
            $model->cate_name = $data->name;
            $model->parent_id = $data->fid;
            $model->identifier = $data->identifier;
            $model->image = $data->image;
            $model->sort_num = $data->displayorder;
            $model->level = $data->level;
            $model->save();
        }

        return 0;
    }
}
