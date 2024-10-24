<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;
use App\Http\Requests\AddLicenseRequest;;

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
        $text = "¿Seguro quieres eliminar este Permiso, lincencia?, esta acción no puede recuperarse.";
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
            'reasons_r' => Reason::where('type', 'Remunerado')->get(),
            'reasons_n' => Reason::where('type', 'No Remunerado')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddLicenseRequest $request)
    {
        // Validar los datos del request
        $validatedData = $request->validated();

        // Obtener el motivo de la licencia basado en el 'reason_id' que recibes del request
        $reason = Reason::findOrFail($validatedData['reason_id']);

        // Comparar los días ordinarios con el límite, solo si existe un límite en la base de datos
        if (!is_null($reason->max_days) && $validatedData['days'] >= $reason->max_days) {
            return back()->withErrors(['days' => 'Los días ordinarios exceden el máximo permitido para este motivo.'])->withInput();
        }

        // Comparar los días hábiles con el límite, solo si existe un límite en la base de datos
        if (!is_null($reason->max_working_days) && $validatedData['days_h'] >= $reason->max_working_days) {
            return back()->withErrors(['days_h' => 'Los días hábiles exceden el máximo permitido para este motivo.'])->withInput();
        }

        // Crear la licencia si las validaciones pasan
        License::create($validatedData);
        Alert::toast('Permiso, licencia ha sido creada correctamente', 'success');

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
    public function edit(License $license)
    {

        $jefe = $user = User::findOrFail($license->boss->id);

        // Cargar el departamento del jefe si existe
        $department_j = $jefe->departments()->get()
            ->where('user_id', '!=', $jefe->id) // Aquí se asegura que no sea jefe
            ->first(); // Obtener solo el primer departamento que cumpla con la condición
        if (!$department_j) {
            $department_j = $jefe->departments()->first();
        }
        $jefe_j = User::findOrFail($department_j->user_id);
        // Redirigir al índice de licencias

        return view('license.edit', [
            'title' => __('Editar Licencia'),
            'license' => License::findOrFail($license->id),
            'users' => User::whereHas('departments')->get(),
            'reasons_r' => Reason::where('type', 'Remunerado')->get(),
            'reasons_n' => Reason::where('type', 'No Remunerado')->get(),
            'jefe_j' => $jefe_j,
            'department_j' => $department_j,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddLicenseRequest $request, License $license)
    {
        // Validar los datos del request
        $validatedData = $request->validated();

        // Obtener el motivo de la licencia basado en el 'reason_id' que recibes del request
        $reason = Reason::findOrFail($validatedData['reason_id']);

        // Comparar los días ordinarios con el límite, solo si existe un límite en la base de datos
        if (!is_null($reason->max_days) && $validatedData['days'] >= $reason->max_days) {
            return back()->withErrors(['days' => 'Los días ordinarios exceden el máximo permitido para este motivo.'])->withInput();
        }

        // Comparar los días hábiles con el límite, solo si existe un límite en la base de datos
        if (!is_null($reason->max_working_days) && $validatedData['days_h'] >= $reason->max_working_days) {
            return back()->withErrors(['days_h' => 'Los días hábiles exceden el máximo permitido para este motivo.'])->withInput();
        }
        $license->update($validatedData);

        Alert::toast('Permiso, licencia ha sido actualizada correctamente', 'success');

        return redirect()->route('license.edit', $license->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(License $license)
    {
        $license->delete();

        Alert::toast('Permiso, licencia eliminada exitosamente.', 'success');

        return redirect()->route('license.index');
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
