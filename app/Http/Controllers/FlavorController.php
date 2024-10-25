<?php

namespace App\Http\Controllers;

use App\Http\Enums\TamanhoEnum;
use App\Http\Requests\FlavorCreatRequest;
use App\Models\Flavor;
use App\Services\Contracts\IServicoSabor;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

/**
 * Class FlavorController
 *
 * @package App\Http\Controllers
 * @author ...
 */
class FlavorController extends Controller
{
    protected $servicoSabor;

    public function __construct(IServicoSabor $servicoSabor)
    {
        $this->servicoSabor = $servicoSabor;
    }

    /**
     * Exibir a lista de sabores.
     */
    public function index(): JsonResponse
    {
        $sabores = $this->servicoSabor->listarTodosSabores();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Sabores encontrados!',
            'sabores' => $sabores
        ], 200);
    }

    /**
     * Armazenar um novo sabor.
     */
    public function store(FlavorCreatRequest $request): JsonResponse
    {
        $dados = $request->validated();

        // Se necessário, converter 'tamanho' para o enum
        $dados['tamanho'] = TamanhoEnum::from($dados['tamanho']);

        $sabor = $this->servicoSabor->registrarSabor($dados);

        return response()->json([
            'status' => 201,
            'mensagem' => 'Sabor cadastrado com sucesso!',
            'sabor' => $sabor
        ], 201);
    }

    /**
     * Exibir um sabor específico.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $sabor = $this->servicoSabor->obterSaborPorId($id);

            return response()->json([
                'status' => 200,
                'mensagem' => 'Sabor encontrado com sucesso!',
                'sabor' => $sabor
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 404,
                'mensagem' => 'Sabor não encontrado!',
                'sabor' => null
            ], 404);
        }
    }

    /**
     * Atualizar um sabor específico.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $dados = $request->all();

        // Se 'tamanho' estiver presente, converter para o enum
        if (isset($dados['tamanho'])) {
            $dados['tamanho'] = TamanhoEnum::from($dados['tamanho']);
        }

        try {
            $sabor = $this->servicoSabor->modificarSabor($id, $dados);

            return response()->json([
                'status' => 200,
                'mensagem' => 'Sabor atualizado com sucesso!',
                'sabor' => $sabor
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 404,
                'mensagem' => 'Sabor não encontrado!',
                'sabor' => null
            ], 404);
        }
    }

    /**
     * Remover um sabor específico.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $this->servicoSabor->deletarSabor($id);

            return response()->json([
                'status' => 200,
                'mensagem' => 'Sabor deletado com sucesso!'
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 404,
                'mensagem' => 'Sabor não encontrado!',
                'sabor' => null
            ], 404);
        }
    }
}
