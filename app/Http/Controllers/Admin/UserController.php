<?php

namespace App\Http\Controllers\Admin;


use App\Repositories\Contracts\UserGroupRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UserController extends BaseController
{
    protected $userRepository;
    protected $groupRepository;

    public function __construct(Request $request,
                                UserRepositoryInterface $userRepository,
                                UserGroupRepositoryInterface $groupRepository)
    {
        parent::__construct($request);
        $this->userRepository = $userRepository;
        $this->groupRepository = $groupRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        return $this->view('admin.user');

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $this->userRepository->whereKey($request->input('users', []))->delete();
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {

        $uid = $request->input('uid');
        $user = $this->userRepository->findOrFail($uid);
        $userGroups = $this->groupRepository->getUserGroups();
        $systemGroups = $this->groupRepository->getSystemGroups();

        return $this->view('admin.user.edit', compact('uid', 'user', 'userGroups', 'systemGroups'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $this->userRepository->whereKey($request->input('uid'))->update($request->input('user', []));
        return $this->messager()->setMessage(trans('sysmessage.info update success'))->render();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchUpdate(Request $request)
    {

        $users = $request->input('users', []);
        $data = Arr::only($request->all(), ['state']);
        $this->userRepository->whereKey($users)->update($data);
        return ajaxReturn();
    }
}
