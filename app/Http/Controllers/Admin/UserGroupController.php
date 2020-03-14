<?php

namespace App\Http\Controllers\Admin;


use App\Repositories\Contracts\UserGroupRepositoryInterface;
use Illuminate\Http\Request;

class UserGroupController extends BaseController
{
    protected function groupRepository(){
        return app(UserGroupRepositoryInterface::class);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $userGroups = $this->groupRepository()->getUserGroups();
        $systemGroups = $this->groupRepository()->getSystemGroups();
        return $this->view('admin.user.group', compact('systemGroups', 'userGroups'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function batchUpdate(Request $request)
    {
        $delete = $request->post('delete', []);
        if ($delete) {
            $this->groupRepository()->whereKey($delete)->delete();
        }

        $groups = $request->post('groups', []);
        if ($groups) {
            foreach ($groups as $gid => $group) {
                if ($group['title']) {
                    if ($gid > 0) {
                        $this->groupRepository()->whereKey($gid)->update($group);
                    } else {
                        $this->groupRepository()->create($group);
                    }
                }
            }
        }
        return $this->messager()->render();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function privilege(Request $request)
    {
        $gid = $request->input('gid', 0);
        $group = $this->groupRepository()->findOrFail($gid);
        $group->privileges = $group->privileges ? $group->privileges : [];
        $privileges = trans('admin.privileges');
        return $this->view('admin.user.privilege', compact('gid', 'group', 'privileges'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function savePrivilege(Request $request)
    {
        $gid = $request->input('gid', 0);
        $privileges = $request->input('privileges', []);
        $this->groupRepository()->whereKey($gid)->update(['privileges' => $privileges]);
        return $this->messager()->render();
    }
}
