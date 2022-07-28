<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contrato\ContratoFormRequest;
use App\Models\Contrato\Contrato;
use App\Services\ContratoService;
use App\Services\PropriedadeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContratoController extends Controller
{
    public function index(Request $request): array
    {
        return (new ContratoService())->getAllPaginate($request);
    }

    public function store(ContratoFormRequest $request): Contrato
    {
        return (new ContratoService())->create($request->validated());
    }

    public function destroy(Contrato $model): Response
    {
        $model->delete();
        return response()->noContent();
    }

    public function getPropriedades()
    {
        return (new PropriedadeService())->getAvailable();
    }

    public function getTipoDePessoa(): array
    {
        return (new ContratoService())->getTipoDePessoa();
    }
}
