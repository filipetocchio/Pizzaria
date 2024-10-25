<?php

namespace App\Repositories;

use App\Repositories\Contracts\IRepositorioSabor;
use App\Models\Flavor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RepositorioSabor implements IRepositorioSabor
{
    public function listarSabores(int $porPagina = 10): LengthAwarePaginator
    {
        return Flavor::select('id', 'sabor', 'preco', 'tamanho')->paginate($porPagina);
    }

    public function buscarPorId(string $id): ?Flavor
    {
        return Flavor::find($id);
    }

    public function criarSabor(array $dados): Flavor
    {
        return Flavor::create([
            'sabor' => $dados['sabor'],
            'preco' => $dados['preco'],
            'tamanho' => $dados['tamanho'], // Assumindo que 'tamanho' já está no formato adequado
        ]);
    }

    public function atualizarSabor(Flavor $sabor, array $dados): bool
    {
        // Se houver enumeração para 'tamanho', certifique-se de converter adequadamente
        if (isset($dados['tamanho'])) {
            $dados['tamanho'] = TamanhoEnum::from($dados['tamanho']);
        }
        return $sabor->update($dados);
    }

    public function removerSabor(Flavor $sabor): bool
    {
        return $sabor->delete();
    }
}
