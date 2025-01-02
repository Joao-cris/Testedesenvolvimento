<?php

namespace App\Core\Entities;

class Falta
{
    public $id;
    public $data_inicio;
    public $data_fim;
    public $justificada;
    public $tipo_falta;
    public $justificativo_arquivo;
    public $funcionario_id;
    public $countfaltas;
    public $aprovacao;
    public $valordesconto;
    

    public function __construct($id, $data_inicio, $data_fim, $justificada, $tipo_falta, $justificativo_arquivo, $funcionario_id,$countfaltas,$aprovacao,$valordesconto)
    {
        $this->id = $id;
        $this->data_inicio = $data_inicio;
        $this->data_fim = $data_fim;
        $this->justificada = $justificada;
        $this->tipo_falta = $tipo_falta;
        $this->justificativo_arquivo = $justificativo_arquivo;
        $this->funcionario_id = $funcionario_id;
        $this->countfaltas = $countfaltas;
        $this->aprovacao= $aprovacao;
        $this->valordesconto=$valordesconto;
    }
}
