<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Turma;
use App\Models\Matricula;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matriculas = Matricula::with(['aluno', 'turma'])
            ->join('alunos', 'matriculas.aluno_id', '=', 'alunos.id') 
            ->select('matriculas.*')
            ->orderBy('alunos.nome')
            ->get();

        $matriculasAgrupadas = $matriculas->groupBy(function ($item) {
            return $item->aluno->nome;
        });

        return view('matriculas.index', compact('matriculasAgrupadas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alunos = Aluno::orderBy('nome')->get();
        $turmas = Turma::orderBy('nome')->get();
        return view('matriculas.create', compact('alunos', 'turmas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'turma_id' => 'required|exists:turmas,id',
        ]);

        $existingMatricula = Matricula::where('aluno_id', $request->aluno_id)
        ->where('turma_id', $request->turma_id)
        ->first();

        if ($existingMatricula) {
            return redirect()->back()->withErrors(['aluno_id' => 'O aluno já está matriculado nesta turma.']);
        }

        Matricula::create([
            'aluno_id' => $request->aluno_id,
            'turma_id' => $request->turma_id,
        ]);

        return redirect()->route('matriculas.index')->with('success', 'Matrícula realizada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $turma = Turma::findOrFail($id);
        $alunos = $turma->matriculas()->with('aluno')->get();

        return view('matriculas.show', compact('turma', 'alunos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $matricula = Matricula::findOrFail($id);
        $alunos = Aluno::orderBy('nome')->get();
        $turmas = Turma::orderBy('nome')->get();

        return view('matriculas.edit', compact('matricula', 'alunos', 'turmas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'turma_id' => 'required|exists:turmas,id',
        ]);

        $existingMatricula = Matricula::where('aluno_id', $request->aluno_id)
        ->where('turma_id', $request->turma_id)
        ->first();

        if ($existingMatricula) {
            return redirect()->back()->withErrors(['aluno_id' => 'O aluno já está matriculado nesta turma.']);
        }

        $matricula = Matricula::findOrFail($id);
        $matricula->update($request->all());

        return redirect()->route('matriculas.index')->with('success', 'Matrícula atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
