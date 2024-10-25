<?php

namespace App\Repositories;

use App\Repositories\Contracts\IRepositorioUsuario;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RepositorioUsuario implements IRepositorioUsuario
{
    public function listarUsuarios(int $porPagina = 10): LengthAwarePaginator
    {
        return User::select('id', 'name', 'email', 'created_at')->paginate($porPagina);
    }

    public function buscarPorId(string $id): ?User
    {
        return User::find($id);
    }

    public function criarUsuario(array $dados): User
    {
        return User::create([
            'name' => $dados['name'],
            'email' => $dados['email'],
            'password' => bcrypt($dados['password']),
        ]);
    }

    public function atualizarUsuario(User $usuario, array $dados): bool
    {
        if (isset($dados['password'])) {
            $dados['password'] = bcrypt($dados['password']);
        }
        return $usuario->update($dados);
    }

    public function removerUsuario(User $usuario): bool
    {
        return $usuario->delete();
    }
}
