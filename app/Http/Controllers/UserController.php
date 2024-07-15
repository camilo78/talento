<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.list', [
            'title' => 'Usuarios',
            'users' => User::all()
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

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dni' => $request->dni,
            'functional' => $request->functional,
            'nominal' => $request->nominal,
            'type' => $request->type,
            'gender' => $request->gender,

        ]);
        $user->departments()->attach($request->department_id);

        Alert::toast('El usuario ha sido creado correctamente','success');
        return to_intended_route('user.index');
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
    public function update(EditUserRequest $request, User $user)
    {


        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->dni = $request->dni;
        $user->functional = $request->functional;
        $user->nominal = $request->nominal;
        $user->type = $request->type;
        $user->gender = $request->gender;
        $user->departments()->attach($request->department_id);

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

        if (Auth::id() == $user->getKey()) {
            Alert::toast('No puedes borrarte a ti mismo', 'info');
            return redirect()->route('user.index');
        }else{
            $user->delete();
            Alert::toast('El usuario ha sido creado correctamente', 'success');

        }
        return to_intended_route('user.index');
    }
}
