<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';
    protected $fillable = ['foto', 'nomeCompleto', 'nomeMae', 'dataNascimento', 'cpf', 'cns'];

    public function uploadFoto($foto): array|JsonResponse|bool|string
    {

        if (Storage::exists($foto)) {
            Storage::delete($foto);
        }

        $upload = Storage::put('public/pacientes/images', $foto);

        if (!$upload) {
            return response()->json('Não foi possível realizar o upload da imagem!', 409);
        }

        return str_replace('public', '/storage', $upload);


    }

    public function validaPaciente($param): bool
    {
        return empty((bool)Paciente::find($param));

    }

    public function endereco(): HasOne
    {
        return $this->hasOne(Endereco::class);
    }
}
