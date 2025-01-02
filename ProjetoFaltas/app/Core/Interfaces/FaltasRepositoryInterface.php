<?php

namespace App\Core\Interfaces;

use App\Infrastructure\Models\Falta;
use Illuminate\Database\Eloquent\Collection;

interface FaltasRepositoryInterface 
{

    public function createFaltas(array $data) : Falta;

    public function getFaltasByFuncionario() : Collection;

    public function deletefaltas(int $idfaltas) : bool;

    public function editarfaltas(int $editId,array $dados) : Falta;

    // aplicar falta ao funcionario

    public function funcionarioEmfalta(int $id) : Falta;

  // Método para listar as faltas com base no nome do funcionário
  public function listarFaltasPorNome($nome);

  // Método para listar relatorios com falata
  public function listarFaltasRelatorio(int $id);



}

