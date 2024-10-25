<?php

namespace App\Repositories\Contracts;

use App\Models\Flavor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface IRepositorioSabor
{
    public function listarSabores(int $porPagina = 10): LengthAwarePaginator;
    public function buscarPorId(string $id): ?Flavor;
    public function criarSabor(array $dados): Flavor;
    public function atualizarSabor(Flavor $sabor, array $dados): bool;
    public function removerSabor(Flavor $sabor): bool;
}
