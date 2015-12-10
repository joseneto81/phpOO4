<?php
namespace JCN\Cliente;
use JCN\Cliente\Types\ClienteEnderecoCobranca;
abstract class Cliente implements ClienteEnderecoCobranca
{
    private $codigo;
    private $nome;
    //public $cpf;
    private $endereco;
    private $telefone;
    private $email;
    protected $tipo;
    private $endereco_cobranca;


    public function __construct($codigo='',$nome='',$endereco='',$telefone='',$email='', $endereco_cobranca='')
    {
        $this->setCodigo($codigo)
             ->setNome($nome)
             ->setEndereco($endereco)
             ->setTelefone($telefone)
             ->setEmail($email)
             //->setTipo($tipo)
             ->setEnderecoCobranca($endereco_cobranca)
        ;
    }


    public function set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function get($atributo)
    {
        return $this->$atributo;
    }

    public function setCodigo($valor)
    {
        $this->codigo = $valor;
        return $this;
    }

    public function setNome($valor)
    {
        $this->nome = $valor;
        return $this;
    }

    public function setEndereco($valor)
    {
        $this->endereco = $valor;
        return $this;
    }

    public function setTelefone($valor)
    {
        $this->telefone = $valor;
        return $this;
    }

    public function setEmail($valor)
    {
        $this->email = $valor;
        return $this;
    }

    /*
    public function setTipo($valor)
    {
        $this->tipo = $valor;
        return $this;
    }
    */

    //tipo de pessoa sera implemenado em cada classe em particular
    abstract function setTipo();


    public function setEnderecoCobranca($valor)
    {
        $this->endereco_cobranca = $valor;
        return $this;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTipo()
    {
        return $this->tipo;
    }
    public function getEnderecoCobranca()
    {
        return $this->endereco_cobranca;
    }

}
?>