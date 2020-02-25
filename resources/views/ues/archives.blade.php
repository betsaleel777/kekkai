@extends('layout')
@section('link')
{{-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
@endsection
@section('content')
<h2 class="ui dividing header">UNITES D'ENSEIGNEMENT ARCHIVEES</h2>

<div class="ui container">
    <div class="ui grid container">
        <div class="fourteen wide column">
         {{Breadcrumbs::render('ues_trashed')}}
        </div>
        <div class="two wide column"><a href="{{route('ues_index')}}" class="blue ui labeled icon button"><i class="arrow circle left icon"></i>retour</a></div>
    </div>
    <div class="ui divider">
    </div>
    <table id="tableau" class="ui celled selectable right aligned table">
        <thead>
            <th class="left aligned">Libelle</th>
            <th>Filiere</th>
            <th>Ufr</th>
            <th>Niveau</th>
            <th>Options</th>
        </thead>
        <tbody>
            @forelse ($ues as $ue)
            <tr>
                <td class="left aligned">{{$ue->libelle}}</td>
                <td>{{$ue->filiere}}</td>
                <td>{{$ue->ufr}}</td>
                <td>{{$ue->niveau}}</td>
                <td>
                    <a href="{{route('ues_restore',$ue)}}"><i class="arrow up icon large"></i></a>
                    <a onclick="modalIt({{$ue->id}})"><i class="trash icon large blue"></i></a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">AUCUNE DONNEE TROUVEE</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="ui basic modal">
    <div class="ui icon header">
        <i class="trash icon red"></i>
        Suppression Définitive
    </div>
    <div class="content">
        <p>Cette action va supprimer définitivement l'element séléctionné. Voulez-vous vraiment cela ?</p>
    </div>
    <div class="actions">
        <div class="ui red basic cancel inverted button">
            <i class="remove icon"></i>
            NON
        </div>
        <div class="ui green ok inverted button">
            <i class="checkmark icon"></i>
            OUI
        </div>
    </div>
</div>
@endsection
@section('java-script')
{{-- <script src="//code.jquery.com/jquery-3.3.1.js"></script> --}}
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
<script type="text/javascript">
    function modalIt(id) {
        $('.ui.basic.modal')
            .modal({
                closable: false,
                onDeny: function() {
                    return true;
                },
                onApprove: function() {
                    location.href = '/home/ues/'+id+'/purge';
                }
            })
            .modal('show');
    }
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
