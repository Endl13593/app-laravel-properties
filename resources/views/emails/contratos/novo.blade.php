@component('mail::message')
# Parabéns

# Seu contrato foi gerado com sucesso.

# Informações do contrato:
**Data:** {{ $data }} <br />
**Tipo de Pessoa:** {{ $tipoDePessoa }} <br />
**Documento do contratante:** {{ $documentoContratante }} <br />
**Nome do contratante:** {{ $nomeContratante }} <br />
**Email do contratante:** {{ $emailContratante }} <br /><br />

# Dados da propriedade adquirida:
**Rua:** {{ $rua }} <br />
**Número:** {{ $numero }} <br />
**Complemento:** {{ $complemento }} <br />
**Bairro:** {{ $bairro }} <br />
**Cidade:** {{ $cidade }} <br />
**Estado:** {{ $estado }} <br /><br />

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
