<?php

namespace App\Services;

use App\Services\Contracts\IServicoSabor;
use App\Repositories\Contracts\IRepositorioSabor;
use App\Models\Flavor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;

class ServicoSabor implements IServicoSabor
{
    protected $repositorioSabor;

    public function __construct(IRepositorioSabor $repositorioSabor)
    {
        $this->repositorioSabor = $repositorioSabor;
    }

    public function listarTodosSabores(int $porPagina = 10): LengthAwarePaginator
    {
        return $this->repositorioSabor->listarSabores($porPagina);
    }

    public function obterSaborPorId(string $id): Flavor
    {
        $sabor = $this->repositorioSabor->buscarPorId($id);
        if (!$sabor) {
            throw ValidationException::withMessages(['mensagem' => 'Sabor não encontrado!']);
        }
        return $sabor;
    }

    public function registrarSabor(array $dados): Flavor
    {
        return $this->repositorioSabor->criarSabor($dados);
    }

    public function modificarSabor(string $id, array $dados): Flavor
    {
        $sabor = $this->obterSaborPorId($id);
        $this->repositorioSabor->atualizarSabor($sabor, $dados);
        return $sabor->fresh();
    }

    public function deletarSabor(string $id): void
    {
        $sabor = $this->obterSaborPorId($id);
        $this->repositorioSabor->removerSabor($sabor);
    }
}
