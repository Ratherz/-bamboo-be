<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $users = User::where('email', 'LIKE', "%$keyword%")
                ->orWhere('email_verified_at', 'LIKE', "%$keyword%")
                ->orWhere('password', 'LIKE', "%$keyword%")
                ->orWhere('remember_token', 'LIKE', "%$keyword%")
                ->orWhere('activate', 'LIKE', "%$keyword%")
                ->orWhere('file_image', 'LIKE', "%$keyword%")
                ->orWhere('first_name', 'LIKE', "%$keyword%")
                ->orWhere('last_name', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('address_no', 'LIKE', "%$keyword%")
                ->orWhere('zoi', 'LIKE', "%$keyword%")
                ->orWhere('road', 'LIKE', "%$keyword%")
                ->orWhere('district', 'LIKE', "%$keyword%")
                ->orWhere('amphure', 'LIKE', "%$keyword%")
                ->orWhere('province', 'LIKE', "%$keyword%")
                ->orWhere('zip', 'LIKE', "%$keyword%")
                ->orWhere('firebase_uid', 'LIKE', "%$keyword%")
                ->orWhere('shop_name', 'LIKE', "%$keyword%")
                ->orWhere('lat', 'LIKE', "%$keyword%")
                ->orWhere('lng', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $users = User::latest()->paginate($perPage);
        }
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'max:255|required',
            'password' => 'max:255|required'
        ]);
        $requestData = $request->all();
        $hash = password_hash($requestData['password'], PASSWORD_BCRYPT);
        $requestData['password'] = $hash;
        $user = User::create($requestData);
        if (!empty($request->Roles)) {
            $roles = $request->Roles;
            $user->clearRoles();
            foreach ($roles as $role) {
                $user->assignRole($role);
            }
        }
        return redirect('users')->with('flash_message', 'User added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'username' => 'max:255|required',
            'password' => 'max:255|required'
        ]);

        $requestData = $request->all();
        $user = User::findOrFail($id);
        if ($user->password != $requestData['password']) {
            $hash = password_hash($requestData['password'], PASSWORD_BCRYPT);
            $requestData['password'] = $hash;
        }

        if (!empty($request->Roles)) {
            $roles = $request->Roles;
            $user->clearRoles();
            foreach ($roles as $role) {
                $user->assignRole($role);
            }
        }

        $user->update($requestData);

        return redirect('users')->with('flash_message', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect('users')->with('flash_message', 'User deleted!');
    }
}
