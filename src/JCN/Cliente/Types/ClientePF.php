<?php
namespace JCN\Cliente\Types;
use JCN\Cliente\Cliente;
use JCN\Cliente\ClienteGrauImportancia;

class ClientePF extends Cliente implements ClienteGrauImportancia
{
    protected $cpf;


    public function __construct($codigo='',$nome='',$endereco='',$telefone='',$email='', $cpf='', $grau_importancia='', $endereco_cobranca='')
    {
        parent::__construct($codigo,$nome,$endereco,$telefone,$email,$endereco_cobranca);

        $this->setCpf($cpf)
             ->setGrauImportancia($grau_importancia)
             ->setTipo()
        ;
    }

    public function setTipo()
    {
        $this->tipo="PF";
        return $this;
    }

    public function setCpf($value)
    {
        $this->cpf = $value;
        return $this;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setGrauImportancia($valor)
    {
        $this->grau_importancia = $valor;
        return $this;
    }
    public function getGrauImportancia()
    {
        return $this->grau_importancia;
    }

}

?>