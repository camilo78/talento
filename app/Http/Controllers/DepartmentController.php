<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\AddDepartmentRequest;
use App\Http\Requests\UpdateDepartmetRequest;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

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
            'departments' => Department::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('department.create', [
            'title' => __('Nuevo Departamento'),
            'departments' => Department::get(),  // Obtén todos los departamentos

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddDepartmentRequest $request)
    {

        $department = new Department();
        $department->name = $request->input('name');
        $department->parent_id = $request->input('parent_id');
        $department->save();

        Alert::toast('Ahora debes agregar los miembros y asignar un jefe para esta Unidad O departamento ', 'info');
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
        $departmentId = $department->id;
        confirmDelete($title, $text);
        return view('department.edit', [
            'title' => __('Editar Departamento'),
            'users' => User::orderBy('name', 'desc')->get(),
            // 'users_m' => User::has('departments', '<', 2)->get(),
            'users_m' =>   User::has('departments', '<', 2) // Asegura que el usuario esté relacionado con como máximo 2 departamentos
                ->whereDoesntHave('departments', function ($query) use ($departmentId) {
                    $query->where('department_id', $departmentId); // Excluye si el usuario está relacionado con el departamento de ID específico
                })
                ->get(),
            'departments' => Department::get(),  // Obtén todos los departamentos
            'department' => $department,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmetRequest $request, Department $department)
    {

        $user_id = $request->user_id;
        $jefeAsignado = Department::where('user_id', $user_id)->first();

        // Verificar si el usuario ya es jefe en otro departamento
        if ($jefeAsignado && $jefeAsignado->id != $department->id && $request->user_id) {
            Alert::toast('El usuario ya es jefe de otro departamento, por lo que debe buscar otro miembro de esta sala o departamento', 'warning');
        } else {
            // Si el usuario es jefe del mismo departamento o no es jefe en otro departamento
            $department->user_id = $user_id;
            $department->name = $request->name;
            $department->save();
            // Verifica cuántos departamentos ya tiene asignado el usuario
            $userDepartmentsCount = DB::table('user_department')
                ->where('user_id', $request->user_id)
                ->count();

            // Si ya tiene dos departamentos, se rechaza la petición
            if ($userDepartmentsCount >= 2) {
                return back()->withErrors(['user_id' => 'El usuario no puede estar asignado a más de dos departamentos.']);
            }
            // Asociar usuarios al departamento
            $users_id = $request->users_m;
            $department->users()->attach($users_id); // Usar sync para evitar duplicados

            Alert::toast('El departamento ha sido actualizado correctamente', 'success');
        }


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
