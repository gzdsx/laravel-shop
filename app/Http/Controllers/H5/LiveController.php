<?php

namespace App\Http\Controllers\H5;


use App\Models\Live;
use App\Models\LiveInvite;
use PDF;
use Barryvdh\Snappy\Facades\SnappyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class LiveController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return $this->view('h5.live.index');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request, $id)
    {
        return $this->view('h5.live.detail', compact('id'));
    }

    public function poster(Request $request, $id)
    {
        $live = Live::find($id);
        $poster = Image::make(asset('images/poster.png'));
        //绘制背景
        $bg = Image::canvas(140, 140);

        $avatar = Image::make(Auth::user()->avatar);
        $avatar->resize(120, 120);
        $r = $avatar->width() / 2;

        for ($x = 0; $x < $avatar->width(); $x++) {
            for ($y = 0; $y < $avatar->height(); $y++) {
                if (((($x - $r) * ($x - $r) + ($y - $r) * ($y - $r)) < ($r * $r))) {
                    $c = $avatar->pickColor($x, $y);
                    $bg->pixel($c, $x + 10, $y + 10);
                }
            }
        }

        $bg->circle(120, 70, 70, function ($draw) {
            $draw->border(5, '#fff');
        });
        $poster->insert($bg, 'left-top', 38, 50);

        $x = $poster->width() - mb_strlen(Auth::user()->username) * 40 - 40;
        $poster->text(Auth::user()->username, $x, 110, function ($font) {
            $font->file(public_path('fonts/fzzyt.ttf'));
            $font->size(40);
            $font->color('#fff');
            $font->align('left');
        });

        $x = $poster->width() - 28 * 9 - 40;
        $poster->text('邀请您来一起看直播', $x, 150, function ($font) {
            $font->file(public_path('fonts/fzzyt.ttf'));
            $font->size(28);
            $font->color('#fff');
            $font->align('left');
        });

        if (mb_strlen($live->title) > 12) {
            $str = mbsubstr($live->title, 24);
            $arr = mb_str_split($str);
            $text = implode('', array_slice($arr, 0, 12)) . "\n" . implode('', array_slice($arr, 12));
        } else {
            $text = $live->title;
        }

        $poster->text($text, $poster->width() / 2, 420, function ($font) {
            $font->file(public_path('fonts/fzzyt.ttf'));
            $font->size(42);
            $font->color('#8A1F1C');
            $font->align('center');
        });

        $time = $live->start_at->format('Y年m月d日 H:i') . ' ' . $live->start_at->dayName;
        $poster->text("开播时间 " . $time, $poster->width() / 2, 600, function ($font) {
            $font->file(public_path('fonts/fzzyt.ttf'));
            $font->size(28);
            $font->color('#8A1F1C');
            $font->align('center');
        });

        $qrcode = Image::make(setting('wechat_qrcode'));
        $qrcode->fit(140);
        $poster->insert($qrcode, 'bottom-center', 0, 400);


        $poster->text("长按识别 立即观看", $poster->width() / 2, $poster->height() - 360, function ($font) {
            $font->file(public_path('fonts/fzzyt.ttf'));
            $font->size(24);
            $font->color('#8A1F1C');
            $font->align('center');
        });

        return $poster->response();
    }

    public function invite(Request $request, $code)
    {
        $invite = LiveInvite::where('code', $code)->first();
        if (!$invite) {
            abort(403, '邀请链接已失效');
        }

        if ($invite->user) {
            abort(403, '邀请链接已失效');
        }

        if (!$invite->live) {
            abort(403, '邀请链接已失效');
        }

        if (!LiveInvite::where(['live_id' => $invite->live_id, 'uid' => Auth::id()])->first()) {
            $invite->uid = Auth::id();
            $invite->save();
        }

        return redirect($invite->live->m_url);
    }
}
