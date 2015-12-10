<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" href="images/themes/default/Favicon.ico" type="image/vnd.microsoft.icon" />
    <link rel="icon" type="image/png" href="images/themes/default/Introduction.png" />

    <title>Formulario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <script src="external/jquery/jquery.js"></script>
    <script src="jquery-ui.js"></script>
    <link href="jquery-ui.css" rel="stylesheet">

<style>
    #dialog-link {
        padding: .4em 1em .4em 20px;
        text-decoration: none;
        position: relative;
    }
    #dialog-link span.ui-icon {
        margin: 0 5px 0 0;
        position: absolute;
        left: .2em;
        top: 50%;
        margin-top: -8px;
    }

</style>

</head>
<a href="#" id="dialog-link" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>Open Dialog</a>

<div id="dialog" title="Dialog Title">
    <p>LLLLLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
</div>


<div id='container'>...</div>
    <a href="#" id="usuario1">usuário 1</a><br>



<!-- Accordion -->
<h2 class="demoHeaders">Accordion</h2>
<div id="accordion">
    <h3>First</h3>
    <div>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</div>
    <h3>Second</h3>
    <div>Phasellus mattis tincidunt nibh.</div>
    <h3>Third</h3>
    <div>Nam dui erat, auctor a, dignissim quis.</div>
</div>

<script type="text/javascript">


$( "#accordion" ).accordion();

$("#usuario1").click(function(){
        $("#container").load('./index.html');
    }
);

//$("a").load('index.html');

$("aa").click(function(){
    alert('ola');
    $.ajax({
        //type: "POST",
        url: 'jquery.php',
        //url: './grid_exemplo.php?DisplayPage='+form.DisplayPage.value+'&regpage='+form.regpage.value+'&teste=1',
//        data: dados,
        success: function() {
            alert('sucess');
            $('#container').html('/index.html');
       }
    });
});


// Link to open the dialog
$( "#dialog-link" ).click(function( event ) {
    $( "#dialog" ).dialog( "open" );
    event.preventDefault();
    $("#dialog").load('./index.html');
});


$( "#dialog" ).dialog({
    autoOpen: false,
    width: 400,
    buttons: [
        {
            text: "Ok",
            click: function() {
                $( this ).dialog( "close" );
            }
        },
        {
            text: "Cancel",
            click: function() {
                $( this ).dialog( "close" );
            }
        }
    ]
});
</script>
