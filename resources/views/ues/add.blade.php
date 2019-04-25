@extends('layout')
@section('content')
<h2 class="ui dividing header">AJOUTER UNITE D'ENSEIGNEMENT (UE)</h2>
<form class="ui form" action="{{route('ues_insert')}}" method="post">
     @csrf
    <div class="field">
        <label>Libellé</label>
        <div class="ui labeled input">
            <input value="{{old('libelle')}}" type="text" name="libelle">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
    </div>
    <div class="field">
        <label>Filière</label>
        <div class="ui labeled input">
            <input value="{{old('filiere')}}" type="text" name="filiere">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
    </div>
    <div class="field">
        <label>Niveau</label>
        <div class="ui labeled input">
            <div class="ui selection dropdown labeled input">
                <input value="{{old('niveau')}}" type="hidden" name="niveau">
                <i class="dropdown icon"></i>
                <div class="default text">Niveau</div>
                <div class="menu">
                    <div class="item" data-value="licence 1">LICENCE 1</div>
                    <div class="item" data-value="licence 2">LICENCE 2</div>
                    <div class="item" data-value="licence 3">LICENCE 3</div>
                    <div class="item" data-value="master 1">MASTER 1</div>
                    <div class="item" data-value="master 2">MASTER 2</div>
                </div>
                <div class="red ui corner label">
                    <i class="asterisk icon"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="field">
        <label>UFR</label>
        <div class="ui labeled input">
            <input value="{{old('ufr')}}" type="text" name="ufr">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
    </div>
    <div class="field">
        <label>Nombre de groupe cours magistral (CM)</label>
        <div class="ui labeled input">
            <input value="{{old('nb_gr_cm')}}" type="text" name="nb_gr_cm">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
    </div>
    <div class="field">
        <label>
            Nombre de groupe travaux dirigés (TD)
        </label>
        <div class="ui labeled input">
            <input value="{{old('nb_gr_td')}}" type="text" name="nb_gr_td">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
    </div>
    <div class="field">
        <label>
            Nombre de groupe travaux pratiques (TP)
        </label>
        <div class="ui labeled input">
            <input value="{{old('nb_gr_tp')}}" type="text" name="nb_gr_tp">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
    </div>
    <div class="field">
        <label>
            Heures cours magistral(CM) par groupe
        </label>
        <div class="ui labeled input">
            <input value="{{old('heure_gr_cm')}}" type="text" name="heure_gr_cm">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
    </div>
    <div class="field">
        <label>
            Heures travaux dirigés(TD) par groupe
        </label>
        <div class="ui labeled input">
            <input value="{{old('heure_gr_td')}}" type="text" name="heure_gr_td">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
    </div>
    <div class="field">
        <label>
            Heures travaux pratiques(TP) par groupe
        </label>
        <div class="ui labeled input">
            <input value="{{old('heure_gr_tp')}}" type="text" name="heure_gr_tp">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
    </div>
    <button type="submit" class="ui labeled submit icon button">
        <i class="icon send"></i>envoyer
    </button>
</form>
@endsection
@section('java-script')
  <script>
      $(document).ready(function() {
          $('.ui.selection.dropdown').dropdown();
      });
  </script>
@endsection
