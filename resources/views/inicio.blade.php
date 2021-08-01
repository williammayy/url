<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>URLs</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <style>
            body{
                margin-top: 10px;
            }
        </style>

    </head>
    <body>
        <div class="container">

            <h2 class="text-center">Cadastre sua URL</h2>
            <form action="/" method="POST">
                @csrf

                <div class="input-group input-group-lg">
                    <input name="enderecoUrl" type="text" required class="form-control border-primary" placeholder="https://exemplo.com.br">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit">Cadastrar</button>
                    </div>


                </div>
            </form>

            <div class="card border" style="margin-top:20px;">
                <div class="card-body">
                    <h5 class="card-title">
                        URLs cadastradas
                    </h5>
                    <table class="table table-ordered table-hover text-center" id="tabelaUrl">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>URL</th>
                                <th>Status  <button class="btn btn-sm btn-outline-warning" onclick="verificarOnline()"><img src="{{asset('img/refresh.png')}}" width="20px" height="20px"></button></th>
                                <th>Visualização<br>(sem imagens)</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="dlgUrl">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" id="formUrl">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Url</h5>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" id="id" class="form-control">
                            <div class="form-group">
                                <label for="enderecoUrlModal" class="control-label">URL</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" required id="enderecoUrlModal" placeholder="https://exemplo.com.br">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="{{asset('js/app.js')}}" type="text/javascript"></script>

        <script type="text/javascript">


            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':"{{csrf_token()}}"
                }
            });

            function verificarOnline(){
                $.getJSON('/api/verificaonline/', function(data) {
                    console.log(data);
                    for(i=0;i<data.length;i++){
                    idhtml="verifica"+data[i].id;
                    document.getElementById(idhtml).innerHTML = data[i].codigo;
                    }
                });
            }


            function montarLinha(url) {
var linha = "<tr>" +
                "<td>" + url.id + "</td>" +
                "<td>" + url.endereco + "</td>" +
                "<td>" + "<div id= \"verifica"+url.id+"\"> ... </div></td>" +
                "<td>" + '<a target="_blank" href="/visualizar/'+url.id+'"><img src="{{asset('img/lupa.png')}}" width="20px" height="20px"></a>'  + "</td>" +
                "<td>" +
              '<button class="btn btn-primary btn-sm" onClick="editar('+url.id+')"> Editar </button> ' +
              '<button class="btn btn-sm btn-danger" onClick="remover(' + url.id + ')"> Apagar </button> ' +
            "</td>" +
            "</tr>";
        return linha;
    }

    function editar(id) {
        $.getJSON('/api/url/'+id, function(data) {
            $('#id').val(data.id);
            $('#enderecoUrlModal').val(data.endereco);
            $('#dlgUrl').modal('show');
        });
    }

    function salvarUrl() {
        url = {
            id : $("#id").val(),
            endereco: $("#enderecoUrlModal").val(),
        };
        $.ajax({
            type: "PUT",
            url: "/api/url/" + url.id,
            context: this,
            data: url,
            success: function(data) {
                url = JSON.parse(data);
                linhas = $("#tabelaUrl>tbody>tr");
                e = linhas.filter( function(i, e) {
                    return ( e.cells[0].textContent == url.id );
                });
                if (e) {
                    e[0].cells[0].textContent = url.id;
                    e[0].cells[1].textContent = url.endereco;
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
        verificarOnline();
    }

    $("#formUrl").submit( function(event){
        event.preventDefault();
        salvarUrl();
        $("#dlgUrl").modal('hide');
    });

    function remover(id) {
        $.ajax({
            type: "DELETE",
            url: "/api/url/"+id,
            context: this,
            success: function() {

                linhas = $("#tabelaUrl>tbody>tr");
                e = linhas.filter( function(i, elemento) {
                    return elemento.cells[0].textContent == id;
                });
                if (e)
                    e.remove();
            },
            error: function(error) {
                console.log(error);
            }
        });
        verificarOnline();
    }


            function carregarUrls(){
                $.getJSON('/api/url', function(urls) {
                for(i=0;i<urls.length;i++) {
                    linha = montarLinha(urls[i]);
                    $('#tabelaUrl>tbody').append(linha);
                }
                });
            }



            $(function(){
                carregarUrls();
                verificarOnline();
            })
        </script>
    </body>
</html>