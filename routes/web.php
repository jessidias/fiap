<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\MatriculaController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('alunos', AlunoController::class);
    Route::get('/alunos/{id}/edit', [AlunoController::class, 'edit'])->name('alunos.edit');
    Route::put('/alunos/{id}', [AlunoController::class, 'update'])->name('alunos.update');

    Route::resource('turmas', TurmaController::class);
    Route::get('/turmas/{id}/edit', [TurmaController::class, 'edit'])->name('turmas.edit');
    Route::put('/turmas/{id}', [TurmaController::class, 'update'])->name('turmas.update');
    Route::get('/turmas/{turma}', [TurmaController::class, 'show'])->name('turmas.show');

    Route::get('/matriculas', [MatriculaController::class, 'index'])->name('matriculas.index');
    Route::get('/matriculas/create', [MatriculaController::class, 'create'])->name('matriculas.create');
    Route::post('/matriculas', [MatriculaController::class, 'store'])->name('matriculas.store');
    Route::get('/matriculas/{id}/edit', [MatriculaController::class, 'edit'])->name('matriculas.edit');
    Route::put('/matriculas/{id}', [MatriculaController::class, 'update'])->name('matriculas.update');
    Route::get('/turmas/{turma}/matriculas', [MatriculaController::class, 'show'])->name('matriculas.show');
});

require __DIR__.'/auth.php';
