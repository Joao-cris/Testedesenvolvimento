<?php

namespace App\Core\Interfaces;

use App\Infrastructure\Models\Funcionario;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface FuncionarioRepositoryInterface
{
    public function createFuncionario(array $data): Funcionario;
    
    public function listarFuncionario(): Collection;
    
    public function apagar(int $id): bool;
    
    public function updateFuncionario(int $id, array $data): Funcionario;
    
    public function findFuncionarioById(int $id): Funcionario;

    public function idfuncioDesconto(int $idfalta, $numerofalta ,int $idfunc,$data_inicio, $data_fim):Funcionario;

    //tudo sobre login 

    public function login (Request $dadoslogin);



    


}
