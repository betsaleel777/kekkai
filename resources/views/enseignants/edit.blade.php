@extends('layout')
@section('content')
<h2 class="ui dividing header">Ajouter une unité d'enseignement (UE)</h2>
<form class="ui form" action="{{route('enseignant_update',$enseignant)}}">
   @csrf
   {{method_field('PUT')}}
    <div class="field">
        <label>Nom et Prenom:</label>
        <div class="ui labeled input">
            <input value="{{$enseignant->nomination}}" type="text" name="nomination">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
        {!!$errors->first('nomination','<p  style="color:#a94442">:message</p>')!!}
    </div>
    <div class="field">
        <label>Grade:</label>
        <div id="grade" class="ui selection dropdown labeled input">
            <input type="hidden" name="grade">
            <i class="dropdown icon"></i>
            <div class="default text">Grade</div>
            <div class="menu">
                <div class="item" data-value="AUCUN">non gradé</div>
                <div class="item" data-value="A">assistant</div>
                <div class="item" data-value="MA">maitre assistant</div>
                <div class="item" data-value="MC">maitre de conférence</div>
                <div class="item" data-value="PT">professeur titulaire</div>
            </div>
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
        {!!$errors->first('grade','<p  style="color:#a94442">:message</p>')!!}
    </div>
    <div class="field">
        <label>Statut:</label>
        <div class="ui labeled input">
            <input value="{{$enseignant->statut}}" type="text" name="statut">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
        {!!$errors->first('statut','<p  style="color:#a94442">:message</p>')!!}
    </div>
    <div class="field">
        <label>Titre:</label>
        <div id="titre" class="ui selection dropdown labeled input">
            <input type="hidden" name="titre">
            <i class="dropdown icon"></i>
            <div class="default text">Titre</div>
            <div class="menu">
                <div class="item" data-value="Dr">Docteur</div>
                <div class="item" data-value="Pr">Professeur</div>
                <div class="item" data-value="Mr">sans titre</div>
            </div>
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
        {!!$errors->first('titre','<p  style="color:#a94442">:message</p>')!!}
    </div>
    <div class="field">
        <label>Adresse mail:</label>
        <div class="ui labeled input">
            <input value="{{$enseignant->email}}" type="text" name="email">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
        {!!$errors->first('email','<p  style="color:#a94442">:message</p>')!!}
    </div>
    <div class="field">
        <label>Telephone:</label>
        <div class="ui labeled input">
            <input value="{{$enseignant->phone}}" type="text" name="phone">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
        {!!$errors->first('phone','<p  style="color:#a94442">:message</p>')!!}
    </div>
    <button type="submit" class="ui labeled submit icon button">
        <i class="icon send"></i>envoyer
    </button>
</form>
@endsection
@section('java-script')
  {{-- {{array_search($enseignant->grade,$enseignant::GRADES).','.$enseignant->titre}} --}}

  <script>
      $(document).ready(function() {
          $('#titre').dropdown('set selected', '{{$enseignant->titre}}' );
      });
  </script>
  <script>
      $(document).ready(function() {
          $('#grade').dropdown('set selected', '{{$enseignant->grade}}');
      });
  </script>
@endsection
