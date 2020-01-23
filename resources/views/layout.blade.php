@include('head')

<body>
    @include('flash')
    <div class="ui container">
        <!-- menu start  -->
        <div class="ui inverted menu">
          {{-- class="active item" --}}
            <a href="{{route('start')}}" class="header item">Acceuil</a>
            <a href="{{route('enseignant_index')}}" class="item">Enseignant</a>
            <a href="{{route('ues_index')}}" class="item">Ues</a>
            <a href="{{route('assignations_index')}}" class="item">Assignation</a>
            {{-- <div class="ui dropdown item">
                Parametres
                <i class="dropdown icon"></i>
                <div class="menu">
                    <div class="item">Action</div>
                    <div class="item">Another Action</div>
                    <div class="item">Something else here</div>
                    <div class="divider"></div>
                    <div class="item">Separated Link</div>
                    <div class="divider"></div>
                    <div class="item">One more separated link</div>
                </div>
            </div> --}}
            {{-- <div class="right menu">
                <div class="item">
                    <div class="ui transparent inverted icon input">
                        <i class="search icon"></i>
                        <input type="text" placeholder="Search">
                    </div>
                </div>
                <a class="item">Link</a>
            </div> --}}
        </div>
        <!-- menu end  -->
        <div id="app">
          <!-- content start  -->
          @yield('content')
          <!-- content end  -->
        </div>
        <!--footer start  -->
        <footer>
            <div class="ui inverted segment container">
                <center>
                    <p>powered by CodeBySpirit 2019</p>
                </center>
            </div>
        </footer>
        <!--footer end  -->
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>
<script type="text/javascript" src="{{asset('semantic-theme/assets/semantic/components/popup.js')}}"></script>
<!--- Component JS -->
<script type="text/javascript" src="{{asset('semantic-theme/assets/semantic/components/transition.js')}}"></script>
<script type="text/javascript" src="{{asset('semantic-theme/assets/semantic/components/dropdown.js')}}"></script>
<script type="text/javascript" src="{{asset('semantic-theme/assets/semantic/semantic.min.js')}}"></script>
@yield('java-script')
</html>
