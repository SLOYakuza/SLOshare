<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\Group;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * @see \Tests\Feature\Http\Controllers\Staff\GroupControllerTest
 */
class GroupController extends Controller
{
    /**
     * Display All Groups.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $groups = Group::all()->sortBy('position');

        return \view('Staff.group.index', ['groups' => $groups]);
    }

    /**
     * Group Add Form.
     */
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('Staff.group.create');
    }

    /**
     * Store A New Group.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $group = new Group();
        $group->name = $request->input('name');
        $group->slug = Str::slug($request->input('name'));
        $group->position = $request->input('position');
        $group->level = $request->input('level');
        $group->download_slots = $request->input('download_slots');
        $group->color = $request->input('color');
        $group->icon = $request->input('icon');
        $group->effect = $request->input('effect');
        $group->is_internal = $request->input('is_internal');
        $group->is_modo = $request->input('is_modo');
        $group->is_admin = $request->input('is_admin');
        $group->is_owner = $request->input('is_owner');
        $group->is_trusted = $request->input('is_trusted');
        $group->is_immune = $request->input('is_immune');
        $group->is_freeleech = $request->input('is_freeleech');
        $group->is_double_upload = $request->input('is_double_upload');
        $group->is_incognito = $request->input('is_incognito');
        $group->can_upload = $request->input('can_upload');
        $group->autogroup = $request->input('autogroup');

        $v = \validator($group->toArray(), [
            'name'     => 'required|unique:groups',
            'slug'     => 'required|unique:groups',
            'position' => 'required',
            'color'    => 'required',
            'icon'     => 'required',
        ]);

        if (! $request->user()->group->is_owner && $request->input('is_owner') == 1) {
            return \to_route('staff.groups.index')
                ->withErrors('Nimate dovoljenja za ustvarjanje skupine z lastniškimi dovoljenji!');
        }

        if ($v->fails()) {
            return \to_route('staff.groups.index')
                ->withErrors($v->errors());
        }

        $group->save();
        foreach (Forum::all()->pluck('id') as $collection) {
            $permission = new Permission();
            $permission->forum_id = $collection;
            $permission->group_id = $group->id;
            $permission->show_forum = 1;
            $permission->read_topic = 1;
            $permission->reply_topic = 1;
            $permission->start_topic = 1;
            $permission->save();
        }

        return \to_route('staff.groups.index')
            ->withSuccess('Skupina je bila uspešno ustvarjena!');
    }

    /**
     * Group Edit Form.
     */
    public function edit(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $group = Group::findOrFail($id);

        return \view('Staff.group.edit', ['group' => $group]);
    }

    /**
     * Edit A Group.
     */
    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $group = Group::findOrFail($id);

        $group->name = $request->input('name');
        $group->slug = Str::slug($request->input('name'));
        $group->position = $request->input('position');
        $group->level = $request->input('level');
        $group->download_slots = $request->input('download_slots');
        $group->color = $request->input('color');
        $group->icon = $request->input('icon');
        $group->effect = $request->input('effect');
        $group->is_internal = $request->input('is_internal');
        $group->is_modo = $request->input('is_modo');
        $group->is_admin = $request->input('is_admin');
        $group->is_owner = $request->input('is_owner');
        $group->is_trusted = $request->input('is_trusted');
        $group->is_immune = $request->input('is_immune');
        $group->is_freeleech = $request->input('is_freeleech');
        $group->is_double_upload = $request->input('is_double_upload');
        $group->is_incognito = $request->input('is_incognito');
        $group->can_upload = $request->input('can_upload');
        $group->autogroup = $request->input('autogroup');

        $v = \validator($group->toArray(), [
            'name'     => 'required',
            'slug'     => 'required',
            'position' => 'required',
            'color'    => 'required',
            'icon'     => 'required',
        ]);

        if (! $request->user()->group->is_owner && $request->input('is_owner') == 1) {
            return \to_route('staff.groups.index')
                ->withErrors('Lastniku skupine ne smete dati dovoljenj!');
        }

        if ($v->fails()) {
            return \to_route('staff.groups.index')
                ->withErrors($v->errors());
        }

        $group->save();

        \cache()->forget('group:'.$group->id);

        return \to_route('staff.groups.index')
            ->withSuccess('Skupina je bila uspešno posodobljena!');
    }
}
