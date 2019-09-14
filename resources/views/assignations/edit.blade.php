@extends('layout')
@section('content')
<h2 class="ui dividing header">MODIFIER UNE ASSIGNATION</h2>
<form id="assignForm" class="ui form" action="{{route('assignations_update',['enseignant' => $enseignant->id,'ue'=>$ue_link->pivot->ue_id ])}}" method="post">
    @csrf
    <div class="field">
        <div id="enseignant" class="ui fluid search selection dropdown">
            <input type="hidden" name="enseignant_id">
            <i class="dropdown icon"></i>
            <div class="default text">Enseignant</div>
            <div class="menu">
                @foreach ($enseignants as $ens)
                <div class="item" data-value="{{$ens->id}}">{{$ens->nomination}}</div>
                @endforeach
            </div>
        </div>
        {!!$errors->first('enseignant_id','<p style="color:#a94442">:message</p>')!!}
    </div>
    <div class="field">
        <div id="ue" class="ui fluid search selection dropdown">
            <input type="hidden" name="ue_id">
            <i class="dropdown icon"></i>
            <div class="default text">UE</div>
            <div class="menu">
                @foreach ($ues as $ue)
                <div class="item" data-value="{{$ue->id}}">{{$ue->libelle}}</div>
                @endforeach
            </div>
        </div>
        {!!$errors->first('ue_id','<p style="color:#a94442">:message</p>')!!}
    </div>
    <div class="field">
        <label>heures CM attribuées:</label>
        <div class="ui labeled input">
            <input  onchange="check(this)" value="{{$ue_link->pivot->cm}}" type="text" name="cm">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
        <div id="cm_content">

        </div>
        {!!$errors->first('cm','<p style="color:#a94442">:message</p>')!!}
    </div>
    <div class="field">
        <label>Heures TD attribuées:</label>
        <div class="ui labeled input">
            <input onchange="check(this)" value="{{$ue_link->pivot->td}}" type="text" name="td">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
        <div id="td_content">

        </div>
        {!!$errors->first('td','<p style="color:#a94442">:message</p>')!!}
    </div>
    <div class="field">
        <label>Heures TP attribuées:</label>
        <div class="ui labeled input">
            <input onchange="check(this)" value="{{$ue_link->pivot->tp}}" type="text" name="tp">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
        <div id="tp_content">

        </div>
        {!!$errors->first('tp','<p style="color:#a94442">:message</p>')!!}
    </div>
    <div class="field">
        <button id="button" type="submit" class="ui labeled submit icon button"><i class="icon send"></i>envoyer</button>
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
<script>
    $(document).ready(function() {
        $('#enseignant').dropdown('set selected', '{{$enseignant->id}}');
    });
</script>
<script>
    $(document).ready(function() {
        $('#ue').dropdown('set selected', '{{$ue_link->id}}');
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
<script src="{{asset('semantic-theme/js/ajax/check.js')}}"></script>
@endsection
