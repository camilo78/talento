<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\DepartmentRequest;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

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
            'users_r' => User::orderBy('name', 'asc')->get(),
            'users_m' => User::orderBy('name', 'asc')->get(),
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

        Alert::toast('El usuario ha sido creado correctamente','success');
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
            'users' => User::orderBy('name', 'asc')->get(),
            'department' => $department
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        $department->name = $request->name;
        $department->user_id = $request->user_id;
        $department->save();

        return redirect()->route('department.edit', $department->id)->with('message', __("Department updated successfully!"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
