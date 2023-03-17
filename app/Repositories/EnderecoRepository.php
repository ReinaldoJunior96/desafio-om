<?php

namespace App\Repositories;

use App\Contracts\CrudInterface;
use App\Contracts\ViaCepInterface;
use App\Http\Resources\EnderecoResource;
use App\Models\Endereco;
use Illuminate\Http\Client\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class EnderecoRepository implements CrudInterface, ViaCepInterface
{
    private Endereco $model;

    public function __construct(Endereco $model)
    {
        $this->model = $model;
    }

    public function index(): AnonymousResourceCollection
    {
        return EnderecoResource::collection($this->model->all());
    }

    public function show($param): EnderecoResource
    {
        return EnderecoResource::make($this->model->find($param));
    }

    public function update($request, $param): JsonResponse
    {
        if($this->model->validaEndereco($param)){
            return response()->json('Endereco não encontrado', 404);
        }

        $address = $this->model->find($param);

        $address->cep = $request->cep;
        $address->endereco = $request->endereco;
        $address->numero = $request->numero;
        $address->complemento = $request->complemento;
        $address->bairro = $request->bairro;
        $address->cidade = $request->cidade;
        $address->estado = $request->estado;

        $address->save();

        return response()->json('Success', 200);
    }


    public function store(\Illuminate\Http\Request $request): JsonResponse
    {
        $this->model->create([
            'cep' => $request->cep,
            'endereco' => $request->endereco,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'paciente_id' => $request->pacienteid,
        ]);

        return response()->json('Success');
    }

    public function destroy($endereco): JsonResponse
    {
        if($this->model->validaEndereco($endereco)){
            return response()->json('Endereco não encontrado', 404);
        }

        $this->model->find($endereco)->delete();


        return response()->json('Paciente deletado com sucesso!', 200);
    }

    public function buscarCep($cep): string
    {
        $exp = 3600; // tempo em segudos para expirar o cache
        $key = $cep;

        return Cache::remember($key, $exp, function () use ($cep) {
            return file_get_contents('https://viacep.com.br/ws/' . $cep . '/json/');
        });
    }
}
