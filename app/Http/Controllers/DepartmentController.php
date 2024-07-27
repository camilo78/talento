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
        $title = 'Eliminar Departamento';
        $text = "¿Seguro quieres eliminar este Departamento?, esta acción no puede recuperarse.";
        confirmDelete($title, $text);
        return view('department.list', [
            'title' => 'Departments',
            'departments' => Department::orderBy('name', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('department.create', [
            'title' => __('Nuevo Departamento'),
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

        Alert::toast('Ahora debes agregar los miembros y asignar un jefe para esta Unidad O departamento ','info');
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
        $title = 'Desvincular Usuario';
        $text = "¿Seguro quieres desvincular este usuario?";
        confirmDelete($title, $text);
        return view('department.edit', [
            'title' => __('Editar Departamento'),
            'users' => User::orderBy('name', 'desc')->get(),
            'users_m' => User::has('departments', '<', 2)->get(),
            'department' => $department,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department)
    {

        $department->user_id = $request->user_id;
        $department->name = $request->name;
        $department->save();
        $users_id = $request->users_m;
        $department->users()->attach($users_id);

        Alert::toast('El departamento ha sido actualizado correctamente','success');
        return redirect()->route('department.edit', $department->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        if ($department->delete()) {
            Alert::toast('El departamento ha sido eliminado correctamente', 'success');
        }
        return to_intended_route('department.index');
    }
}
