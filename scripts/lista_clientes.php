<?php
define("CLASS_DIR","$_SERVER[DOCUMENT_ROOT]/phpOO4/src/"); //utilizei document_root apenas porque o index esta na raiz dele
set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
spl_autoload_register(function ($class) {
    require_once(str_replace('\\', '/', $class . '.php'));
});

use JCN\Cliente\Types\ClientePF;
use JCN\Cliente\Types\ClientePJ;
use JCN\DataBase\ServiceData;
use JCN\DataBase\Conexao;

require_once("JCN/DataBase/Config.php");

$conexao=new Conexao("$HOST", "$PORT", "$DB", "$USER", "$PASS");
$serviceDb = new ServiceData($conexao->connect());
FOREACH($serviceDb->listar() as $cli)
{
    if($cli['tipo']=='PF')
        $clientes[$cli['codigo']] = new ClientePF($cli['codigo'],$cli['nome'],$cli['endereco'],$cli['telefone'],$cli['email'],$cli['codigo'],$cli['cpf_cnpj'],$cli['grau_importancia'],$cli['endereco_cobranca'],$cli['tipo']);
    else
        $clientes[$cli['codigo']] = new ClientePJ($cli['codigo'],$cli['nome'],$cli['endereco'],$cli['telefone'],$cli['email'],$cli['codigo'],$cli['cpf_cnpj'],$cli['grau_importancia'],$cli['endereco_cobranca'],$cli['tipo']);
}

/*
    $clientes[1]  = new ClientePF("1" ,"João Carlos Fernandes", "Rua Cinco de Maio, 987","(21) 99876-5432","joao.calos@gmail.com","123.123.123-12", "5", "Rua de Cobrança, 123");
    $clientes[2]  = new ClientePJ("2" ,"Marta Valéria LTDA","Rua Cinco de Maio, 87","(21) 98589-4578","marcaval23@terra.com.br", "33.333.333.0001-11","4", "Endereço de Cobraça, 444");
    $clientes[3]  = new ClientePF("3" ,"Homer Simpson","Rua 3 de Março, 7","(21) 96541-7412","homersimpson@burnes.com", "555.555.555-52","4", "");
    $clientes[4]  = new ClientePJ("4" ,"Seu Madruga","Av Dom Pedro, 97","(21) 97452-0012","madruguinha@hotmail.com", "99.999.999/0001-92","3", "Rua Rio Branco, 102 Sala 203");
    $clientes[5]  = new ClientePF("5" ,"Dona Florinda","Rua 1 de Janeiro, 963","(21) 99876-5432","donaflorinda@yahoo.com.br", "887.887.887-54","1", "Rua treze de Maio, 445" );
    $clientes[6]  = new ClientePJ("6" ,"Zeca Urubu","Rua Sete de Setembro, 777","(21) 99801-5427","zeca.urubu@ig.com.br", "22.211.222/0001-33", "5", "Endereço de Cobranca 2");
    $clientes[7]  = new ClientePF("7" ,"Simone dos Santos","Av 15 de Novembro, 141","(22) 99876-4100","simonedossantos42@globo.com", "444.555.777-55", "3", "");
    $clientes[8]  = new ClientePJ("8" ,"Ronaldo Nazário de Lima","Alameda Lacerda, 859","(21) 32165-9845","ronaldor9@@r9.com", "44.144.124/0001-44", "1", "Rua novo Endereço de Cobranca, 665");
    $clientes[9]  = new ClientePF("9" ,"Roberto Carlos Coelho","Av Sete de Setembro, 414","(21) 99876-5432","robertocoelho@uol.com.br", "987.987.987-54","1", "");
    $clientes[10] = new ClientePJ("10","Albertina Bonfim","Rua Dois, 44","(22) 2745-5478","albertina.bonfim@gmail.com", "45.456.456/0001-45", "2", "Endereço do Trabalho");
*/

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    print "<fieldset>
            <legend>Dados do Cliente:</legend>
           <table>";
    print "<tr><td>Nome:</td><td>".$clientes[$id]->getNome()."</td></tr>";
    print "<tr><td>Tipo:</td><td>".$clientes[$id]->getTipo()."</td></tr>";
    if($clientes[$id] instanceof ClientePF )
        print "<tr><td>CPF: </td><td>".$clientes[$id]->getCpf()."</td></tr>";
    elseif($clientes[$id] instanceof ClientePJ)
        print "<tr><td>CPF: </td><td>".$clientes[$id]->getCnpj()."</td></tr>";
    print "<tr><td>Endereço: </td><td>".$clientes[$id]->getEndereco()."</td></tr>";
    print "<tr><td>End.Cobrança: </td><td>".$clientes[$id]->getEnderecoCobranca()."</td></tr>";
    print "<tr><td>Telefone: </td><td>".$clientes[$id]->getTelefone()."</td></tr>";
    print "<tr><td>E-mail: </td><td>".$clientes[$id]->getEmail()."</td></tr>";
    print "<tr><td>Importância: </td><td>".$clientes[$id]->getGrauImportancia()." <span class='icon-star'></span></td></tr>";
    print "</fieldset>";

}

?>