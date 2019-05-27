<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $filter = [['type','=',User::DEFAULT_TYPE]];
        if (!empty($_GET['submit'])) {
            if (!empty($_GET['nama'])) 
                $filter[] = ['name', 'like', '%'.$_GET['nama'].'%'];

            if (!empty($_GET['jurusan'])) 
                $filter[] =  ['department', '=', $_GET['jurusan']];

            if (!empty($_GET['status']))
                $filter[] = ['status', '=', $_GET['status']];

            if (!empty($_GET['tahun']))
                $filter[] = ['grad', '=', $_GET['tahun']];

        } elseif (!empty($_GET['nama'])) {
            $filter[] = ['name', 'like', '%'.$_GET['nama'].'%'];
        }

        $users = $model->where($filter)->paginate(15);
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::find($id);

        if ($user->isDataComplete()) {
            return view('users.show', ['user' => $user]);
        }

        return abort(503, 'Invalid user data');
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        // $user = array_push([
            // 'departments' => \App\Department::all(),
            // 'statuses' => \App\Status::all(),
        // ], $user);
        return view('users.edit', ['user' => $user,
            'departments' => \App\Department::all(),
            'statuses' => \App\Status::all(),
        ]);
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
            ->except(
                [$request->get('password') ? '' : 'password']
            )
        );

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User  $user)
    {
        $user->delete();

        return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
    }
}
