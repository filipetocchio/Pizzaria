<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface IServicoUsuario
{
    public function listarTodosUsuarios(int $porPagina = 10): LengthAwarePaginator;
    public function obterUsuarioPorId(string $id): User;
    public function registrarUsuario(array $dados): User;
    public function modificarUsuario(string $id, array $dados): User;
    public function deletarUsuario(string $id): void;
    public function obterUsuarioAutenticado(): User;
}
