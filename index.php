<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Compre Já</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <!--IMPORTANDO JQUERY VALIDATE-->
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
        <style>
            .error{
                 color:red
           }
       </style>
    </head>
    <body>
        <div class="container">
            <div class="row" style="margin:30px 0">
                <div class="col-lg-3">
                    <img src="img/logo.png" class="img-thumbnail">
                </div>
                <div class="col-lg-9">
                    <h3>Nome do Produto</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6" id="form-container">

                    <form id="step_1" method="post" action="index.php" class="form-step">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    Preencha seus dados para receber contato
                                </div>
                            </div>
                            <div class="panel-body">
                                <fieldset>
                                    <div class="row form-group">
                                        <div class="col-lg-6">
                                            <label>Nome Completo</label>
                                            <input class="form-control" type="text" name="nome" id="nome" required minlength="2">
                                        </div>

                                        <div class="col-lg-6">
                                            <label>Data de Nascimento</label>
                                            <input class="form-control" type="text" name="dataNascimento" id="dataNascimento" required>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-lg-6">
                                            <label>Email</label>
                                            <input class="form-control" type="text" name="email" id="email" required>
                                        </div>

                                        <div class="col-lg-6">
                                            <label>Telefone</label>
                                            <input class="form-control" type="text" name="telefone" id="telefone" required>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-lg btn-info next-step">Próximo Passo</button>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </form>

                    <form id="step_2" class="form-step" style="display:none">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    Preencha seus dados para receber contato
                                </div>
                            </div>
                            <div class="panel-body">
                                <fieldset>
                                    <div class="row form-group">
                                        <div class="col-lg-6">
                                            <label>Região</label>
                                            <select class="form-control" name="regiao">
                                                <option value="">Selecione a sua região</option>
                                                <option>Sul</option>
                                                <option>Sudeste</option>
                                                <option>Centro-Oeste</option>
                                                <option>Nordeste</option>
                                                <option>Norte</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-6">
                                            <label>Unidade</label>
                                            <select class="form-control" name="unidade">
                                                <option value="">Selecione a unidade mais próxima</option>
                                                <option>???</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-lg btn-info next-step">Enviar</button>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </form>

                    <div id="step_sucesso" class="form-step" style="display:none">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    Obrigado pelo cadastro!
                                </div>
                            </div>
                            <div class="panel-body">
                                Em breve você receberá uma ligação com mais informações!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h1>Chamada interessante para o produto</h1>
                    <h2>Mais uma informação relevante</h2>
                </div>
            </div>
        </div>
        <script>
           /*
            $(function () {
                $('.next-step').click(function (event) {
                    event.preventDefault();
                    $(this).parents('.form-step').hide().next().show();
                });
            }); */

            /*METODO PARA CAMPO NOME CONTER APENAS LETRAS*/
            $.validator.addMethod("alpha", function(value, element) { 
                return this.optional(element) || /^[A-Za-z]+$/.test(value)
            },"O campo nome só pode conter letras.");

            /*METODO PARA VALIDAR TELEFONE COM NONO DIGITO*/
            $.validator.addMethod("tel", function(value, element) {
                return this.optional(element) || /^9[0-9]{8}$/.test(value);
            },"Por favor insira o telefone com o 9º dígito.");
            
            /*METODO PARA VALIDAR DATA NO FORMATO BR*/
            $.validator.addMethod("dataBR", function(value, element) {
            if(value.length!=10) return false;
            var data       = value;
            var dia         = data.substr(0,2);
            var barra1   = data.substr(2,1);
            var mes        = data.substr(3,2);
            var barra2   = data.substr(5,1);
            var ano         = data.substr(6,4);
            if(data.length!=10||barra1!="/"||barra2!="/"||isNaN(dia)||isNaN(mes)||isNaN(ano)||dia>31||mes>12)return false;
            if((mes==4||mes==6||mes==9||mes==11) && dia==31)return false;
            if(mes==2  &&  (dia>29||(dia==29 && ano%4!=0)))return false;
            if(ano < 1900)return false;
            return true;
            }, "Informe uma data válida");

            /*METODO PARA VALIDAR CAMPOS COM JQUERY VALIDADE*/
            $("#step_1").validate({
                   rules : {
                         nome:{
                                required:true,
                                minlength:2,
                                alpha:true
                            },
                         email:{
                                required:true,
                                email:true
                            },
                        telefone:{
                                required:true,
                                number:true,
                                tel:true
                            },
                        dataNascimento:{
                                required:true,
                                dataBR:true        
                            }
                        },
                   messages:{
                         nome:{
                                required:"Por favor, informe seu nome",
                                minlength:"O nome deve ter pelo menos 2 caracteres"
                         },
                         email:{
                                required:"Por favor, informe seu email",
                                email: "Por favor, insira um email válido"
                         },
                         telefone:{
                                required:"Por favor, informe seu telefone",
                                number: "Por favor, insira um numero válido"       
                         },
                         dataNascimento:{
                                required:"Por favor insira uma data"
                         }
                   },
                   submitHandler: function(form){
                        var dados=$('#step_1').serialize();
                        console.log(dados);
                        $.ajax({
                            type:"POST",
                            url: "index.php",
                            data: dados,
                            success: function(data){
                                alert(data);
                            }
                        });
                        return false;
                   }
            });

        </script>
    </body>
</html>
