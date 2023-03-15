<?php

namespace App\Contracts;

use Illuminate\Http\Client\Request;

interface CrudInterface
{
    public function index();

    public function show($param);

    public function store(Request $request);

    public function update(Request $request, $param);

    public function destroy();

}
