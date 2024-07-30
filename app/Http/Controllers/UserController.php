<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

// TODO makeAdmin, revokeAdmin, index, update e destroy seriam melhores se as permissões fossem controladas diretamente nas rotas usando middlewares ou em Gate::authorize internamente na função?

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('list-users', Auth::user());

        $query = User::query();
        $query->whereNot('id', '=', AUth::user()->id);

        $users = $query->get();

        return view('pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed']
        ]);

        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']),
        ]);

        auth()->login($user);

        return redirect('/posts')->with('success', 'User created succesfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed'],
        ]);

        $user->name = $credentials['name'];
        $user->email = $credentials['email'];

        if ($request->filled('password')) {
            $user->password = bcrypt($credentials['password']);
        }

        $user->save();

        return redirect()->route('users.show', ['id' => $user->id])
            ->with('success', 'User updated succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Gate::authorize('remove-users', Auth::user());

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User removed succesfully!');
    }

    public function makeAdmin(User $user)
    {
        Gate::authorize('make-admin', Auth::user());

        $user->admin = true;
        $user->save();

        return redirect()->route('users.index', ['id' => $user->id])
            ->with('success', 'User updated as admin succesfully!');
    }

    public function revokeAdmin(User $user)
    {
        Gate::authorize('revoke-admin', Auth::user());

        if ($user->id == Auth::user()->id) {
            return redirect()->route('users.index')->withErrors('User can\'t revoke itself as admin!');
        }

        $user->admin = false;
        $user->save();

        return redirect()->route('users.index', ['id' => $user->id])
            ->with('success', 'User updated as admin succesfully!');
    }
}
