<?php

namespace App\Http\Controllers\Admin;


use App\Repositories\Contracts\DistrictRepositoryInterface;
use App\Support\Pinyin;
use Illuminate\Http\Request;

class DistrictController extends BaseController
{
    protected $districtRepository;

    public function __construct(Request $request, DistrictRepositoryInterface $districtRepository)
    {
        parent::__construct($request);
        $this->districtRepository = $districtRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index(Request $request)
    {

        $city = $request->input('city', 0);
        $district = $request->input('district', 0);

        $citylist = $districtlist = $items = [];
        $provincelist = $this->districtRepository->where('fid', 0)
            ->orderBy('displayorder')
            ->orderBy('id')->get();
        $items = $provincelist;

        $province = $request->input('province', 0);
        if ($province) {
            $citylist = $this->districtRepository->where('fid', $province)
                ->orderBy('displayorder')
                ->orderBy('id')
                ->get();
            $items = $citylist;
        }

        if ($city) {
            $districtlist = $this->districtRepository->where('fid', $city)
                ->orderBy('displayorder')
                ->orderBy('id')
                ->get();
            $items = $districtlist;
        }

        if ($district) {
            $items = $this->districtRepository->where('fid', $district)
                ->orderBy('displayorder')
                ->orderBy('id')
                ->get();
        }

        return $this->view('admin.common.district', compact('province', 'city', 'district', 'provincelist', 'citylist', 'districtlist', 'items'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $delete = $request->input('delete', []);
        if ($delete) $this->districtRepository->whereKey($delete)->delete();

        $items = $request->input('items', []);

        $pinyin = new Pinyin();
        foreach ($items as $id => $item) {
            if ($item['name']) {
                if (!$item['letter']) {
                    $item['letter'] = $pinyin->getFirstChar($item['name']);
                }

                if (!$item['pinyin']) {
                    $item['pinyin'] = $pinyin->getPinyin($item['name']);
                }

                if ($id > 0) {
                    $this->districtRepository->whereKey($id)->update($item);
                } else {
                    $this->districtRepository->create($item);
                }
            }
        }

        return $this->messager()->render();
    }
}
