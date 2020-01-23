@extends('layout')
@section('link')
{{-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet"> --}}

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

@endsection
@section('content')
<h2 class="ui dividing header">ENSEIGNANTS ARCHIVES</h2>

<div class="ui container">
  <div class="ui grid container">
   <div class="twelve wide column">
   </div>
   <div class="four wide column">
     {{Breadcrumbs::render('enseignant_trashed')}}
   </div>
  </div>
    <div class="ui divider"></div>
    <table id="tableau" class="ui celled selectable right aligned table">
        <thead>
            <th class="left aligned">Nom et Prénom</th>
            <th>Grade</th>
            <th>Statut</th>
            <th>Téléphone</th>
            <th>Options</th>
        </thead>
        <tbody>
            @forelse ($enseignants as $enseignant)
            <tr>
                <td class="left aligned">{{$enseignant->titre.' '.$enseignant->nomination}}</td>
                <td>{{$enseignant->grade}}</td>
                <td>{{$enseignant->statut}}</td>
                <td>{{$enseignant->phone}}</td>
                <td>
                    <a href="{{route('enseignant_restore',$enseignant)}}"><i class="arrow up icon large"></i></a>
                    <a href="{{'/home/enseignant/'.$enseignant->id.'/purge'}}"><i class="trash icon large"></i></a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">AUCUNE DONNEE TROUVEE</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{-- <div id="modal" class="mini modal">
        <div class="header"><i class="trash alternate"></i>SUPRESSION</div>
        <div class="content">
            <p>Voulez vous supprimer definitivement cet enseignant ?</p>
        </div>
        <div class="actions">
            @if ($)
              <a href="{{'/home/enseignant/'.$enseignant->id.'/purge'}}"><i class="times icon"></i></a>
              <div class="ui cancel button">Annuler</div>
            @endif
        </div>
    </div> --}}
</div>
@endsection
@section('java-script')
<script src="//code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tableau').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel'
            ]
        })
    });
</script>
<script>
    $(document).ready(function() {
        $('#purge').click(function() {
            $('#modal').modal('show');
        });
    });
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
