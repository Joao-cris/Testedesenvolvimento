<?php

use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\FaltasController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    
    return view('home.home');
});


Route::get('/errors', function () {
    return view('errors');
})->name('errors');


// chamar cadastro dos  funcionario
Route::get('/funcionarios/criar', [FuncionarioController::class, 'criar'])->name('funcionarios.criar');

// chamar o metodo para cadastrar com este link

Route::post('/funcionarios', [FuncionarioController::class, 'cadastrarfuncionario'])->name('funcionarios.cadastrarfuncio');

// chamar a routa para listar os dados do funcionarios 
Route::get('/funcionarios/index', [FuncionarioController::class, 'index'])->name('funcionarios.index');

// vamos agora editar os dados dos funcionarios

Route::get('/funcionarios/{id}/user', [FuncionarioController::class, 'edit'])->name('funcionarios.edit');

// router para actualizar funcionario

Route::put('/funcionarios/{id}/update', [FuncionarioController::class, 'update'])->name('funcionarios.update');

// router para apagar o arquivo no banco de dados

Route::delete('/funcionarios/{id}/apagar', [FuncionarioController::class, 'apagar'])->name('funcionarios.apagar');

// criar faltas de funcionarios 
Route::delete('/funcionarios/{id}/apagar', [FuncionarioController::class, 'apagar'])->name('funcionarios.apagar');

// Rota para exibir o formulário de registro de faltas

Route::get('/funcionarios/{id}/falta', [FaltasController::class, 'criar'])->name('faltas.criar');//nome no formulario ou para um dado link

// Rota para armazenar a falta no banco de dados

Route::post('/funcionarios/{funcionarioId}/faltas', [FaltasController::class, 'store'])->name('faltas.store');

//defini um link chamei o metodo da faltacontroller para exibir funcionarios em falta

Route::get('/funcionarios/faltas', [FaltasController::class, 'FuncionarioFaltas'])->name('funcionarios.faltas');

Route::get('/funcionarios/{id}/editar', [FaltasController::class, 'funcionariofalta'])->name('faltas.edit');

Route::put('/funcionarios/{id}/updatefalta',[FaltasController::class, 'actualizar'])->name('faltas.update');

Route::get('/funcionarios/{faltaId}/deletar',[FaltasController::class,'remover'])->name('faltas.apagar');

Route::get('/faltas/confirmar/{id}/{countfaltas}/{funcionario_id}/{data_inicio}/{data_fim}', [FuncionarioController::class, 'confirmar'])->name('faltas.confirmar');

Route::get('faltas/pesquisar', [FaltasController::class, 'listarFaltas'])->name('funcionarios.faltas.pesquisar');

Route::get('faltas/{funcionario_id}/get', [FaltasController::class, 'relatoriofaltas'])->name('faltas.relatorio');






// tudo sobre login
Route::get('funcionarios/login', [FuncionarioController::class, 'showLoginForm'])->name('login.form');

Route::post('funcionarios/chamarlogin', [FuncionarioController::class, 'chamarlogin'])->name('chamarlogin');

Route::post('/funcionarios/logout', [FuncionarioController::class, 'logout'])->name('logout');
Route::get('funcionarios/boasvindas', [FuncionarioController::class, 'boasVindas'])->name('funcionarios.boasvindas');

Route::get('faltas/usuario', [FaltasController::class, 'usuario'])->name('faltas.usuario');

Route::get('faltas/master', [FaltasController::class, 'master'])->name('faltas.master');





//











