<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\Contracts\IServicoUsuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    protected $servicoUsuario;

    public function __construct(IServicoUsuario $servicoUsuario)
    {
        $this->servicoUsuario = $servicoUsuario;
    }

    /**
     * Exibir a lista de usuários.
     */
    public function index(): JsonResponse
    {
        $usuarios = $this->servicoUsuario->listarTodosUsuarios();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Usuários encontrados!',
            'dados' => $usuarios
        ], 200);
    }

    /**
     * Exibir o usuário autenticado.
     */
    public function me(): JsonResponse
    {
        $usuario = $this->servicoUsuario->obterUsuarioAutenticado();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Usuário autenticado!',
            'dados' => $usuario
        ], 200);
    }

    /**
     * Armazenar um novo usuário.
     */
    public function store(UserCreateRequest $request): JsonResponse
    {
        $usuario = $this->servicoUsuario->registrarUsuario($request->validated());

        return response()->json([
            'status' => 201,
            'mensagem' => 'Usuário cadastrado com sucesso!',
            'dados' => $usuario
        ], 201);
    }

    /**
     * Exibir um usuário específico.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $usuario = $this->servicoUsuario->obterUsuarioPorId($id);

            return response()->json([
                'status' => 200,
                'mensagem' => 'Usuário encontrado!',
                'dados' => $usuario
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 404,
                'mensagem' => 'Usuário não encontrado!',
                'dados' => null
            ], 404);
        }
    }

    /**
     * Atualizar um usuário específico.
     */
    public function update(UserUpdateRequest $request, string $id): JsonResponse
    {
        try {
            $usuario = $this->servicoUsuario->modificarUsuario($id, $request->validated());

            return response()->json([
                'status' => 200,
                'mensagem' => 'Usuário atualizado com sucesso!',
                'dados' => $usuario
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 404,
                'mensagem' => 'Usuário não encontrado!',
                'dados' => null
            ], 404);
        }
    }

    /**
     * Remover um usuário específico.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $this->servicoUsuario->deletarUsuario($id);

            return response()->json([
                'status' => 200,
                'mensagem' => 'Usuário deletado com sucesso!'
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 404,
                'mensagem' => 'Usuário não encontrado!',
                'dados' => null
            ], 404);
        }
    }
}
