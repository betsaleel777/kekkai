@extends('layout')
@section('content')
<h2 class="ui dividing header">AJOUTER UN ENSEIGNANT</h2>
<form id="assignForm" class="ui form" action="{{route('assignations_insert')}}" method="post">
    @csrf
    <div class="field">
        <div onchange="infos()" class="ui fluid search selection dropdown">
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
        <div id="ue_field" class="ui fluid multiple search selection dropdown">
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
    <div class="ui segment">
        <div class="ui two column very relaxed grid">
            <div class="column">
                <h4 class="ui horizontal divider header">
                    <i class="bar chart icon"></i>
                    enseignant infos
                </h4>
                <div id="teacher" class=""></div>
            </div>
            <div class="column">
                <h4 class="ui horizontal divider header">
                    <i class="tag icon"></i>
                    UE à assigner
                </h4>
                <div id="area" class="ui three column grid"></div>
            </div>
        </div>
        <div class="ui vertical divider">
             ET
        </div>
    </div>
    <center>
        <div class="field">
            <button style="margin-bottom:10px;margin-top:10px" id="button" type="submit" class="ui labeled submit icon button"><i class="icon send"></i>envoyer</button>
        </div>
    </center>
</form>
@endsection

@section('java-script')
<script type="text/javascript">
    $(document).ready(function() {
        $('.search.selection.dropdown').dropdown({
            maxSelections: '3',
            clearable: true,
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.multiple.search.selection.dropdown').dropdown({
            maxSelections: '3',
            allowAdditions: true,
        });
    });
</script>
<script src="{{asset('semantic-theme/js/assign.js')}}"></script>
<script src="{{asset('semantic-theme/js/erase.js')}}"></script>
<script src="{{asset('semantic-theme/js/ajax/infos.js')}}"></script>
<script src="{{asset('semantic-theme/js/ajax/verify.js')}}"></script>
<script src="{{asset('semantic-theme/js/ajax/assigner.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".multiple.search.selection.dropdown")
            .dropdown("setting", "onLabelRemove", (value, text) => {
                erase(value);
            });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".multiple.search.selection.dropdown")
            .dropdown("setting", "onAdd", () => {
                assign();
        });
    });
</script>
<script src="{{asset('semantic-theme/js/notify.js')}}"></script>
@endsection
