<?php

namespace App\Services\Contracts;

use App\Models\Flavor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface IServicoSabor
{
    public function listarTodosSabores(int $porPagina = 10): LengthAwarePaginator;
    public function obterSaborPorId(string $id): Flavor;
    public function registrarSabor(array $dados): Flavor;
    public function modificarSabor(string $id, array $dados): Flavor;
    public function deletarSabor(string $id): void;
}
