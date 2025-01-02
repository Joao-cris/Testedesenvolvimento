<?php
namespace App\Core\Entities;

class Funcionario
{
    public $id;
    public $nome;
    public $email;
    public $cargo;
    public $foto;
    public $salario;
    public $desconto;
    public $senha;


    public function __construct($id, $nome, $email, $cargo,$foto,$salario,$desconto,$senha)
    {
        
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->cargo = $cargo;
        $this->foto = $foto;
        $this->salario = $salario;
        $this->desconto = $desconto;
        $this->senha =$senha;
        
    }
}
