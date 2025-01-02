<?php
namespace App\Core\UseCases;

use App\Core\Interfaces\FuncionarioRepositoryInterface;

use App\Infrastructure\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class FuncionarioUseCase
{
    protected $funcionarioRepository;

    public function __construct(FuncionarioRepositoryInterface $funcionarioRepository)
    {
        $this->funcionarioRepository = $funcionarioRepository;
    }

    public function createFuncionario(array $data): Funcionario
    {
        return $this->funcionarioRepository->createFuncionario($data);
    }

    public function listarFuncionario(): Collection
    {
        return $this->funcionarioRepository->listarFuncionario();
    }

    public function apagar(int $id): bool
    {
        return $this->funcionarioRepository->apagar($id);
    }

    public function updateFuncionario(int $id, array $data): Funcionario
    {
        return $this->funcionarioRepository->updateFuncionario($id, $data);
    }

    public function findFuncionarioById(int $id): Funcionario
    {
        return $this->funcionarioRepository->findFuncionarioById($id);
    }

    public function IdFuncioDesconto(int $idfalta, int $numerofalta , int $idfnucionario,$data_inicio,$data_fim):Funcionario
    {

        return $this->funcionarioRepository->idfuncioDesconto($idfalta, $numerofalta, $idfnucionario, $data_inicio,$data_fim);

    }
    //tudo sobre login

    public function loginCase(Request $request)
    
    {
        
        return $this->funcionarioRepository->login( $request);
    }
}
