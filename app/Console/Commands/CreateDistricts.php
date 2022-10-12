<?php

namespace App\Console\Commands;

use App\Models\CommonDistrict;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use function Stringy\create;

class CreateDistricts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-districts';

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
        $cache = Cache::get('cities', []);
//        foreach ($cache[0] as $province) {
//            $district = new District([
//                'zonecode' => $province['id'],
//                'name' => $province['name'],
//                'fullname' => $province['fullname'],
//                'lat' => $province['location']['lat'],
//                'lng' => $province['location']['lng'],
//                'pinyin' => implode('', $province['pinyin']),
//                'level' => 1
//            ]);
//            $district->save();
//        }
//
//
//        foreach ($cache[0] as $provice) {
//            $parent = District::where('zonecode', $provice['id'])->first();
//            $array = array_slice($cache[1], $provice['cidx'][0], $provice['cidx'][1] - $provice['cidx'][0] + 1);
//            foreach ($array as $city) {
//                if (isset($city['cidx'])) {
//                    $newCity = District::firstOrNew(['name' => $city['name'], 'level' => 2]);
//                    $newCity->forceFill([
//                        'name' => $city['name'],
//                        'fullname' => $city['fullname'],
//                        'lat' => $city['location']['lat'],
//                        'lng' => $city['location']['lng'],
//                        'level' => 2,
//                        'pinyin' => implode('', $city['pinyin']),
//                        'zonecode' => $city['id'],
//                        'fid' => $parent->id
//                    ])->save();
//                } else {
//                    $newCity = District::firstOrNew(['name' => $parent['name'], 'level' => 2]);
//                    $newCity->forceFill([
//                        'name' => $parent['name'],
//                        'fullname' => $parent['fullname'],
//                        'lat' => $parent['lat'],
//                        'lng' => $parent['lng'],
//                        'level' => 2,
//                        'pinyin' => $parent['pinyin'],
//                        'zonecode' => $parent['zonecode'],
//                        'fid' => $parent->id
//                    ])->save();
//                }
//            }
//        }
//
//        foreach ($cache[0] as $provice) {
//            $parent = District::where('zonecode', $provice['id'])->where('level', 2)->first();
//            $array = array_slice($cache[1], $provice['cidx'][0], $provice['cidx'][1] - $provice['cidx'][0] + 1);
//            if ($parent) {
//                foreach ($array as $city) {
//                    if (!isset($city['cidx'])) {
//                        $newCity = District::firstOrNew(['name' => $city['name'], 'level' => 3]);
//                        $newCity->forceFill([
//                            'name' => $city['name'],
//                            'fullname' => $city['fullname'],
//                            'lat' => $city['location']['lat'],
//                            'lng' => $city['location']['lng'],
//                            'level' => 2,
//                            'pinyin' => implode('', $city['pinyin']),
//                            'zonecode' => $city['id'],
//                            'fid' => $parent->id
//                        ])->save();
//                    }
//                }
//            } else {
//                dump($provice);
//            }
//        }

        $cities = [];
        $districts = [];

        foreach ($cache[0] as $province) {
            $np = CommonDistrict::create([
                'zonecode' => $province['id'],
                'name' => $province['name'],
                'fullname' => $province['fullname'],
                'lat' => $province['location']['lat'],
                'lng' => $province['location']['lng'],
                'pinyin' => implode('', $province['pinyin']),
                'level' => 1
            ]);

            $array = array_slice($cache[1], $province['cidx'][0], $province['cidx'][1] - $province['cidx'][0] + 1);
            foreach ($array as $city) {
                $city['fid'] = $np->id;
                $cities[] = $city;
            }
        }

        foreach ($cities as $city) {
            $nc = CommonDistrict::create([
                'name' => $city['name'],
                'fullname' => $city['fullname'],
                'lat' => $city['location']['lat'],
                'lng' => $city['location']['lng'],
                'level' => 2,
                'pinyin' => implode('', $city['pinyin']),
                'zonecode' => $city['id'],
                'fid' => $city['fid']
            ]);

            if (isset($city['cidx'])) {
                $array2 = array_slice($cache[2], $city['cidx'][0], $city['cidx'][1] - $city['cidx'][0] + 1);
                foreach ($array2 as $district) {
                    $district['fid'] = $nc->id;
                    $districts[] = $district;
                }
            }
        }

        foreach ($districts as $district) {
            CommonDistrict::create([
                'name' => $district['name'] ?? $district['fullname'],
                'fullname' => $district['fullname'],
                'lat' => $district['location']['lat'],
                'lng' => $district['location']['lng'],
                'level' => 3,
                'pinyin' => isset($district['pinyin']) ? implode('', $district['pinyin']) : null,
                'zonecode' => $district['id'],
                'fid' => $district['fid']
            ]);
        }

        return 0;
    }
}
