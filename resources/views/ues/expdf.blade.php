<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$title}}</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    @php
    $counter = 0 ;
    @endphp

    <div style="font-size:9px" class="ui container">
        @foreach ($ues_sans_repetition as $noRepeat)
        {{-- affichage des informations de l'enseignant --}}
        <center style="margin-top:100px">
            <h2>{{$ue_infos[$counter]['libelle']}}</h2>
        </center>
        <div class="ui grid">
            <div class="two wide column"></div>
            <div class="twelve wide column">
                <p><b>Filière :</b>{{$ue_infos[$counter]['filiere']}}</p>
                <p><b>Niveau :</b>{{$ue_infos[$counter]['niveau']}}</p>
                <p><b>Ufr :</b>{{$ue_infos[$counter]['ufr']}}</p>
                <p><b>Total CM :</b>{{$ue_infos[$counter]['heure_gr_cm']}}</p>
                <p><b>Total TD :</b>{{$ue_infos[$counter]['heure_gr_td']}}</p>
                <p><b>Total TP :</b>{{$ue_infos[$counter]['heure_gr_tp']}}</p>
            </div>
            <div class="two wide column"></div>
        </div>

        {{-- affichage des heures assignées --}}
        <center style="margin-top:50px">
            <h2>REPARTITION DES HEURES</h2>
        </center>
        <div class="ui grid">
            <div class="two wide column"></div>
            <div class="twelve wide column">
                <table id="tableau" class="ui blue celled table">
                    <thead>
                        <tr>
                            <th>UE</th>
                            <th>CM</th>
                            <th>TD</th>
                            <th>TP</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- affichage des ues avec les heures (repetition d'ue) --}}
                        @foreach ($noRepeat as $enseignant)
                        <tr>
                            <td>{{ $enseignant['nomination'] }}</td>
                            <td>{{ $enseignant['cm'].' h' }}</td>
                            <td>{{ $enseignant['td'].' h' }}</td>
                            <td>{{ $enseignant['tp'].' h' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        @php
                        $cm = 0 ;
                        $td = 0 ;
                        $tp = 0 ;
                        //calcul des totaux
                        foreach ($noRepeat as $enseignant){
                        $cm += $enseignant['cm'] ;
                        $td += $enseignant['td'] ;
                        $tp += $enseignant['tp'] ;
                        }
                        $total = ['cm' => $cm,'td' => $td,'tp' => $tp ] ;
                        ++$counter ;
                        @endphp
                        {{-- affichage des totaux calculé --}}
                        <tr class="positive">
                            <td>TOTAL</td>
                            <td>{{$total['cm'].' h'}}</td>
                            <td>{{$total['td'].' h'}}</td>
                            <td>{{$total['tp'].' h'}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="two wide column"></div>
        </div>
        @if ($counter%2 === 0)
        <div class="page-break"></div>
        @endif
        @endforeach
    </div>
</body>

</html>
