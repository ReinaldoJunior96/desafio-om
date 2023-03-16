<?php

namespace App\Http\Controllers;

use App\Contracts\CrudInterface;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    private CrudInterface $model;

    public function __construct(CrudInterface $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->model->index();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $endereco)
    {
        return $this->model->show($endereco);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->model->show($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $endereco)
    {
        $this->model->update($request, $endereco);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $endereco)
    {
        $this->model->destroy($endereco);
    }

    public function buscarCep($cep)
    {
        return $this->model->buscarCep($cep);
    }
}
