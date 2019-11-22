@extends('templante.index1')
<html>
    <head>
        <title>childreen list</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="generator" content="Mobirise v4.8.2, mobirise.com">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
        <meta name="description" content="">
        <link rel="stylesheet" type="text/css" href="_bootstrap/css/style.css">
        <link rel="stylesheet" type="text/css" href="_bootstrap/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="_bootstrap/css/font-awesome.css">
        <link rel="stylesheet" href="_bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="_bootstrap/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="_css/estilo.css">

        <!-- ===================== JAVA SCRIPT ============================ -->

        <script>
          function seemore(id) {
            alert(id);
            window.open("final_step.php");

          }
        </script>

        <!-- ===================== JS END ============================ -->
    </head>

    <body>

    <!-- ===================== Drawing Table ===================== -->

        <table class = "border border-secondary" id="list_table" cellpadding="20">
            <thead>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Apelido</th>
                    <th>Contacto</th>
                    <th>Info</th>
            </thead>


            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><button class="btn btn-info" ></button></td>
            </tr>

        </table>
    <!-- ================= Drawing Table END ===================== -->
    </body>



</html>
