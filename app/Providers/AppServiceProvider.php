<?php

namespace App\Providers;

use App\Contracts\CrudInterface;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\PacienteController;
use App\Repositories\EnderecoRepository;
use App\Repositories\PacienteRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->when(PacienteController::class)
            ->needs(CrudInterface::class)
            ->give(PacienteRepository::class);

        $this->app->when(EnderecoController::class)
            ->needs(CrudInterface::class)
            ->give(EnderecoRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
