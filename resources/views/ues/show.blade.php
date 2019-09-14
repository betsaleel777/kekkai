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
                @foreach ($enseignant_sans_repetition as $enseignant)
                <tr>
                    <td>{{ $enseignant->nomination }}</td>
                    <td>{{ $enseignant->cm }}</td>
                    <td>{{ $enseignant->td }}</td>
                    <td>{{ $enseignant->tp }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td>TOTAL</td>
                {{-- cm line --}}
                @if ($rest['cm'] == 0)
                  <td class="negative"  data-tooltip="Maximum atteint!" data-position="bottom center">
                    {{$total['cm']}}
                  </td>
                @else
                  <td class="positive"  data-tooltip="il reste {{$rest['cm']}} heures" data-position="bottom center">
                    {{$total['cm']}}
                  </td>
                @endif
                {{-- td line --}}
                @if ($rest['td'] == 0)
                  <td class="negative"  data-tooltip="Maximum atteint!" data-position="bottom center">
                    {{$total['td']}}
                  </td>
                @else
                  <td class="positive"  data-tooltip="il reste {{$rest['td']}} heures" data-position="bottom center">
                    {{$total['td']}}
                  </td>
                @endif
                {{-- tp line --}}
                @if ($rest['tp'] == 0)
                  <td class="negative" data-tooltip="Maximum atteint!" data-position="bottom center">
                    {{$total['tp']}}
                  </td>
                @else
                  <td class="positive" data-tooltip="il reste {{$rest['tp']}} heures" data-position="bottom center">
                    {{$total['tp']}}
                  </td>
                @endif
              </tr>
            </tfoot>
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
<script>
        $(document).ready(function() {
         const elt = document.getElementById('message') ;
         if(elt){
             const message = elt.getElementsByTagName('span')[0].textContent
             const type = elt.getElementsByTagName('em')[0].textContent

             if(message){

                new Noty({
                type: type,
                layout: 'topRight',
                theme: 'semanticui',
                text: message,
                timeout: '4000',
                closeWith: ['click'],
                animation: {
                        open : 'animated fadeInRight',
                        close: 'animated fadeOutRight'
                    }
                }).show();
           }
         }
       }) ;
    </script>
@endsection
