<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Formulario</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="./bootstrap/css/bootstrap-responsive.css" rel="stylesheet" />
    <link href="./bootstrap/css/bootstrap.css" rel="stylesheet" media="screen" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="bootstrap/js/bootstrap.js" rel="stylesheet">

    <script src="bootstrap/js/jquery-ui-1.11.3/external/jquery/jquery.js"></script>
    <script src="bootstrap/js/jquery-ui-1.11.3/jquery-ui.js"></script>
    <link href="bootstrap/js/jquery-ui-1.11.3/jquery-ui.css" rel="stylesheet">
</head>
<?php

require_once("scripts/lista_clientes.php");


print'<div id="container" class="container">';


if(isset($_REQUEST["ordem"]) AND $_REQUEST["ordem"]=='down')
    { krsort($clientes); $ordem='up'; }
else
    $ordem = "down";

print "<table align='center' class='table table-bordered table-ordered table-hover'>
        <caption>LISTA DE CLIENTES</caption>
        <thead>
          <tr>
            <th width='5%'>
            </th>
            <th><a data='$ordem' class='icon-arrow-$ordem' href='./?ordem=$ordem' title='$ordem'></a>Código</th>
            <th>Tipo</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Importância</th>
           </tr>
        </thead>
        <tbody>
      ";

foreach($clientes as $id=>$cli)
    print "<tr>
             <td><button id='dialog-link-cliente' href='".$cli->getCodigo()."'><i id='' class='icon-user' href='$id'></i></button></td>
             <!--<td><a id='dialog-link-cliente' href='./lista_clientes.php?id=".$cli->getCodigo()."'><i id='' class='icon-user' href='$id'></i></a></td>-->
             <td align='center'>".$cli->getCodigo()."</td>
             <td>".$cli->getTipo()."</td>
             <td>".$cli->getNome()."</td>
             <td>".$cli->getEmail()."</td>
             <td>".$clientes[$id]->getGrauImportancia()." <span class='icon-star'></span></td>
            </tr>
          ";
print "</tbody></table>";
print "</div>";
?>
<div id="dialog" title="Detalhes"><p></p></div>

<script type="text/javascript">

// Link to open the dialog
$( " #dialog-link-cliente " ).click(function( event ) {
    $( "#dialog" ).dialog( "open" );
    var href = $( this ).attr('href');
    //alert(href);
    //$("#dialog").load('./index.html');
    $("#dialog").load('scripts/lista_clientes.php?id='+href);
    event.preventDefault();
});


$( "#dialog" ).dialog({
    autoOpen: false,
    width: 400,
    modal:true,
    position: { at: "top center-50" },
    draggable: true,
    buttons: [
        {
            text: "Ok",
            icons: {
                primary: "ui-icon-person"
            },
            click: function() {
                $( this ).dialog( "close" );
            }
        }
    ]
});
</script>