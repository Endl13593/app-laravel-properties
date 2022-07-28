<?php

namespace App\Observers;

use App\Models\Contrato\Contrato;
use App\Models\Propriedade\Propriedade;
use App\Models\Propriedade\StatusPropriedade;

class ContratoObserver
{
    public function created(Contrato $contrato)
    {
        $propriedade = Propriedade::find($contrato->id_propriedade);

        $propriedade->id_status = StatusPropriedade::CONTRATADO;

        $propriedade->save();
    }

    public function deleted(Contrato $contrato)
    {
        $propriedade = Propriedade::find($contrato->id_propriedade);

        $propriedade->id_status = StatusPropriedade::NAO_CONTRATADO;

        $propriedade->save();
    }
}
