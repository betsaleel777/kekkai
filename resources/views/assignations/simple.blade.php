@extends('layout')
@section('content')
<h2 class="ui dividing header">ASSIGNER DES UES</h2>
<center>
    {{-- <div class="ui buttons">
        <a  href="{{route('assignations_add')}}" id="multiple" class="ui button">multiple</a>
        <div class="or"></div>
        <a href="{{route('assignations_simple_add')}}" id="simple" class="ui button">Simple</a>
    </div> --}}
    <mode-choice-component></mode-choice-component>
</center><br>
<form id="assignForm" class="ui form">
    @csrf
    <div class="ui grid container">
       <div class="ten wide column">
         <assign-dropdowns></assign-dropdowns>
         <attribution-hours></attribution-hours>
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
</form>
@endsection

@section('java-script')
{{-- <script type="text/javascript">
    $(document).ready(function() {
        $('.search.selection.dropdown').dropdown({
            clearable: true,
        });
    });
</script> --}}
<script src="{{asset('semantic-theme/js/ajax/infos.js')}}"></script>
<script src="{{asset('semantic-theme/js/ajax/verify.js')}}"></script>
<script src="{{asset('semantic-theme/js/notify.js')}}"></script>
{{-- <script type="text/javascript">
   $(document).ready(function(){
      let multiple = document.getElementById('multiple')
      let simple = document.getElementById('simple')
      const url = location.pathname
      if(url === '/home/assignations/add' ){
        multiple.className = 'ui positive button'
      }else if (url === '/home/assignations/simple/add') {
        simple.className = 'ui positive button'
      }
   })
</script> --}}
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
@endsection
