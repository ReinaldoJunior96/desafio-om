<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PacienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'nome_completo' => $this->nomeCompleto,
            'nome_mae' => $this->nomeMae,
            'data_nascimento' => $this->dataNascimento,
            'cpf' => $this->cpf,
            'cns' => $this->cns
        ];
    }
}
