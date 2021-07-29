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
            <form action="">


                <div class="input-group input-group-lg">
                    <input type="text" class="form-control border-primary" placeholder="https://exemplo.com.br">
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
                    <table class="table table-ordered table-hover">
                        <thead>
                            <tr>
                                <th>URL</th>
                                <th>Status</th>
                                <th>Visualização</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <script src="{{asset('js/app.js')}}" type="text/javascript"></script>
    </body>
</html>