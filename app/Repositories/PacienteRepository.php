<?php

namespace App\Repositories;

use App\Contracts\CrudInterface;
use App\Http\Resources\PacienteResource;
use App\Models\Paciente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;

class PacienteRepository implements CrudInterface
{
    private Paciente $model;

    public function __construct(Paciente $model)
    {
        $this->model = $model;
    }

    public function index(): AnonymousResourceCollection
    {
        return PacienteResource::collection($this->model->all());
    }

    public function show($param): PacienteResource
    {
        return PacienteResource::make($this->model->find($param));
    }

    public function update($request, $param)
    {
        $param = $this->model->find($param);

        $param->foto = $request->foto;
        $param->nomeCompleto = $request->nomeCompleto;
        $param->nomeMae = $request->nomeNome;
        $param->dataNascimento = $request->dataNascimento;
        $param->cpf = $request->cpf;
        $param->cns = $request->cns;

        $param->save();

        return response()->json('Success', 200);
    }


    public function store(Request $request): JsonResponse
    {
        $stringFoto = null;

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $stringFoto = $this->model->uploadFoto($request->foto);
        }

        $this->model->create([
            'foto' => $stringFoto,
            'nomeCompleto' => $request->nomeCompleto,
            'nomeMae' => $request->nomeMae,
            'dataNascimento' => $request->dataNascimento,
            'cpf' => $request->cpf,
            'cns' => $request->cns
        ]);

        return response()->json('Success', 200);
    }

    public function destroy($paciente): JsonResponse
    {
        $paciente = $this->model->find($paciente)->delete();
        return response()->json('Paciente deletado com sucesso!', 200);
    }
}
