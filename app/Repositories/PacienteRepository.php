<?php

namespace App\Repositories;

use App\Contracts\CrudInterface;
use App\Http\Resources\PacienteResource;
use App\Models\Paciente;
use Illuminate\Http\Client\Request;

class PacienteRepository implements CrudInterface
{
    private Paciente $model;

    public function __construct(Paciente $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return PacienteResource::collection($this->model->all());
    }

    public function show($param)
    {
        // TODO: Implement show() method.
    }

    public function update(Request $request, $param)
    {
        // TODO: Implement update() method.
    }

    public function destroy()
    {
        // TODO: Implement delete() method.
    }

    public function store(Request $request)
    {
        // TODO: Implement store() method.
    }
}
