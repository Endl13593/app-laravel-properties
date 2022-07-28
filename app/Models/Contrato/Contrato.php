<?php

namespace App\Models\Contrato;

use App\Models\Propriedade\Propriedade;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property int id_propriedade
 * @property int id_tipo_de_pessoa
 * @property string documento_contratante
 * @property string email_contratante
 * @property string nome_contratante
 * @property string created_at
 */
class Contrato extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'contratos';

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s',
        'updated_at' => 'datetime:d/m/Y H:i:s',
    ];

    protected $fillable = [
        'id_propriedade',
        'id_tipo_de_pessoa',
        'documento_contratante',
        'email_contratante',
        'nome_contratante',
    ];

    protected $appends = ['tipoDePessoa'];

    public function setEmailContratanteAttribute($value)
    {
        $this->attributes['email_contratante'] = strtolower($value);
    }

    public function getTipoDePessoaAttribute(): ?array
    {
        return TipoDePessoa::getArray($this->id_tipo_de_pessoa);
    }

    public function propriedade(): BelongsTo
    {
        return $this->belongsTo(Propriedade::class, 'id_propriedade');
    }
}
