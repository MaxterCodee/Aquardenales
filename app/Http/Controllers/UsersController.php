<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    // Mostrar la lista de usuarios
    public function index()
    {
        $roles = Role::all();
        $users = User::all();
        return view('users.index', compact('users', 'roles'));
    }

    // Mostrar el formulario para crear un nuevo usuario
    public function create()
    {
        return view('users.create');
    }

    // Almacenar un nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_name' => 'required|string|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //asignar rol spatie
        $user->assignRole($request->role_name);


        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    // Mostrar un usuario específico
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Mostrar el formulario para editar un usuario
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Actualizar un usuario específico
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role_name' => 'required|string|exists:roles,name',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if ($user->hasRole($request->role_name)) {
            $user->assignRole($request->role_name);
        }

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Eliminar un usuario específico
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
