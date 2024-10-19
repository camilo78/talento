<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use App\Models\Profession;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SpecialtyController extends Controller
{
    public function index()
    {
        $title = 'Eliminar Profesión';
        $text = "¿Seguro quieres eliminar esta profesión?, esta acción no puede recuperarse.";
        confirmDelete($title, $text);

        $specialties = Specialty::with('profession')->get(); // Cargar especialidades con profesiones
        return view('specialties.index', compact('specialties'));
    }

    public function create()
    {
        $professions = Profession::all(); // Obtener todas las profesiones
        return view('specialties.create', compact('professions'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'profession_id' => 'required|exists:professions,id', // Validar que la profesión exista
        ];
        $messages = [
            'name.required' => 'El campo nombre de la especialidad es obligatorio.',
            'name.string' => 'El campo nombre de la especialidad debe ser una cadena de texto.',
            'name.max' => 'El campo nombre de la especialidad no puede ser mayor a :max caracteres.',
            'profession_id.required' => 'El campo profesión es obligatorio.',
            'profession_id.exists:professions,id' => 'El campo profesión debe estar definido.',


        ];
        $validated = $this->validate($request, $rules, $messages);

        Specialty::create($validated);

        Alert::toast('Especialidad creada exitosamente.', 'success');

        return redirect()->route('specialties.index');
    }

    public function edit(Specialty $specialty)
    {
        $professions = Profession::all(); // Obtener todas las profesiones
        return view('specialties.edit', compact('specialty', 'professions'));
    }

    public function update(Request $request, Specialty $specialty)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'profession_id' => 'required|exists:professions,id', // Validar que la profesión exista
        ];
        $messages = [
            'name.required' => 'El campo nombre de la especialidad es obligatorio.',
            'name.string' => 'El campo nombre de la especialidad debe ser una cadena de texto.',
            'name.max' => 'El campo nombre de la especialidad no puede ser mayor a :max caracteres.',
            'profession_id.required' => 'El campo profesión es obligatorio.',
            'profession_id.exists:professions,id' => 'El campo profesión debe estar definido.',


        ];
        $validated = $this->validate($request, $rules, $messages);

        $specialty->update($validated);

        Alert::toast('Especialidad editada exitosamente.', 'success');

        return redirect()->route('specialties.edit', $specialty->id);
    }

    public function destroy(Specialty $specialty)
    {
        $specialty->delete();

        Alert::toast('Especialidad eliminada exitosamente.', 'success');

        return redirect()->route('specialties.index');
    }
    public function getSpecialties(Request $request)
    {
        // Obtener el ID de la profesión seleccionada
        $professionId = $request->input('profession_id');

        // Obtener las especialidades relacionadas con la profesión
        $specialties = Specialty::where('profession_id', $professionId)->get();

        // Retornar las especialidades en formato JSON
        return response()->json(['specialties' => $specialties]);
    }

}
