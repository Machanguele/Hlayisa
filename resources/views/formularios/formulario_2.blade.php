<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Dados do Encarregado</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/formulario_1.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/font-awesome.css">

</head>


<body>
    <button id="inicio" class="btn">
        <i class="fa fa-chevron-left fa-2x"></i>
        <span>Inicio</span>
    </button>

    <div class="border border rounded" id="form">
        <form method="POST" id="inscricao1" action="encarregado.store">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <fieldset id="dp" class="ml-4 mr-4 mt-4 mb-4">
                <legend>Dados do Encarregado de Educ.</legend>
                <div class="form-group row">
                    <div class="col-6">
                        <div class="form-group row">
                            <div class="col-2">
                                <label>Nome</label>
                            </div>

                            <div class="col-8">
                                <input class="form-control" type="text" name="tNome" id="idNome" placeholder="Nome">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-2">
                                <label>Apelido</label>
                            </div>

                            <div class="col-8">
                                <input class="form-control" type="text" name="tApelido" id="idApelido" placeholder="Apelido">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-2">
                                <label>Data de Nasc.</label>
                            </div>

                            <div class="col-4">
                                <input class="form-control" type="date" value="2011-08-19" id="iDdate" name="idDate">
                            </div>

                            <div class="col-2">
                                <i class="fa fa-calendar fa-2x"></i>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-2">
                                <label>Genero</label>
                            </div>

                            <div class="col-4">
                                <div class="radio">
                                    <input type="radio" name="optradio" id="optradio" value="M">Masculino
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="radio">
                                    <input type="radio" name="optradio" id="optradio" value="F">Feminino
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-4">
                                <label>Doc. de Identificacao</label>
                            </div>

                            <div class="col-3">
                                <select class="form-control fa" name="tDocumento">
                                    <option>B.I</option>
                                    <option>Passaporte</option>
                                    <option>Carta de Conducao</option>
                                </select>
                            </div>

                            <div class="col-3">
                                <input class="form-control" type="text" name="tnrID" id="idnrID" placeholder="Nr. do documento">
                            </div>
                        </div>
                    </div>

                    <div class="col-6">

                        <i id="form2" class="fa fa-user-plus fa-5x"></i>

                        <fieldset id="FScontacto">
                            <legend>Contacto</legend>

                            <div class="row">
                                <div class="col-2">
                                    <label>Telefone</label>
                                </div>

                                <div class="col-3">
                                    <select class="form-control fa">
                                        <option>+258</option>
                                    </select>
                                </div>

                                <div class="col-4">
                                    <input class="form-control" type="number" name="tTel" id="idTel">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-2">
                                    <label>Celular</label>
                                </div>

                                <div class="col-7">
                                    <input class="form-control fa mt-2" type="number" name="tCel" id="idCel">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-2">
                                    <label>Email</label>
                                </div>

                                <div class="col-7">
                                    <input class="form-control fa mt-2" type="text" name="tMail" id="idmail">
                                </div>
                            </div>
                    </div>
            </fieldset>
    </div>
    </fieldset>

    </div>

    <!--<div class="form-group row mt-4">
        <div class="col-12">
            <div class="row">
                <div class="col-4">
                    <button class="btn" id="antes">
                        <i id="seta" class="fa fa-arrow-circle-left fa-3x"></i>
                        <span>Anterior</span>
                    </button>
                </div>

                <div class="col-4">
                    <nav aria-label="..." id="pag">
                        <ul class="pagination pagination-md">
                            <li class="page-item disabled"><a href="#" class="page-link" tabindex="-1">1</a></li>
                            <li class="page-item"><a href="#" class="page-link">2</a></li>
                            <li class="page-item"><a href="#" class="page-link">3</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="col-4">

                    <button class="btn" type="submit" id="depois">
                        <span>Proximo<span>
                                <i id="seta" class="fa fa-arrow-circle-right fa-3x"></i>
                    </button>
                </div>
            </div>
        </div>
        </form>
    </div>
</body>

</html>
