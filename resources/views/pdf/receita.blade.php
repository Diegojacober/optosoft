<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$receita->nome}}</title>

</head>

<body>
    <style>
        .page-break {
            page-break-after: always;
        }

        .cardd {
            padding: 20px;
            background-color: rgb(243, 243, 243);
            margin-top: 35px;
            margin-bottom: 30px;
            border-radius: 20px;
            box-shadow: 2px 5px 15px black;
        }

        .card-head h4 {
            width: 100vw;
            text-align: center;
        }

        .tabela {
            border-radius: 10px;
        }

        table {
            width: 100vw;
            border: 1px solid black;
        }

        th {
            border: 1px solid black;
            height: 25px;
        }

        td {
            border: 1px solid black;
            height: 35px;
        }
    </style>

    <main class="container">
        <div style="display:flex;">
            <h2 align="center">LAUDO OPTOMÉTRICO: </h2>
            <h4 style="margin-left:600px;padding-top:0px;display:block">'.$data.'</h4>
        </div>
        <div style="background-color:#fff;margin-top:-40px" class="cardd">
            <div class="card-head">
                <h2>{{$receita->nome}}</h2><small>{{$receita->idade}} anos</small><br>
                <br><br>

            </div>

            <div class="card-body">
                <div class="table-responsive tabela">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>OLHO</th>
                                <th>ESFÉRICO</th>
                                <th>CILINDRICO</th>
                                <th>EIXO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>OD</td>
                                <td style="text-align:center">{{($receita->od_esferico != ' '  && $receita->od_esferico != '0') ? $receita->od_esferico : '---'}}</td>
                                <td style="text-align:center">{{($receita->od_cilindrico != ' ' && $receita->od_cilindrico != '0') ? $receita->od_cilindrico : '---'}}</td>
                                <td style="text-align:center">{{($receita->od_eixo != ' ' && $receita->od_eixo != '0') ? $receita->od_eixo : '---'}}</td>
                            </tr>
                            <tr>
                                <td>OE</td>
                                <td style="text-align:center">{{($receita->oe_esferico != ' ' && $receita->oe_esferico != '0') ? $receita->oe_esferico : '---'}}</td>
                                <td style="text-align:center">{{($receita->oe_cilindrico != ' ' && $receita->oe_cilindrico != '0') ? $receita->oe_cilindrico : '---'}}</td>
                                <td style="text-align:center">{{($receita->oe_eixo != ' '  && $receita->oe_eixo != '0') ? $receita->oe_eixo : '---'}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <div><b>@if ($receita->adicao !== '0' && $receita->adicao !== '' && $receita->adicao !== ' ')
                    Adição: {{$receita->adicao}}
                    @endif</b></div>

                </div>
            </div>
            <br><br>
            @if ($receita->obs !== '' && $receita->obs !== null)
            <div>Observação: {{$receita->obs}}</div>
            @endif
            
        </div>
        <hr>
    </main>
</body>
</html>
