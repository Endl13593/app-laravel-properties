@component('mail::message')
# Nova propriedade criada

**Email do Proprietário:** {{ $emailProprietario }} <br />

# Dados da propriedade criada:
**Rua:** {{ $rua }} <br />
**Número:** {{ $numero }} <br />
**Complemento:** {{ $complemento }} <br />
**Bairro:** {{ $bairro }} <br />
**Cidade:** {{ $cidade }} <br />
**Estado:** {{ $estado }} <br />


Obrigado,<br>
{{ config('app.name') }}
@endcomponent
