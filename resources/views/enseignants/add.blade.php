@extends('layout')
@section('content')
<h2 class="ui dividing header">AJOUTER UN ENSEIGNANT</h2>
<form class="ui form" action="{{route('enseignant_insert')}}" method="post">
    @csrf
    <div class="field">
        <label>Nom et Prenom:</label>
        <div class="ui labeled input">
            <input value="{{old('nomination')}}" type="text" name="nomination">
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
        <div id="statut"  class="ui selection dropdown labeled input">
            <input type="hidden" name="statut">
            <i class="dropdown icon"></i>
            <div class="default text">Statut</div>
            <div class="menu">
                <div class="item" data-value="MONITEUR">moniteur</div>
                <div class="item" data-value="VACATAIRE">vacataire</div>
                <div class="item" data-value="PERMANENT">permanent</div>
            </div>
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
        {!!$errors->first('statut','<p  style="color:#a94442">:message</p>')!!}
    </div>
    <div class="field">
        <label>Adresse mail:</label>
        <div class="ui labeled input">
            <input value="{{old('email')}}" type="text" name="email">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
        {!!$errors->first('email','<p  style="color:#a94442">:message</p>')!!}
    </div>
    <div class="field">
        <label>Telephone:</label>
        <div class="ui labeled input">
            <input value="{{old('phone')}}" type="text" name="phone">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
        {!!$errors->first('phone','<p  style="color:#a94442">:message</p>')!!}
    </div>
    <div hidden class="field">
        <label>Titre:</label>
        <input id="titre" type="text" name="titre" value="">
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
  <script>
      $(document).ready(function() {
          $('#grade').dropdown('set selected', '{{old('grade')}}');
      });
  </script>
  <script>
      $(document).ready(function() {
          $('#statut').dropdown('set selected', '{{old('statut')}}');
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
