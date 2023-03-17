<?php

namespace App\Imports;

use App\Models\Paciente;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class PacientesImport implements ToModel
{

    public function model(array $row): Model|Paciente|null
    {
        $model = new Paciente();

        return $model->create([
            'foto' => $row[0],
            'nomeCompleto' => $row[1],
            'nomeMae' => $row[2],
            'dataNascimento' => $row[3],
            'cpf' => $row[4],
            'cns' => $row[5],
        ]);
    }
}
