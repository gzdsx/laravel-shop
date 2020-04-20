<?php

namespace App\Http\Controllers\Api;


use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends BaseController
{

    /**
     * @return UserRepositoryInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function userRepository(){
        return app(UserRepositoryInterface::class);
    }
    public function get(Request $request){
        return ajaxReturn(['user'=>$this->userRepository()->query()->with('group')->find($request->input('uid'))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request){

        $query = $this->userRepository()->query()->filter($request->all())->with('group');
        return ajaxReturn([
            'total'=>$query->count(),
            'items'=>$query->offset($request->input('offset',0))->limit(15)->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request){
        $this->userRepository()->query()->whereKey($request->input('items',[]))->get()->map(function (User $user){
            if ($user->uid != 1000000) $user->delete();
        });
        return ajaxReturn();
    }
}
