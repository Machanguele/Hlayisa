<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/formulario_1.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/font-awesome.css">
	<title></title>
</head>
<body>
	<div id="principal">
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
    <form method="POST" action="login">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div id="embaixo" class="mx-auto container-fluid">
			<i class="fas fa-user"></i>
			<h2>HLAYISA</h2>
			<div class="input-group margin-bottom-sm textField mx-auto container-fluid">
 				 <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
 				 <input class="form-control" type="text" name='Tmail' placeholder="Email address">
			</div>
			<div class="input-group textField mx-auto container-fluid">
  			<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
 			 <input class="form-control" type="password" name='password' placeholder="Password">
			</div>
				<p>
                    <a href="recuperar">Recuperar a Senha</a>
                    <button class=" button btn btn-dark btn-sm" type="submit" >Login</button>
			    </p>
		    </div>
	    </div>
    </form>
</body>
</html>
