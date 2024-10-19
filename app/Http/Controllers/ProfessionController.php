<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProfessionController extends Controller
{
    // Lista de profesiones
    public function index()
    {
        $title = 'Eliminar Profesión';
        $text = "¿Seguro quieres eliminar esta profesión?, esta acción no puede recuperarse.";
        confirmDelete($title, $text);

        $professions = Profession::all();
        return view('professions.list', compact('professions'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('professions.create');
    }

    // Guardar nueva profesión
    public function store(Request $request)
    {
        $rules = [
            'profession' => 'required|string|max:255',
        ];
        $messages = [
            'profession.required' => 'El campo profesión es obligatorio.',
            'profession.string' => 'El campo profesión debe ser una cadena de texto.',
            'profession.max' => 'El campo profesión no puede ser mayor a :max caracteres.',
        ];
        $validated = $this->validate($request, $rules, $messages);

        Profession::create($validated);
        Alert::toast('La profesión ha sido creado correctamente', 'success');
        return redirect()->route('professions.index');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $profession = Profession::findOrFail($id);
        return view('professions.edit', compact('profession'));
    }

    // Actualizar profesión
    public function update(Request $request, Profession $profession)
    {
       $rules = [
            'profession' => 'required|string|max:255',
        ];
        $messages = [
            'profession.required' => 'El campo profesión es obligatorio.',
            'profession.string' => 'El campo profesión debe ser una cadena de texto.',
            'profession.max' => 'El campo profesión no puede ser mayor a :max caracteres.',
        ];
        $validated = $this->validate($request, $rules, $messages);

        $profession->update($validated);
        Alert::toast('La Profeción ha sido actualizada correctamente','success');

        return redirect()->route('professions.edit', $profession->id);

    }

    // Eliminar profesión
    public function destroy($id)
    {
        try {
            $profession = Profession::findOrFail($id);
            $profession->delete();
            Alert::toast('La Profeción ha sido eliminada correctamente','success');
            return redirect()->route('professions.index');
        } catch (\Illuminate\Database\QueryException $e) {
            // Verificamos si la excepción es por una violación de clave foránea (código 1451)
            if ($e->getCode() == 23000) {
                Alert::toast('No se puede eliminar la profesión porque está relacionada con otros registros','error');
                return redirect()->route('professions.index');
            }
            // Otras posibles excepciones
            Alert::toast('Ha ocurrido un error al eliminar la profesión, codigo de error:'.$e->getCode(),'error');

            return redirect()->route('professions.index');
        }
    }
}
