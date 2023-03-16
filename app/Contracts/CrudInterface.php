<?php

namespace App\Contracts;



use Illuminate\Http\Request;

interface CrudInterface
{
    public function index();

    public function show($param);

    public function store(Request $request);

    public function update($request, $param);

    public function destroy($paciente);

}
