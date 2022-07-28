<?php

namespace App\Http\Controllers;

use App\Http\Requests\Propriedade\PropriedadeFormRequest;
use App\Models\Propriedade\Propriedade;
use App\Services\PropriedadeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PropriedadeController extends Controller
{

    public function index(Request $request): array
    {
        return (new PropriedadeService())->getAllPaginate($request);
    }

    public function store(PropriedadeFormRequest $request): Propriedade
    {
        return (new PropriedadeService())->create($request->validated());
    }

    public function destroy(Propriedade $model): Response
    {
        $model->delete();
        return response()->noContent();
    }
}
