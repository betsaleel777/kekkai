@extends('layout')
@section('content')
<h2 class="ui dividing header">AJOUTER UN ENSEIGNANT</h2>
<form id="assignForm" class="ui form" action="{{route('assignations_insert')}}" method="post">
    @csrf
    <div class="field">
        <div class="ui fluid search selection dropdown">
            <input type="hidden" name="enseignant_id">
            <i class="dropdown icon"></i>
            <div class="default text">Enseignant</div>
            <div class="menu">
                @foreach ($enseignants as $enseignant)
                <div class="item" data-value="{{$enseignant->id}}">{{$enseignant->nomination}}</div>
                @endforeach
            </div>
        </div>
        {!!$errors->first('enseignant_id','<p style="color:#a94442">:message</p>')!!}
    </div>
    <div class="field">
        <div id="ue_field"  onchange="assign()" class="ui fluid multiple search selection dropdown">
            <input id="ue_select" type="hidden" name="ue_id">
            <i class="dropdown icon"></i>
            <div class="default text">Unité d'enseignement</div>
            <div class="menu">
                @foreach ($ues as $ue)
                <div class="item" data-value="{{$ue->id}}">{{$ue->libelle}}</div>
                @endforeach
            </div>
        </div>
        {!!$errors->first('ue_id','<p style="color:#a94442">:message</p>')!!}
    </div>
    <div id="area" class="ui four column grid"></div>
    <div class="field">
        <button type="submit" class="ui labeled submit icon button"><i class="icon send"></i>envoyer</button>
    </div>
</form>
@endsection

@section('java-script')
<script type="text/javascript">
    $(document).ready(function() {
        $('.search.selection.dropdown').dropdown({
            maxSelections: '4',
            clearable: true,
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.multiple.search.selection.dropdown').dropdown({
            maxSelections: '4',
            allowAdditions: true,
        });
    });

</script>
<script src="{{asset('semantic-theme/js/assign.js')}}"></script>
<script src="{{asset('semantic-theme/js/erase.js')}}"></script>
<script src="{{asset('semantic-theme/js/ajax/assigner.js')}}"></script>
@endsection