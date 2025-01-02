<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class VerifyJWTToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
         // 1. Busca o token na sessão
         $token = session('token');  // Recupera o token armazenado na sessão

        if (!$token) {
            return response()->json(['error' => 'Token não fornecido'], 401);
        }

        try {
            // 2. Verifica se o token é válido e autentica o usuário
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            // 3. Se o token for inválido ou expirado
            return response()->json(['error' => 'Token inválido ou expirado'], 401);
        }

        // 4. Passa a requisição com o usuário autenticado para o próximo middleware ou controlador
        return $next($request);
    }
}
