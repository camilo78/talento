<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\DepartmentRequest;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('department.list', [
            'title' => 'Departments',
            'departments' => Department::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('department.create', [
            'title' => __('Nuevo Departamento'),
            'create'=> '1',
            //'users_r' => User::orderBy('name', 'asc')->whereNull('boss')->get(),
            //'users_m' => User::orderBy('name', 'asc')->whereNull('department_id')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {

        $department = new Department();
        $department->name = $request->input('name');
        $department->save();

        Alert::toast('Ahora debes asignarle un jefe y agregar los miembros','info');
        return to_intended_route('department.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('department.edit', [
            'title' => __('Editar Departamento'),
            'users' => User::orderBy('name', 'desc')->get(),
            'department' => $department,
            'users_m' => User::whereDoesntHave('departments')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department)
    {
         //dd($request->users_m);
        $department->user_id = $request->user_id;
        $department->name = $request->name;
        $department->save();
        $users_id = $request->users_m;
        $department->users()->attach($users_id);

        Alert::toast('El departamento ha sido actualizado correctamente','success');


        //dd($department->id);
        // $user = User::find($request->input('user_id'));
        //dd($request->input('user_id'));
        // $user->department_id = $department->id;

        //$department->name = $request->name;
        // $department->name = $request->name;

        // $department->save();
        // $user->save();

        return redirect()->route('department.edit', $department->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
