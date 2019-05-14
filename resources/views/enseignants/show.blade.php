@extends('layout')
@section('link')
{{-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet"> --}}

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

@endsection
@section('content')
@php
    $grades = ['AUCUN' => 'SANS GRADE' ,
               'A' => 'ASSISTANT',
               'MA' => 'MAITRE ASSISTANT',
               'MC' => 'MAITRE DE CONFERENCE',
               'PT' =>'PROFESSEUR TITULAIRE'
              ] ;
@endphp
<div class="ui container grid">
    <div class="seven wide column">
        <div class="ui card">
            <div class="content">
                <div class="header">{{$enseignant->nomination}}</div>
            </div>
            <div class="content">
                <h4 class="ui sub header">{{$grades[$enseignant->grade]}}</h4>
                <div class="ui small feed">
                    <div class="event">
                        <div class="content">
                            <div class="summary">
                                <strong>Statut:</strong>{{$enseignant->statut}}
                            </div>
                        </div>
                    </div>
                    <div class="event">
                        <div class="content">
                            <div class="summary">
                                <strong>Telephone:</strong> {{$enseignant->phone}}
                            </div>
                        </div>
                    </div>
                    <div class="event">
                        <div class="content">
                            <div class="summary">
                                <strong>Email:</strong> {{$enseignant->email}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div onclick="devoiler()" class="ui bottom attached button green">
                <i class="crosshairs icon"></i>
                voir repartition par UE
            </div>
        </div>
    </div>
    <div id="repartition" hidden class="nine wide column">
        <div class="nine wide column">
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
                    @foreach ($enseignant->ues as $ue)
                    <tr>
                        <td>{{ $ue->libelle }}</td>
                        <td>{{ $ue->pivot->cm }}</td>
                        <td>{{ $ue->pivot->td }}</td>
                        <td>{{ $ue->pivot->tp }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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