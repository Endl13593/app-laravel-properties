<?php

namespace App\Services;

use App\Models\Contrato\Contrato;
use App\Models\Contrato\TipoDePessoa;
use Illuminate\Http\Request;

class ContratoService
{
    public function getAllPaginate(Request $request): array
    {
        $direcao = $request->get('direcao', 'desc');
        $orderBy = $request->get('orderBy', 'id');

        $query = Contrato::with('propriedade')->orderBy($orderBy, $direcao);

        $props = ['direcao' => $direcao, 'orderBy' => $orderBy];

        return array_merge(['paginate' => $query->paginate(10)->appends($props)], $props);
    }

    public function create(array $data): Contrato
    {
        return Contrato::create($data);
    }

    public function getTipoDePessoa(): array
    {
        return TipoDePessoa::all();
    }
}
