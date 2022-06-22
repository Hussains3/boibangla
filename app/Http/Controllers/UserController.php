<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display all users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('dashboard.users.index', compact('users'));
    }
    /**
     * Display all users
     *
     * @return \Illuminate\Http\Response
     */
    public function adminUser()
    {
        $users = User::role('admin')->latest()->paginate(10);
        return view('dashboard.users.adminuser', compact('users'));
    }
    /**
     * Display all users
     *
     * @return \Illuminate\Http\Response
     */
    public function operator()
    {
        $users = User::role('operator')->latest()->paginate(10);

        return view('dashboard.users.operatoruser', compact('users'));
    }
    /**
     * Display all users
     *
     * @return \Illuminate\Http\Response
     */
    public function publisher()
    {
        $users = User::role('publisher')->latest()->paginate(10);

        return view('dashboard.users.publisheruser', compact('users'));
    }
    /**
     * Display all users
     *
     * @return \Illuminate\Http\Response
     */
    public function affiliator()
    {
        $users = User::role('affiliator')->latest()->paginate(10);

        return view('dashboard.users.affiliator', compact('users'));
    }
    /**
     * Display all users
     *
     * @return \Illuminate\Http\Response
     */
    public function customer()
    {
        $users = User::role('customer')->latest()->paginate(10);

        return view('dashboard.users.customer', compact('users'));
    }

    /**
     * Show form for creating user
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created user
     *
     * @param User $user
     * @param StoreUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, StoreUserRequest $request)
    {


        // return $request;
        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user
        $user->create(array_merge($request->validated(), [
            'password' => 'test',
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
        ]));


        $role = Role::where('name','customer')->get()->first();
        $user->assignRole([$role->id]);

        return redirect()->route('viewUsers')
            ->withSuccess(__('User created successfully.'));
    }

    /**
     * Show user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('dashboard.users.show', [
            'user' => $user
        ]);
    }

    /**
     * Edit user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Update user data
     *
     * @param User $user
     * @param UpdateUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        // return $request;

        // return $request->get('role');
        $user->update($request->validated());

        $user->syncRoles($request->get('role'));

        $editorRole = Auth::user()->roles[0]->name;

        if ($editorRole == 'admin') {
            return redirect()->route('viewUsers')
            ->withSuccess(__('User updated successfully.'));
        }else{
            return redirect()->route('myaccount')
            ->withSuccess(__('Information updated successfully.'));
        }


    }

    /**
     * Delete user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('viewUsers')
            ->withSuccess(__('User deleted successfully.'));
    }
}
