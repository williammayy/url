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
                    <input name="enderecoUrl" type="text" class="form-control border-primary" placeholder="https://exemplo.com.br">
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
                    <table class="table table-ordered table-hover" id="tabelaUrl">
                        <thead>
                            <tr>
                                <th>URL</th>
                                <th>Status <button class="btn btn-sm btn-outline-dark ">Atualizar</button></th>
                                <th>Visualização</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="{{asset('js/app.js')}}" type="text/javascript"></script>
        <script type="text/javascript">


            function montarLinha(url) {
var linha = "<tr>" +
                "<td>" + url.endereco + "</td>" +
                "<td>" + "</td>" +
                "<td>" + "</td>" +
                "<td>" +
              '<button class="btn btn-primary btn-sm" onclick="editar(' + url.id + ')"> Editar </button> ' +
              '<button class="btn btn-sm btn-danger" onclick="remover(' + url.id + ')"> Apagar </button> ' +
            "</td>" +
            "</tr>";
        return linha;
    }
            function carregarUrls(){
                $.getJSON('/api/', function(urls) {
                for(i=0;i<urls.length;i++) {
                    linha = montarLinha(urls[i]);
                    $('#tabelaUrl>tbody').append(linha);
                }
                });
            }

            $(function(){
                carregarUrls();
            })
        </script>
    </body>
</html>