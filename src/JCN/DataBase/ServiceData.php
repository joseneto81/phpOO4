<?php
namespace JCN\DataBase;
class ServiceData
{

    private $db;
    private $stmt;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function find($id)
    {
        $query = "Select * from clientes where id=:id";

        $this->stmt = $this->db->prepare($query);
        $this->stmt->bindValue(":id", $id);
        $this->stmt->execute();

        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function listar($ordem = null)
    {
        if($ordem)
        { $query = "Select * from tb_cliente order by $ordem"; }
        else
        { $query = "Select * from tb_cliente"; }

        $this->stmt = $this->db->query($query);
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function persist($cliente)
    {
        if($cliente->getTipo()=='PF')
            $campo = "cpf_cnpj";
        else
            $campo = "cpf_cnpj";

        $query = "INSERT INTO tb_cliente ( nome,endereco,telefone,email,$campo,grau_importancia,endereco_cobranca,tipo ) VALUES (:nome,:endereco,:telefone,:email,:$campo,:grau_importancia,:endereco_cobranca,:tipo)";

        $this->stmt = $this->db->prepare($query);
        $this->stmt->bindValue(':nome', $cliente->getNome());
        $this->stmt->bindValue(':endereco', $cliente->getEndereco());
        $this->stmt->bindValue(':email', $cliente->getEmail());
        $this->stmt->bindValue(':telefone', $cliente->getTelefone());


        if($cliente->getTipo()=='PF')
            $this->stmt->bindValue(':cpf_cnpj', $cliente->getCpf());
        else
            $this->stmt->bindValue(':cpf_cnpj', $cliente->getCnpj());

        $this->stmt->bindValue(':grau_importancia', $cliente->getGrauImportancia());
        $this->stmt->bindValue(':endereco_cobranca', $cliente->getEnderecoCobranca());
        $this->stmt->bindValue(':tipo', $cliente->getTipo());
/*
        if($stmt->execute())
        {
            return true;
        }
        print_r($stmt->errorInfo());
*/
    }

    public function flush()
    {
        if($this->stmt->execute())
        {
            return true;
        }
        print_r($this->stmt->errorInfo());
    }

    public function alterar()
    {
        $query = "Update clientes set nome=:nome,endereco=:endereco,telefone=:telefone,email=:email,$campo=:$campo,grau_importancia=:grau_importancia,endereco_cobranca=:endereco_cobranca,tipo=:tipo Where id=:id";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $cliente->getNome());
        $stmt->bindValue(':endereco', $cliente->getEndereco());
        $stmt->bindValue(':telefone', $cliente->getTelefone());

        if($cliente->getTipo()=='PF')
            $stmt->bindValue(':cpf_cnpj', $cliente->getCpf());
        else
            $stmt->bindValue(':cpf_cnpj', $cliente->getCnpj());

        $stmt->bindValue(':grau_importancia', $cliente->getGrauImportancia());
        $stmt->bindValue(':endereco_cobranca', $cliente->getEnderecoCobranca());
        $stmt->bindValue(':tipo', $cliente->getTipo());

        if($stmt->execute())
        {
            return true;
        }
    }

    public function deletar($id)
    {
        $query = "delete from clientes where id=:id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);

        if($stmt->execute())
        {
            return true;
        }
    }

}