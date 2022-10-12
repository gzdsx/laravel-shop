<?php

namespace App\Console\Commands;

use App\Models\EcomProductContent;
use App\Models\EcomProductItem;
use Illuminate\Console\Command;

class TransferProductContent extends Command
{
    use Connection;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer-product-content';

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
        foreach ($this->connection()->table('product_content')->get() as $data) {
            $model = new EcomProductContent();
            $model->itemid = $data->itemid;
            $model->content = $data->content;
            $model->save();
        }
        return 0;
    }
}
