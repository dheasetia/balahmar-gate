<?php

namespace App\Http\Controllers;

use App\Group;
use App\GroupUser;
use App\Http\Requests\GroupPostRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Libraries\Helpers;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Http\Request;

class AdminGroupController extends Controller
{
    public function __construct()
    {
        Helpers::setCurrentPage('admin-users-groups');
    }

    public function index()
    {
        $groups = Group::all();
        return view('admin.groups.admin_group_index', compact('groups'));
    }

    public function store(GroupPostRequest $request)
    {
        $group = new Group();
        $group->name = $request->name;
        $group->slug = str_slug($request->name);
        $group->is_active = 1;
        $group->save();
        Toastr::success('تم إنشاء المجموعة', 'مجموعات');
        return redirect(url('admin/groups'));
    }

    public function show($id)
    {
        $group = Group::findOrFail($id);
        $users = EloquentUser::all();
        $members_id = $group->users->pluck('id');
        return view('admin.groups.admin_group_show', compact('group', 'users', 'members_id'));
    }
    public function edit($id)
    {
        $group = Group::findOrFail($id);
        $users = EloquentUser::all();
        $members_id = $group->users->pluck('id');
        return view('admin.groups.admin_group_edit', compact('group', 'users', 'members_id'));
    }

    public function update(GroupUpdateRequest $request, $id)
    {
        $group = Group::findOrFail($id);
        $group->name = $request->name;
        $group->slug = str_slug($request->name);
        $group->save();
        if (count($request->recipients) > 0) {
            foreach ($group->users as $user) {
                $group->users()->detach($user);
            }

            foreach ($request->recipients as $recipient) {
                $user = User::find($recipient);
                $group->users()->attach($user);
            }
        }
        Toastr::success('تم تعديل المجموعة', 'مجموعات');
        return redirect(url('admin/groups', $group->id));
    }
}
