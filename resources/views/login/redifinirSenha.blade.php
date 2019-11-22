<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/formulario_1.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/font-awesome.css">
</head>
<body>
	<div id="principal3">
        <form method="post" action="codigo">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div id="embaixo2" class="mx-auto container-fluid">
                <p><b>Redifina a senha, preenchendo os espacos abaixos
                introduzindo a nova senha que pretende usar</b></p>
                <p><input type="text" class="textField" name="novasenha" placeholder="Nova senha"></p>
                <p><input type="text" class="textField" name="novasenha" placeholder="Confirmar senha"></p>
                <button type="button" class="btn btn-success">Confirmar senha</button>
            </div>
        </form>
	</div>
</body>
</html>
