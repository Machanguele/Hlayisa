<!DOCTYPE html>
<html>
<head>
	<title>	</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/formulario_1.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/font-awesome.css">
</head>
<body>
<div id="principal2" >
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="#">HLAYISA</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="login">Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="formularioEncarregado">Pre-inscrição</a>
      </li>
    </ul>
  </div>
</nav>
<form method="post" action="codigo1">
    @csrf
	<div id="embaixo2" class="mx-auto container-fluid">
		<h2>Recuperar senha</h2>
		<p>Introduza o seu email</p>
        <p><input type="email" class="textField" name="email" placeholder="E-mail">
		</p>
		<button type="button" class="btn btn-success" type="submit">Confirmar</button>
		<a href="login"><button type="button" class="btn btn-danger" >Cancelar</button></a>
    </div>
</form>
</div>
</body>
</html>
