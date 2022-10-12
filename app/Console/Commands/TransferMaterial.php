<?php

namespace App\Console\Commands;

use App\Models\CommonMaterial;
use Illuminate\Console\Command;

class TransferMaterial extends Command
{
    use Connection;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer-material';

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
        foreach ($this->connection()->table('material')->get() as $data) {
            $model = new CommonMaterial();
            $model->fill((array)$data);
            $model->id = $data->id;
            $model->save();
        }
        return 0;
    }
}
