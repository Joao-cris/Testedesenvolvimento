<?php

namespace App\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;


class Falta extends Model
{
    // Definir a tabela associada
    protected $table = 'faltas';

    // Definir os campos que são passíveis de atribuição em massa
    protected $fillable = [
        'data_inicio',
        'data_fim',
        'justificada',
        'tipo_falta',
        'justificativo_arquivo',
        'funcionario_id',
        'comentario',
        'countfaltas',
        'aprovacao',
        'valordesconto'
    ];

    // Definir o relacionamento com a tabela de Funcionarios
    public function funcionario()
    {
        return $this->belongsTo('App\Infrastructure\Models\Funcionario');
    }

    // Método para mapear o modelo Eloquent para a entidade Falta
   
}
