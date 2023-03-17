<?php

namespace App\Repositories;

use App\Contracts\BuscarPorCpfInterface;
use App\Contracts\CrudInterface;
use App\Contracts\ImportCsvInterface;
use App\Http\Resources\PacienteResource;
use App\Jobs\ImportCsvJob;
use App\Models\Paciente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;

class PacienteRepository implements CrudInterface, ImportCsvInterface, BuscarPorCpfInterface
{
    private Paciente $model;

    public function __construct(Paciente $model)
    {
        $this->model = $model;
    }

    public function index(): AnonymousResourceCollection
    {
        return PacienteResource::collection($this->model->paginate(3));
    }

    public function show($param): JsonResponse|PacienteResource
    {
        if ($this->model->validaPaciente($param)) {
            return response()->json("Paciente não encontrado", 200);
        }


        return PacienteResource::make($this->model->find($param));
    }

    public function update($request, $param): JsonResponse
    {
        if ($this->model->validaPaciente($param)) {
            return response()->json("Paciente não encontrado", 200);
        }

        $paciente = $this->model->find($param);

        $stringFoto = null;

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $stringFoto = $this->model->uploadFoto($request->foto);
        }

        $paciente->foto = $stringFoto;
        $paciente->nomeCompleto = $request->nomeCompleto;
        $paciente->nomeMae = $request->nomeMae;
        $paciente->dataNascimento = $request->dataNascimento;
        $paciente->cpf = $request->cpf;
        $paciente->cns = $request->cns;

        $paciente->save();

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
        if ($this->model->validaPaciente($paciente)) {
            return response()->json("Paciente não encontrado", 200);
        }

        $this->model->find($paciente)->delete();
        return response()->json('Paciente deletado com sucesso!', 200);
    }

    public function importarCsv($request): string
    {

        if (Storage::exists($request->file)) {
            Storage::delete($request->file);
        }

        $upload = Storage::disk('local')->putFileAs(
            'pacientes/import/temporario',
            $request->file,
            'planilha-temp.csv'
        );

        if (!$upload) {
            return response()->json('Não foi possível realizar o upload da imagem!', 409);
        }

        ImportCsvJob::dispatch();


        return response()->json('Success', 200);


    }

    public function buscarPorCpf($cpf): JsonResponse|PacienteResource
    {
        if (!$this->model->whereCpf($cpf)->first()) {
            return response()->json("Cpf não encontrado", 200);
        }
        return PacienteResource::make($this->model->whereCpf($cpf)->first());
    }
}
