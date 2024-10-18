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
    public function index(User $user)
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
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->dni = $request->dni;
        $user->rtn = $request->rtn;
        $user->functional = $request->functional;
        $user->nominal = $request->nominal;
        $user->type = $request->type;
        $user->profession_id = $request->profession_id;
        $user->gender = $request->gender;
        $user->departments()->sync($request->department_id);

        if ($user->save()) {
            Alert::toast('El usuario ha sido actualizado correctamente','success');
        }

        return redirect()->route('user.edit', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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

    public function detachDepartment(User $user, Department $department)
    {
        // Desvincula al usuario del departamento
        $department->users()->detach($user->id);
        if ($department->user_id ==  $user->id) {
            $department->user_id = null;
            $department->save();
        }
        // Redirige o muestra un mensaje de éxito
        Alert::toast('El usuario ha sido desvinculado correctamente del departamento', 'success');
        return redirect()->route('department.edit', $department->id);
    }
    public function searchUsers(Request $request)
{
    $query = $request->input('query'); // Get the search query from the input

    // Query to search users by name or email
    $users = User::where('name', 'LIKE', "%{$query}%")
                 ->orWhere('dni', 'LIKE', "%{$query}%")
                 ->get();

    // Return results as JSON
    return response()->json($users);
}

}
