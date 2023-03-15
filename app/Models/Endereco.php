<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Endereco extends Model
{
    use HasFactory;

    protected $table = 'enderecos';
    protected $fillable = ['cep', 'endereco', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'paciente_id'];


    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }
}
