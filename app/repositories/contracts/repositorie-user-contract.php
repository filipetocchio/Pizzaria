<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface IRepositorioUsuario
{
    public function listarUsuarios(int $porPagina = 10): LengthAwarePaginator;
    public function buscarPorId(string $id): ?User;
    public function criarUsuario(array $dados): User;
    public function atualizarUsuario(User $usuario, array $dados): bool;
    public function removerUsuario(User $usuario): bool;
}
