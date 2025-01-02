<?php

namespace App\Providers;

use App\Core\Interfaces\FaltasRepositoryInterface;
use App\Core\Interfaces\FuncionarioRepositoryInterface;



use App\Infrastructure\Repositories\FaltasRepository;
use App\Infrastructure\Repositories\FuncionarioRepository;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registra a implementação da interface de Funcionario
        $this->app->bind(FuncionarioRepositoryInterface::class, FuncionarioRepository::class);

         // Registra a implementação da interface de FALTA
         $this->app->bind(FaltasRepositoryInterface::class , FaltasRepository::class );

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
