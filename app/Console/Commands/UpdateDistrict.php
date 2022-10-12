<?php

namespace App\Console\Commands;

use App\Models\CommonDistrict;
use App\Support\PinyinUtil;
use Illuminate\Console\Command;

class UpdateDistrict extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-district';

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
        CommonDistrict::get()->map(function (CommonDistrict $district) {
            if (!$district->letter) {
                $district->letter = PinyinUtil::firstChar($district->name);
            }
            if (!$district->pinyin) {
                $district->pinyin = PinyinUtil::pinyin($district->name);
            }
            $district->save();
        });

        return 0;
    }
}
