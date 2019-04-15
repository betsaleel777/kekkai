@include('head')
<body>
        <!-- content start  -->
        @yield('content')
        <!-- content end  -->
</body>
<script type="text/javascript" src="{{asset('semantic-theme/assets/semantic/components/popup.js')}}"></script>
<!--- Component JS -->
<script type="text/javascript" src="{{asset('semantic-theme/assets/semantic/components/transition.js')}}"></script>
<script type="text/javascript" src="{{asset('semantic-theme/assets/semantic/components/dropdown.js')}}"></script>
@yield('java-script')
<script>
    $(document).ready(function() {
        $('.ui.selection.dropdown').dropdown();
    });
</script>
</html>
