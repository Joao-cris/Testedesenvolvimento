<?php

namespace App\Infrastructure\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;  // Importando a interface JWTSubject
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Authenticatable implements JWTSubject
{
    // Defina a tabela associada a este modelo
    protected $table = 'funcionarios';

    // Especifica os campos que são mass assignable
    protected $fillable = [
        'nome', 'email', 'cargo', 'foto', 'salario', 'desconto', 'senha'
    ];
// Define o relacionamento hasMany com o modelo Falta
public function faltas()
{
    return $this->hasMany(Falta::class);
}
    /**
     * Defina o método getAuthIdentifierName.
     * 
     * O método deve retornar o nome da chave primária do modelo.
     * No caso, o Laravel espera que você retorne o nome da chave primária da tabela.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';  // Ou o nome da chave primária da sua tabela, como 'funcionario_id'
    }

    /**
     * Defina o método getAuthIdentifier.
     * 
     * Este método retorna o identificador único (normalmente o 'id' do modelo).
     * 
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Defina o método getAuthPassword.
     * 
     * Este método deve retornar a senha do usuário.
     * 
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->senha;  // Retorna a senha armazenada na tabela
    }

    /**
     * Implementação do método getJWTIdentifier para o JWT.
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Implementação do método getJWTCustomClaims para o JWT.
     */
    public function getJWTCustomClaims()
    {
        return [
            'nome' => $this->nome,
            'email' => $this->email,
            'cargo' => $this->cargo,
        ];
    }
}
