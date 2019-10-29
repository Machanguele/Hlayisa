<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Dados do aluno</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/formulario_1.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/font-awesome.css">

</head>


<body>

    <button id="inicio" class="btn">
        <i class="fa fa-chevron-left fa-2x"></i><span>Inicio</span>
    </button>

    <div class="border border rounded" id="form">
        <form method="post" id="inscricao" action="comentario@gmail.com">

            <fieldset id="dp" class="ml-4 mr-4 mt-4 mb-4">
                <legend>Dados do Aluno</legend>
                <div class="form-group row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-2">
                                <label>Nome</label>
                            </div>

                            <div class="col-8">
                                <input class="form-control" type="text" name="tNome" id="idNome" placeholder="Nome">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-2">
                                <label>Apelido</label>
                            </div>

                            <div class="col-8">
                                <input class="form-control" type="text" name="tApelido" id="idApelido" placeholder="Apelido">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-2">
                                <label>Genero</label>
                            </div>

                            <div class="col-4">
                                <div class="radio">
                                    <input type="radio" name="optradio">Masculino
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="radio">
                                    <input type="radio" name="optradio">Feminino
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">

                                <fieldset id="FSendereco">
                                    <legend>Endereco</legend>

                                    <div class="row">
                                        <div class="col-3">
                                            <label>Bairro</label>
                                        </div>

                                        <div class="col-7">
                                            <input class="form-control fa" type="text" name="tBairro" id="idBairro" placeholder="Bairro">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-3">
                                            <label>Avenida</label>
                                        </div>

                                        <div class="col-7">
                                            <input class="form-control fa" type="text" name="tAven" id="idAven" placeholder="Avenida">
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-3">
                                            <label>Rua</label>
                                        </div>

                                        <div class="col-7">
                                            <input class="form-control fa" type="text" name="tRua" id="idRua" placeholder="Rua">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-3">
                                            <label>Quarteirao</label>
                                        </div>

                                        <div class="col-7">
                                            <input class="form-control fa" type="text" name="tQuart" id="idQuart" placeholder="Quarteirao">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-3">
                                            <label>Nr. da Casa</label>
                                        </div>

                                        <div class="col-7">
                                            <input class="form-control fa" type="number" name="tcasa" id="idcasa" placeholder="Casa nr...">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-3">
                                <label>Necessidade Especial</label>
                                <div class="radio"><input type="radio" name="optradio">Sim</div>
                                <div class="radio"><input type="radio" name="optradio">Nao</div>
                                <textarea class="form-control-fa mt-3" rows="8" cols="40" id="comment" placeholder="Descricao"></textarea>
                            </div>

                            <div class="col-3">
                                <i class="fa fa-user-plus fa-4x"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-5">
                                <label>Doc. de Identificacao</label>
                            </div>

                            <div class="col-3">
                                <select class="form-control fa">
                                    <option>B.I</option>
                                    <option>Cedula</option>
                                    <option>Passaporte</option>
                                </select>
                            </div>

                            <div class="col-4">
                                <input class="form-control" type="text" name="tnrID" id="idnrID" placeholder="Nr. do documento">
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>


    <div class="form-group row mt-4">
        <div class="col-12">
            <div class="row">
                <div class="col-4">
                    <nav aria-label="..." id="pag0">
                        <ul class="pagination pagination-md">
                            <li class="page-item disabled"><a href="#" class="page-link" tabindex="-1">1</a></li>
                            <li class="page-item"><a href="#" class="page-link">2</a></li>
                            <li class="page-item"><a href="#" class="page-link">3</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="col-4">
                    <button class="btn" id="depois0">
                        <span>Proximo</span>
                        <i id="seta" class="fa fa-arrow-circle-right fa-3x"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
