<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';
    protected $fillable = ['foto', 'nameCompleto', 'nomeMae', 'datanascimento', 'cpf', 'cns'];

    public function endereco(): HasOne
    {
        return $this->hasOne(Endereco::class);
    }
}
