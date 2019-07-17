<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layout.head')
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <img class="img-fluid float-right" src="{{URL::asset('/img/exclamation-gauche.png')}}" width="120px"
                    alt="point d'exclamation, logo de la fve">
            </div>
            <div class="col-6">
                <div class="row pt-5">
                    <div class="col-md-12">
                        <img class="img-fluid" style="min-width:180px;" src="{{URL::asset('/img/logo.png')}}"
                            alt="logo">
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 mt-4">
                        <img class="img-fluid float-right" style="min-height:50px;min-width:20px;"
                            src="{{URL::asset('/img/fleche-verte.png')}}" alt="flèche verte">
                    </div>
                    <div class="col-10 mt-4">
                            <h1 class="display-4">404 ERROR</h1>
                            <h6>Page not found.</h6>
                            <h6>Sorry, we can’t find the page you were looking for.</h6>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-6 pr-1 pl-1 pt-1">
                        <a href="{{ url('eventList/asc') }}" type="button"
                            class="btn btn-lg btn-success btn-block">Agenda</a>
                    </div>
                    <div class="col-sm-6 pl-1 pr-1 pt-1">
                        <a href="{{ url('register') }}" type="button" class="btn btn-lg btn-success btn-block">Créer un
                            compte</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 pr-1 pl-1 pt-1">
                        <a href="{{ url('about') }}" type="button" class="btn btn-lg btn-success btn-block">À
                            propos</a>
                    </div>
                    <div class="col-sm-6 pl-1 pr-1 pt-1">
                        <a href="{{ url('login') }}" type="button" class="btn btn-lg btn-success btn-block">Se
                            connecter</a>
                    </div>
                </div>
            </div>
            <div class="col-3 pr-0">
                <img class="img-fluid float-right" src="{{URL::asset('/img/exclamation-droite.png')}}" width="200px"
                    alt="point d'exclamation, logo de la fve">
            </div>
        </div>
    </div>
    <div id="popup_iOS" class="alert alert-success" role="alert" style="display:none;">
        <p>Vous pouvez installer cette application web sur votre iPhone. Cliquez sur <img class="img-fluid ml-2 mr-2"
                src="{{URL::asset('/img/share_button_ios.png')}}" alt="bouton partage iOS" width="20px"> et ensuite sur
            "Ajouter à
            l'écran d'accueil".</p>
    </div>
    @include('layout.footer')
    <script src="{{URL::asset('/js/scripts.js')}}"></script>

</body>

</html>