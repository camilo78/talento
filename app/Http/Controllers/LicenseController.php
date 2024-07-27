<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;
use App\Http\Requests\StorelicenseRequest;
use App\Http\Requests\UpdatelicenseRequest;
use App\Models\User;
use App\Models\Department;
use RealRashid\SweetAlert\Facades\Alert;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Eliminar Permiso';
        $text = "¿Seguro quieres eliminar este Permiso?, esta acción no puede recuperarse.";
        confirmDelete($title, $text);
        return view('license.list', [
            'title' => 'Permisos',
            'licenses' => License::orderBy('user_id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('license.create', [
            'title' => 'Nuevo Permiso',
            'departments' => [],
            'users' => User::has('departments')->orderBy('name', 'desc')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorelicenseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(license $license)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(license $license)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatelicenseRequest $request, license $license)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(license $license)
    {
        //
    }


    public function getDepartments(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::find($userId);

        if ($user) {
            $departments = $user->departments;
            return response()->json(['departments' => $departments]);
        }
        return response()->json(['departments' => []]);
    }

    public function getUser(Request $request)
    {
        $departmentId = $request->input('department_id');
        $department = Department::find($departmentId);

        if ($department) {
            $user = $department->user;
            return response()->json(['user_name' => $user->name]);
        }

        return response()->json(['user_name' => 'Selecione un solicitante de permiso']);
    }

}
