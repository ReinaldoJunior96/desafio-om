<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';
    protected $fillable = ['foto', 'nomeCompleto', 'nomeMae', 'datanascimento', 'cpf', 'cns'];

    public function uploadFoto($foto)
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


    public function endereco(): HasOne
    {
        return $this->hasOne(Endereco::class);
    }
}
