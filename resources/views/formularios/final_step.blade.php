<html>
    <head>
         <title>Final-Step</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="generator" content="Mobirise v4.8.2, mobirise.com">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
        <meta name="description" content="">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/style.css">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/font-awesome.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="css/formulario_1.css">
    </head>

    <body >
        <div class = "text-center bg-light border border-warning rounded " id="info_area">
            <!--Printer button-->
            <button class = "btn btn-primary position-absolute mt-2" id="imprimir">imprimir<i class = "fa fa-print" id="printer"></i></button>

            <!--Success Icon-->
            <i class="fa fa-check fa-6x text-success mt-5"></i>
            <h3 class="font-weight-bold">Pré-Inscrição Feita Com Sucesso!</h3>

            <!--Coming from database
                Dados de registo actuais-->
            <div class="ml-5 text-left ">

                <!--Dados pessoais-->
                @foreach ($users as $user )
                    <label for="name" class = "font-weight-bold">Nome Completo: </label>{{$user->nome}} &ensp; {{$user->apelido}}
                @endforeach
                @foreach ( $encarregado as $encarreg )
                    &nbsp;<label for="birth" class = "font-weight-bold">Password: </label>{{$encarreg->password}}
                @endforeach



                <!--Dados do bank-->
                <p>Para Finalizar a Inscrição deve efectuar o depósito [BCI]:</p>

                @foreach ($entidade as $entida )
                     <label class="font-weight-bold">ENTIDADE: </label>{{$entida->entidade}}
                @endforeach

                @foreach ( $referencia as $ref)
                    <label class="font-weight-bold">REFERÊNCIA: </label>{{$ref->referencia}} <br>
                @endforeach

                <hr class="text-center mr-5 border border-secondary">
                <a class = "text-warning font-weight-bold" href = #>Clique aqui para efectuar o pagamento pelo M-pesa</a> <br><br>
		        <p>
                    <span class = "font-weight-bold">Valor a Depositar:</span> 1800.00 Meticais
		            <br>Nota: O Valor deve ser depositado dentro de 2 semanas!!!
		            <br>Após o deposito dirija-se a Escolinha para validar inscrição - <a target="_blank" href="https://www.google.com/maps/place/Sanana+School/@-25.9669987,32.5849517,15z/data=!4m5!3m4!1s0x0:0x2322c9b3c6a948f3!8m2!3d-25.9669987!4d32.5849517"> localização</a>
                </p>
	        </div>
        </div>
        <div class = "mt-2" id="botoes">
            <button class = "btn btn-dark" id="imprimir">voltar<i class = "fa fa-arrow-left fa-1x" id="printer"></i></button>
            <button class = "btn btn-danger" id = "cancel">Cancelar</button>
        <a href="login1">
                <button class = "btn btn-success">Finalizar</button>
        </a>
        </div>



    </body>
</html>
