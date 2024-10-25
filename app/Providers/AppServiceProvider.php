<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\IRepositorioSabor;
use App\Repositories\RepositorioSabor;
use App\Services\Contracts\IServicoSabor;
use App\Services\ServicoSabor;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Registro dos repositórios de usuários
        $this->app->bind(\App\Repositories\Contracts\IRepositorioUsuario::class, \App\Repositories\RepositorioUsuario::class);
        
        // Registro dos serviços de usuários
        $this->app->bind(\App\Services\Contracts\IServicoUsuario::class, \App\Services\ServicoUsuario::class);

        // Registro dos repositórios de sabores
        $this->app->bind(IRepositorioSabor::class, RepositorioSabor::class);

        // Registro dos serviços de sabores
        $this->app->bind(IServicoSabor::class, ServicoSabor::class);
    }

    public function boot()
    {
        //
    }
}
