<?php

namespace App\Services;

use App\Models\Propriedade\Propriedade;
use App\Models\Propriedade\StatusPropriedade;
use Illuminate\Http\Request;

class PropriedadeService
{
    public function getAllPaginate(Request $request): array
    {
        $direcao = $request->get('direcao', 'desc');
        $orderBy = $request->get('orderBy', 'id');

        $query = Propriedade::orderBy($orderBy, $direcao);

        $props = ['direcao' => $direcao, 'orderBy' => $orderBy];

        return array_merge(['paginate' => $query->paginate(8)->appends($props)], $props);
    }

    public function create(array $data): Propriedade
    {
        return Propriedade::create($data);
    }

    public function getAvailable()
    {
        return Propriedade::where('id_status', '=', StatusPropriedade::NAO_CONTRATADO)->get();
    }
}
