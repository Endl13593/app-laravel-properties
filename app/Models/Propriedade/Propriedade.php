<?php

namespace App\Models\Propriedade;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property string email_proprietario
 * @property string rua
 * @property string numero
 * @property string complemento
 * @property string bairro
 * @property string cidade
 * @property string estado
 * @property int id_status
 */
class Propriedade extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'propriedades';

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s',
        'updated_at' => 'datetime:d/m/Y H:i:s',
    ];

    protected $fillable = [
        'email_proprietario',
        'bairro',
        'rua',
        'numero',
        'complemento',
        'cidade',
        'estado',
        'id_status'
    ];

    protected $attributes = [
        'id_status' => StatusPropriedade::NAO_CONTRATADO
    ];

    protected $appends = ['status'];

    public function setEmailProprietarioAttribute($value)
    {
        $this->attributes['email_proprietario'] = strtolower($value);
    }

    public function getStatusAttribute(): ?array
    {
        return StatusPropriedade::getArray($this->id_status);
    }
}
