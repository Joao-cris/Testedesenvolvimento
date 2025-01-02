<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PHPUnit\Event\Code\Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthenticationException::class,
        ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // Captura a ModelNotFoundException
        $this->renderable(function (ModelNotFoundException $e, $request) {
            // Mostra os detalhes da exceção com dd() para depuração
            dd('Modelo não encontrado: ', $e->getMessage(), $e);
        });
        
        // Outros tipos de exceções podem ser logados ou manipulados aqui, se necessário
        $this->reportable(function (Exception $e) {
            Log::error('Exceção capturada: ' . $e->getMessage());
        });
    }
}
