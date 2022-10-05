<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\UserDealer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DealerController extends BaseController
{
    /**
     * @return UserDealer|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return UserDealer::query();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function check()
    {
        $check = UserDealer::where('uid', Auth::id())->exists();
        return jsonSuccess($check);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        $model = $this->repository()->where('uid', $request->input('uid', Auth::id()))->firstOrFail();
        return jsonSuccess($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function poster(Request $request)
    {
        $dealer = $this->repository()->where('uid',Auth::id())->firstOrFail();
        if (!$dealer->poster) {
            $dealer->poster = $this->makePoster();
            $dealer->save();
        }

        return jsonSuccess($dealer->poster);
    }

    /**
     * @return string
     */
    protected function makePoster()
    {

        $user = Auth::user();
        $poster = Image::make(settings('poster_bg'));
        $poster->resize(640, 960);
        //添加头像
        $avatar = $this->drawAvatar($user->avatar);
        //$avatar = Image::make($alliance->image);
        $poster->insert($avatar, 'top-center', 0, 100);
        //添加用户名
        $poster->text($user->username, $poster->width() / 2, 245, function ($font) {
            $font->size(28);
            $font->color('#ffffff');
            $font->align('center');
            $font->file(public_path('fonts/Songti.ttc'));
        });

        $url = url('h5/invite/' . $user->uid);
        $pngCode = QrCode::format('png')->size(150)->margin(1)->generate($url);
        $qrcode = Image::make($pngCode);
        $poster->insert(
            $qrcode,
            settings('poster_code_pos'),
            intval(settings('poster_code_x')),
            intval(settings('poster_code_y'))
        );

        //添加说明
        $y = intval($poster->height() - settings('poster_code_y'));
        $poster->text(settings('poster_text'), $poster->width() / 2, $y + 60, function ($font) {
            $font->size(24);
            $font->color(settings('poster_font_color'));
            $font->align('center');
            $font->file(public_path('fonts/Songti.ttc'));
        });

        if (!is_dir(material_path('poster'))) {
            @mkdir(material_path('poster'), 0777, true);
        }

        $posterImg = 'poster/' . Str::random(40) . '.jpg';
        $poster->save(material_path($posterImg));

        return material_url($posterImg);
    }

    /**
     * @param $avatarUrl
     * @return \Intervention\Image\Image
     */
    protected function drawAvatar($avatarUrl)
    {
        $img = Image::make($avatarUrl)->resize(100, 100);
        $new = Image::canvas(110, 110);
        $r = $new->width() / 2;

        for ($x = 0; $x < $new->width(); $x++) {

            for ($y = 0; $y < $new->height(); $y++) {

                $c = [255, 255, 255, 1];
                if (((($x - $r) * ($x - $r) + ($y - $r) * ($y - $r)) < ($r * $r))) {

                    $new->pixel($c, $x, $y);

                }
            }
        }

        $r = $img->width() / 2;
        for ($x = 0; $x < $img->width(); $x++) {

            for ($y = 0; $y < $img->height(); $y++) {

                $c = $img->pickColor($x, $y, 'array');

                if (((($x - $r) * ($x - $r) + ($y - $r) * ($y - $r)) < ($r * $r))) {

                    $new->pixel($c, $x + 5, $y + 5);

                }
            }
        }

        return $new;
    }
}
