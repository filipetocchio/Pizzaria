<?php

namespace App\Services;

use App\Services\Contracts\IServicoUsuario;
use App\Repositories\Contracts\IRepositorioUsuario;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ServicoUsuario implements IServicoUsuario
{
    protected $repositorioUsuario;

    public function __construct(IRepositorioUsuario $repositorioUsuario)
    {
        $this->repositorioUsuario = $repositorioUsuario;
    }

    public function listarTodosUsuarios(int $porPagina = 10): LengthAwarePaginator
    {
        return $this->repositorioUsuario->listarUsuarios($porPagina);
    }

    public function obterUsuarioPorId(string $id): User
    {
        $usuario = $this->repositorioUsuario->buscarPorId($id);
        if (!$usuario) {
            throw ValidationException::withMessages(['mensagem' => 'Usuário não encontrado!']);
        }
        return $usuario;
    }

    public function registrarUsuario(array $dados): User
    {
        return $this->repositorioUsuario->criarUsuario($dados);
    }

    public function modificarUsuario(string $id, array $dados): User
    {
        $usuario = $this->obterUsuarioPorId($id);
        $this->repositorioUsuario->atualizarUsuario($usuario, $dados);
        return $usuario->fresh();
    }

    public function deletarUsuario(string $id): void
    {
        $usuario = $this->obterUsuarioPorId($id);
        $this->repositorioUsuario->removerUsuario($usuario);
    }

    public function obterUsuarioAutenticado(): User
    {
        return Auth::user();
    }
}
