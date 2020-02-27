@extends('layout')
@section('link')
{{-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
@endsection
@section('content')
<h2 class="ui dividing header"><i class="clipboard list icon"></i>ASSIGNATIONS</h2>

<div class="ui container">
    <div class="ui grid container">
        <div class="twelve wide column">
            {{Breadcrumbs::render('assignations')}}
        </div>
        <div class="two wide column"><a onclick="modalExport()" class="orange ui labeled icon button">
                <i class="icon file pdf outline"></i>export</a>
        </div>
        <div class="two wide column"><a href="{{route('assignations_add')}}" class="blue ui labeled icon button"><i class="plus icon"></i>Ajouter</a></div>
    </div>
    <div class="ui divider"></div>
    <table id="tableau" class="ui celled selectable right aligned table">
        <thead>
            <th class="left aligned">Enseignants</th>
            <th>Filières</th>
            <th>Ues</th>
            <th>Niveau</th>
            <th>CM</th>
            <th>TD</th>
            <th>TP</th>
            <th>Option</th>
        </thead>
        <tbody>
            @forelse ($assignements as $assignement)
            <tr>
                <td class="left aligned"><a href="{{route('enseignant_show',$assignement->id)}}">{{$assignement->titre.' '.$assignement->nomination}}</a></td>
                <td>{{$assignement->filiere}}</td>
                <td><a href="{{route('ues_show',$assignement->ue)}}">{{$assignement->libelle}}</a></td>
                <td>{{$assignement->niveau}}</td>
                <td>{{$assignement->cm}}</td>
                <td>{{$assignement->td}}</td>
                <td>{{$assignement->tp}}</td>
                <td>
                    <a href="{{route('assignations_alter',['enseignant' => $assignement->id,'ue'=>$assignement->ue ])}}"><i class="large edit icon"></i></a>
                    <a onclick="modalIt({{$assignement->id}},{{$assignement->ue}})"><i class="large trash alternate icon red"></i></a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">AUCUNE DONNEE TROUVEE</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div id="suppression" class="ui basic modal">
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
<div id="exportation" class="ui basic modal other">
    <div class="ui icon header">
        <i class="icon file pdf outline"></i>
        Téléchager PDF
    </div>
    <div class="content">
        <p>Vous pouvez télécharger le rapport globale de répartition selon les unités d'enseignement ou selon les enseignants.</p>
    </div>
    <div class="actions">
        <div class="ui purple basic cancel inverted button">
            <i class="file alternate icon"></i>
            pdf/UE
        </div>
        <div class="ui yellow ok inverted button">
            <i class="file alternate icon"></i>
            pdf/enseignant
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
    function modalIt(enseignant, ue) {
        $('#suppression')
            .modal({
                closable: false,
                onDeny: function() {
                    return true;
                },
                onApprove: function() {
                    location.href = '/home/assignations/' + enseignant + '/' + ue + '/delete';
                }
            })
            .modal('show');
    }
</script>
<script type="text/javascript">
    function modalExport() {
        $('#exportation')
            .modal({
                closable: true,
                onDeny: function() {
                    location.href = '/home/generate/ue';
                },
                onApprove: function() {
                    location.href = '/home/generate/enseignant';
                }
            })
            .modal('show');
    }
</script>
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
        const elt = document.getElementById('message');
        if (elt) {
            const message = elt.getElementsByTagName('span')[0].textContent
            const type = elt.getElementsByTagName('em')[0].textContent

            if (message) {

                new Noty({
                    type: type,
                    layout: 'topRight',
                    theme: 'semanticui',
                    text: message,
                    timeout: '4000',
                    closeWith: ['click'],
                    animation: {
                        open: 'animated fadeInRight',
                        close: 'animated fadeOutRight'
                    }
                }).show();
            }
        }
    });
</script>
@endsection
