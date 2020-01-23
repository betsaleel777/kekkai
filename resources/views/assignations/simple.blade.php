@extends('layout')
@section('content')
<h2 class="ui dividing header">ASSIGNER DES UES</h2>
<center><mode-choice-component :page="'simple'"></mode-choice-component></center><br>
<form id="assignForm" class="ui form" action="{{route('assignations_simple_insert')}}" method="post">
    @csrf
    <div class="field">
        <div id="ue_field" class="ui fluid search selection dropdown">
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
            clearable: true,
        });
    });
</script>
<script src="{{asset('semantic-theme/js/ajax/infos.js')}}"></script>
<script src="{{asset('semantic-theme/js/ajax/verify.js')}}"></script>
<script src="{{asset('semantic-theme/js/notify.js')}}"></script>
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
@endsection
