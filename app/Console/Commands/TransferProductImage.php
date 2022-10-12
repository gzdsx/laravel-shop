<?php

namespace App\Console\Commands;

use App\Models\EcomProductImage;
use Illuminate\Console\Command;

class TransferProductImage extends Command
{
    use Connection;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer-product-image';

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
        foreach ($this->connection()->table('product_image')->get() as $data) {
            $model = new EcomProductImage();
            $model->itemid = $data->itemid;
            $model->thumb = $data->thumb;
            $model->image = $data->image;
            $model->sort_num = $data->displayorder;
            $model->save();
        }
        return 0;
    }
}
