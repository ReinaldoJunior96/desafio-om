<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface ImportCsvInterface
{
    public function importarCsv(Request $request);
}
