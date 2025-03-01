<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Department;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Eliminar Usuario';
        $text = "¿Seguro quieres eliminar este usuario?, esta acción no puede recuperarse.";
        confirmDelete($title, $text);

        return view('user.list', [
            'title' => 'Usuarios',
            'users' => User::with('departments')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create', [
            'title' => __('Nuevo Usuario'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request)
    {
        $user = User::create($request->validated() + ['password' => Hash::make($request->password)]);
        $user->departments()->attach($request->department_id);

        Alert::toast('El usuario ha sido creado correctamente', 'success');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('user.show', ['user' => User::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', [
            'title' => 'Editar Usuario',
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        $data['password'] = $request->filled('password') ? Hash::make($request->password) : $user->password;

        $user->update($data);
        $user->departments()->sync($request->department_id);

        Alert::toast('El usuario ha sido actualizado correctamente', 'success');
        return redirect()->route('user.edit', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Auth::id() == $user->id) {
            Alert::toast('No puedes borrarte a ti mismo', 'info');
        } elseif ($user->departments()->exists()) {
            Alert::toast('No se puede eliminar el usuario porque está relacionado con uno o más departamentos o salas.', 'info');
        } else {
            $user->delete();
            Alert::toast('El usuario ha sido eliminado correctamente', 'success');
        }
        return redirect()->route('user.index');
    }

    /**
     * Detach a user from a department.
     *
     * @param  User  $user
     * @param  Department  $department
     * @return \Illuminate\Http\Response
     */
    public function detachDepartment(User $user, Department $department)
    {
        $department->users()->detach($user->id);
        if ($department->user_id == $user->id) {
            $department->update(['user_id' => null]);
        }

        Alert::toast('El usuario ha sido desvinculado correctamente del departamento', 'success');
        return redirect()->route('department.edit', $department->id);
    }

    /**
     * Search users by name or DNI.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchUsers(Request $request)
    {
        $query = $request->input('query');

        $users = User::when($query, function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
              ->orWhere('dni', 'LIKE', "%{$query}%");
        })->get();

        return response()->json($users);
    }
}
