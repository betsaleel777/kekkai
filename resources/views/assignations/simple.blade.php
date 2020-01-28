@extends('layout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<h2 class="ui dividing header">ASSIGNER DES UES</h2>
<center>
    <mode-choice-component></mode-choice-component>
</center><br>
<div id="assignForm" class="ui form" >
    <div class="ui grid container">
       <div class="ten wide column">
         <assign-dropdowns></assign-dropdowns>
       </div>
       <div class="six wide column">
         <h4 class="ui horizontal divider header">
             <i class="compass icon"></i>
             Visualisation
         </h4>
         <ues-infos-table></ues-infos-table>
       </div>
    </div>
    <center>
        <send-button></send-button>
    </center>
</div>
@endsection

@section('java-script')
<script src="{{asset('semantic-theme/js/ajax/infos.js')}}"></script>
<script src="{{asset('semantic-theme/js/ajax/verify.js')}}"></script>
<script src="{{asset('semantic-theme/js/notify.js')}}"></script>
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
@endsection
