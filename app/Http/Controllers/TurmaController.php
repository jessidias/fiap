<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->get('search');
        $turmas = Turma::when($query, function ($query) {
            return $query->where('nome', 'like', '%' . $query . '%');
        })
        ->orderBy('nome')
        ->paginate(5);

        return view('turmas.index', compact('turmas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('turmas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|min:3|max:255',
            'descricao' => 'required|string',
            'tipo' => 'required|string|max:255',
        ], [
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',
        ]);

        Turma::create($request->all());
        return redirect()->route('turmas.index')->with('success', 'Turma cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Turma $turma)
    {
        $alunos = $turma->matriculas()->with('aluno')->get();
        return view('turmas.show', compact('turma', 'alunos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $turma = Turma::findOrFail($id);
        return view('turmas.edit', compact('turma'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|string|min:3|max:255',
            'descricao' => 'required|string|max:255',
            'tipo' => 'required|string|max:255' . $id,
        ], [
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',
        ]);

        $turma = Turma::findOrFail($id);
        $turma->update($request->all());

        return redirect()->route('turmas.index')->with('success', 'Turma atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Turma $turma)
    {
        $turma->delete();
        return redirect()->route('turmas.index')->with('success', 'Turma excluída com sucesso!');;
    }
}
