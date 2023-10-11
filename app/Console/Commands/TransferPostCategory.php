<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\EcomProductCategory;
use App\Models\PostCategory;
use Illuminate\Console\Command;

class TransferPostCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer-categories';

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
        foreach (EcomProductCategory::get() as $category) {
            $cate = new Category();
            //$cate->cate_id = $category->cate_id;
            $cate->parent_id = $category->parent_id;
            $cate->name = $category->cate_name;
            $cate->slug = $category->identifier;
            $cate->sort_num = $category->sort_num;
            $cate->taxonomy = 'product';
            $cate->save();
        }
        return 0;
    }
}
