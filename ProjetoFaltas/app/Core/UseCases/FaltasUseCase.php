<?php
//aqui no UseCase, todo estes metodos sao chamados na controller que por sua vez chama o repositorio
namespace App\Core\UseCases;

use App\Core\Interfaces\FaltasRepositoryInterface;

use App\Infrastructure\Models\Falta;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Ramsey\Collection\Collection as CollectionCollection;

class FaltasUseCase
{
    protected $faltaRepository;

    public function __construct(FaltasRepositoryInterface $faltaRepository)
    {
        $this->faltaRepository = $faltaRepository;
    }

    // Cria uma nova falta
    public function registrarFalta(array $data) :Falta
    {
        return $this->faltaRepository->createFaltas($data);
    }

    // Obtém todas as faltas relacionadas aos funcionários
    public function getFaltasByFuncionarios(): Collection
    {
        return $this->faltaRepository->getFaltasByFuncionario();
    }

    // Exclui uma falta
    public function deleteFalta(int $id)
    {
        return $this->faltaRepository->deletefaltas($id);
    }

    // Atualiza os dados de uma falta
    public function editarFalta(int $id, array $data) :Falta
    {
        return $this->faltaRepository->editarfaltas($id, $data);
    }

    // Recupera uma falta específica de um funcionário
    public function getFaltaById(int $id) : Falta
    {
        return $this->faltaRepository->funcionarioEmfalta($id);
    }

    public function execute($nome)
    {
        // Chama o repositório para listar as faltas por nome
        return $this->faltaRepository->listarFaltasPorNome($nome);
    }


    public function listarFaltasRelatories(int $id)
    {
        return $this->faltaRepository->listarFaltasRelatorio($id);
    }
}
