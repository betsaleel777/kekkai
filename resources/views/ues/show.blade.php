@extends('layout')
@section('link')
{{-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet"> --}}

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

@endsection
@section('content')
<div class="ui grid container">
    <div class="seven wide column">
        <div class="ui card">
            <div class="content">
                <div class="header">{{$ue->libelle}}</div>
            </div>
            <div class="content">
                <h4 class="ui sub header">{{$ue->ufr}}</h4>
                <div class="ui small feed">
                    <div class="event">
                        <div class="content">
                            <div class="summary">
                                <strong>Niveau:</strong>{{$ue->niveau}}
                            </div>
                        </div>
                    </div>
                    <div class="event">
                        <div class="content">
                            <div class="summary">
                                <strong>Groupe de CM:</strong>{{$ue->nb_gr_cm}}
                            </div>
                        </div>
                    </div>
                    <div class="event">
                        <div class="content">
                            <div class="summary">
                                <strong>Groupe de TD:</strong>{{$ue->nb_gr_td}}
                            </div>
                        </div>
                    </div>
                    <div class="event">
                        <div class="content">
                            <div class="summary">
                                <strong>Groupe de TP:</strong>{{$ue->nb_gr_tp}}
                            </div>
                        </div>
                    </div>
                    <div class="event">
                        <div class="content">
                            <div class="summary">
                                <strong>Heures/groupe CM:</strong>{{$ue->heure_gr_cm}}
                            </div>
                        </div>
                    </div>
                    <div class="event">
                        <div class="content">
                            <div class="summary">
                                <strong>Heures/groupe TD:</strong>{{$ue->heure_gr_td}}
                            </div>
                        </div>
                    </div>
                    <div class="event">
                        <div class="content">
                            <div class="summary">
                                <strong>Heures/groupe TP:</strong>{{$ue->heure_gr_tp}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div onclick="devoiler()" class="ui bottom attached button green">
                <i class="crosshairs icon"></i>
                voir repartition par enseignants
            </div>
        </div>
    </div>
    <div id="repartition" hidden class="nine wide column">
        <table id="tableau" class="ui blue celled table">
            <thead>
                <tr>
                    <th>Enseignant</th>
                    <th>CM</th>
                    <th>TD</th>
                    <th>TP</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ue->enseignants as $enseignant)
                <tr>
                    <td>{{ $enseignant->nomination }}</td>
                    <td>{{ $enseignant->pivot->cm }}</td>
                    <td>{{ $enseignant->pivot->td }}</td>
                    <td>{{ $enseignant->pivot->tp }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('java-script')
<script src="//code.jquery.com/jquery-3.3.1.js"></script>
<script src="{{asset('semantic-theme/js/devoiler.js')}}"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript">
    $(document).ready( function () {
    $('#tableau').DataTable({
      dom: 'Bfrtip',
        buttons: [
            'csv', 'excel'
        ]
    })
} );
</script>
@endsection