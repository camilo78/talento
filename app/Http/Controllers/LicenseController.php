<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\Reason;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Eliminar Licencia';
        $text = "¿Seguro quieres eliminar esa lincencia?, esta acción no puede recuperarse.";
        confirmDelete($title, $text);

        return view('license.list', [
            'title' => 'Licencias o Permisos',
            'licenses' => License::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('license.create', [
            'title' => __('Nueva Licencia'),
            'users' => User::whereHas('departments')->get(),
            'reasons_r' => Reason::where('type' , 'Remunerada')->get(),
            'reasons_n' => Reason::where('type' , 'No Remunerada')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $license = User::create($request->validated());
        Alert::toast('La licencia ha sido creada correctamente', 'success');
        return redirect()->route('license.index');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getUserDepartment($id)
    {
        // Encuentra el usuario por su ID
        $user = User::findOrFail($id);

        // Cargar el departamento del usuario si existe
        $department = $user->departments()->get()
        ->where('user_id', '!=', $user->id) // Aquí se asegura que no sea jefe
        ->first(); // Obtener solo el primer departamento que cumpla con la condición
        if (!$department) {
            $department = $user->departments()->first();
        }
        $jefe = User::findOrFail($department->user_id);

        // Cargar el departamento del jefe si existe
        $department_j = $jefe->departments()->get()
        ->where('user_id', '!=', $jefe->id) // Aquí se asegura que no sea jefe
        ->first(); // Obtener solo el primer departamento que cumpla con la condición
        if (!$department_j) {
            $department_j = $jefe->departments()->first();
        }
        $jefe_j = User::findOrFail($department_j->user_id);

        // Retornar el departamento y el jefe
        return response()->json([
            'department' => $department,
            'jefe' => $jefe,
            'department_j' => $department_j,
            'jefe_j' => $jefe_j,
        ]);

    }
    public function getProof($id)
    {
        $reason =  Reason::find($id);

        if ($reason) {
            return response()->json($reason);
        }

        return response()->json(['error' => 'Reason not found'], 404);
    }
}
