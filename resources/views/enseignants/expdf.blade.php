<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>{{$title}}</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>

<body>
    @php
    $grades = ['AUCUN' => 'SANS GRADE' ,
    'A' => 'ASSISTANT',
    'MA' => 'MAITRE ASSISTANT',
    'MC' => 'MAITRE DE CONFERENCE',
    'PT' =>'PROFESSEUR TITULAIRE'
    ] ;
    @endphp

    <div style="font-size:18px" class="ui container">
        @foreach ($enseignants_sans_repetition as ['infos' => $enseignant,'ues' => $ues])
        {{-- affichage des informations de l'enseignant --}}
        <center style="margin-top:100px">
            <h2>{{$enseignant->nomination}}</h2>
        </center>
        <div class="ui grid">
          <div class="two wide column"></div>
          <div class="twelve wide column">
            <p><b>Grade :</b>{{$grades[$enseignant->grade]}}</p>
            <p><b>Statut :</b>{{$enseignant->statut}}</p>
            <p><b>Téléphone :</b>{{$enseignant->phone}}</p>
            <p><b>Email :</b>{{$enseignant->email}}</p>
          </div>
          <div class="two wide column"></div>
        </div>

        {{-- affichage des heures assignées --}}
        <center style="margin-top:50px">
            <h2>Assignation</h2>
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
                        @foreach ($ues as $ue)
                            <tr>
                              <td>{{ $ue->libelle }}</td>
                              <td>{{ $ue->cm.' h' }}</td>
                              <td>{{ $ue->td.' h' }}</td>
                              <td>{{ $ue->tp.' h' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        @php
                        $cm = 0 ;
                        $td = 0 ;
                        $tp = 0 ;
                        //calcul des totaux
                        foreach ($enseignant->ues as $ue){
                        $cm += $ue->pivot->cm ;
                        $td += $ue->pivot->td ;
                        $tp += $ue->pivot->tp ;
                        }
                        $total = ['cm' => $cm,'td' => $td,'tp' => $tp ] ;
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
        @endforeach
    </div>
</body>

</html>
