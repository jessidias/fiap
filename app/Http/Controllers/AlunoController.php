<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->get('search');
        $alunos = Aluno::when($query, function ($q) use ($query) {
            return $q->where('nome', 'like', '%' . $query . '%');
        })
        ->orderBy('nome')
        ->paginate(5);

        return view('alunos.index', compact('alunos', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alunos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|min:3|max:255',
            'data_nascimento' => 'required|date|date_format:Y-m-d|before:'.now()->subYears(16)->format('Y-m-d').'|after:'.now()->subYears(100)->format('Y-m-d'),
            'usuario' => 'required|string|max:255|unique:alunos',
        ], [
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'data_nascimento.before' => 'A idade deve ser maior que 16 anos.',
            'data_nascimento.after' => 'A idade deve ser menor que 100 anos.',
        ]);

        Aluno::create($request->all());
        return redirect()->route('alunos.index')->with('success', 'Aluno cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aluno $aluno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $aluno = Aluno::findOrFail($id);
        return view('alunos.edit', compact('aluno'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|min:3|max:255',
            'data_nascimento' => 'required|date|date_format:Y-m-d|before:'.now()->subYears(16)->format('Y-m-d').'|after:'.now()->subYears(100)->format('Y-m-d'),
            'usuario' => 'required|string|max:255|unique:alunos,usuario,' . $id,
        ], [
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'data_nascimento.before' => 'A idade deve ser maior que 16 anos.',
            'data_nascimento.after' => 'A idade deve ser menor que 100 anos.',
        ]);

        $aluno = Aluno::findOrFail($id);
        $aluno->update($request->all());

        return redirect()->route('alunos.index')->with('success', 'Aluno atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aluno $aluno)
    {
        $aluno->delete();
        return redirect()->route('alunos.index')->with('success', 'Aluno excluído com sucesso!');;
    }
}
