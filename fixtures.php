<?php
define('CLASS_DIR', 'src/');
set_include_path((get_include_path().PATH_SEPARATOR.CLASS_DIR));
spl_autoload_register(function($class) {
require_once(str_replace('\\','/',$class .'.php'));
});


use JCN\Cliente\Types\ClientePF;
use JCN\Cliente\Types\ClientePJ;
use JCN\Cliente\Cliente;
use JCN\DataBase\ServiceData;
use JCN\DataBase\Conexao;
/*
* Função para criar um banco de dados no pgsql.
*/
function conectar() {
$dsn = 'pgsql:dbname=template1;host=localhost;port=5432';
$user = "sisadmin";
$password = "s1sadm1n";
$banco = "testedb";
try {
$conexao = new \PDO($dsn, $user, $password);
// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$conexao->query("BEGIN");
$conexao->query("CREATE DATABASE $banco;");
print($conexao->errorCode());

if($conexao->errorCode() == 0)
  {
    print("O banco de dados foi criado com sucesso!<br>");

    $dsn = "pgsql:dbname=$banco;host=localhost;port=5432";
    $conexao = new \PDO($dsn, $user, $password);

    $sql ="CREATE TABLE tb_cliente(
    codigo SERIAL NOT NULL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    endereco VARCHAR(100) NOT NULL,
    telefone VARCHAR(18) NOT NULL,
    email VARCHAR(100) NOT NULL,
    cpf_cnpj VARCHAR(18) NOT NULL,
    grau_importancia VARCHAR(100) NOT NULL,
    endereco_cobranca VARCHAR(100) NOT NULL,
    tipo VARCHAR(2)
    );";
    $conexao->exec($sql);

    if($conexao->errorCode()==0)
        { print("Tabela cliente criada com sucesso!<br>"); }
    else
        { print_r(">>>>ERRO: ".$conexao->errorInfo()); }
  }
}
catch (PDOException $e)
{
    echo "<hr>Erro ao cadastrar no banco!<br />";
    die("Código: {$e->getCode()} <br> Mensagem: {$e->getMessage()}");
}
return $conexao;
}

conectar();

$cliente=new ClientePF();
$conexao=new Conexao("localhost", '5432', "testedb", "sisadmin", "s1sadm1n");
$cliente = new ClientePF('',"Seu Madruga", "Rua 171, 10", "(21)99955-8899", "seumadruga@uol.com.br", "111.222.333-44", "5", "Rua do Endereco de cobranca");


$serviceDb=new ServiceData($conexao->connect());
$serviceDb->persist($cliente);
$serviceDb->flush();
//**********************************************************
$cliente = new ClientePF('',"Dona Florinda", "Rua 10, 20", "(61) 8899-9595", "donaflorinda@gmail.com", "555.666.777-88", "3", "Rua Cobranca");
//inserir dados//
$serviceDb=new ServiceData($conexao->connect());
$serviceDb->persist($cliente);
$serviceDb->flush();

?>