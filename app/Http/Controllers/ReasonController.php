<?php

namespace App\Http\Controllers;

use App\Models\Reason;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class ReasonController extends Controller
{
    /**
     * Muestra una lista de todas las razones.
     */
    public function index()
    {
        // Obtiene todas las razones de la base de datos
        $reasons = Reason::all();

        // Retorna la vista del listado de razones
        return view('reasons.index', compact('reasons'));
    }

    /**
     * Muestra el formulario para crear una nueva razón.
     */
    public function create()
    {
        // Retorna la vista para crear una nueva razón
        return view('reasons.create');
    }

    /**
     * Almacena una nueva razón en la base de datos.
     */
    public function store(Request $request)
    {
        // Valida los datos del formulario
        $rules = [
            'reason' => 'required|string|max:255',
            'proof' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'max_days' => 'nullable|integer|min:0',
            'max_working_days' => 'nullable|integer|min:0',
        ];

        $messages = [
            'reason.required' => 'El campo razón es obligatorio.',
            'reason.string' => 'El campo razón debe ser una cadena de texto.',
            'reason.max' => 'El campo razón no puede ser mayor a :max caracteres.',
            'proof.required' => 'El campo justificación es obligatorio.',
            'proof.string' => 'El campo justificación debe ser una cadena de texto.',
            'proof.max' => 'El campo justificación no puede ser mayor a :max caracteres.',
            'type.required' => 'El campo tipo es obligatorio.',
            'type.string' => 'El campo tipo debe ser una cadena de texto.',
            'type.max' => 'El campo tipo no puede ser mayor a :max caracteres.',
            'max_days.integer' => 'El campo días máximos debe ser un número entero.',
            'max_days.min' => 'El campo días máximos debe ser mayor o igual a 0.',
            'max_working_days.integer' => 'El campo días laborables máximos debe ser un número entero.',
            'max_working_days.min' => 'El campo días laborables máximos debe ser mayor o igual a 0.',
        ];

        $validated = $this->validate($request, $rules, $messages);

        // Crea una nueva razón con los datos validados
        Reason::create($validated);

        Alert::toast('Razón creada exitosamente.', 'success');

        // Redirecciona al índice de razones con un mensaje de éxito
        return redirect()->route('reasons.index');
    }

    /**
     * Muestra el formulario para editar una razón existente.
     */
    public function edit(Reason $reason)
    {
        // Retorna la vista de edición con la razón seleccionada
        return view('reasons.edit', compact('reason'));
    }

    /**
     * Actualiza una razón existente en la base de datos.
     */
    public function update(Request $request, Reason $reason)
    {
        // Valida los datos del formulario
        $rules = [
            'reason' => 'required|string|max:255',
            'proof' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'max_days' => 'nullable|integer|min:0',
            'max_working_days' => 'nullable|integer|min:0',
        ];

        $messages = [
            'reason.required' => 'El campo razón es obligatorio.',
            'reason.string' => 'El campo razón debe ser una cadena de texto.',
            'reason.max' => 'El campo razón no puede ser mayor a :max caracteres.',
            'proof.required' => 'El campo justificación es obligatorio.',
            'proof.string' => 'El campo justificación debe ser una cadena de texto.',
            'proof.max' => 'El campo justificación no puede ser mayor a :max caracteres.',
            'type.required' => 'El campo tipo es obligatorio.',
            'type.string' => 'El campo tipo debe ser una cadena de texto.',
            'type.max' => 'El campo tipo no puede ser mayor a :max caracteres.',
            'max_days.integer' => 'El campo días máximos debe ser un número entero.',
            'max_days.min' => 'El campo días máximos debe ser mayor o igual a 0.',
            'max_working_days.integer' => 'El campo días laborables máximos debe ser un número entero.',
            'max_working_days.min' => 'El campo días laborables máximos debe ser mayor o igual a 0.',
        ];

        $validated = $this->validate($request, $rules, $messages);
        // Actualiza la razón con los nuevos datos
        $reason->update($validated);

        Alert::toast('Razón actualizada exitosamente.', 'success');

        // Redirecciona al índice de razones con un mensaje de éxito
        return redirect()->route('reasons.edit', $reason->id);
    }

    /**
     * Elimina una razón de la base de datos.
     */
    public function destroy(Reason $reason)
    {
        // Elimina la razón
        $reason->delete();
        Alert::toast('Razón eliminada exitosamente.', 'success');
        // Redirecciona al índice de razones con un mensaje de éxito
        return redirect()->route('reasons.index');
    }
}
