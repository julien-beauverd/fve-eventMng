<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layout.head')
</head>

<body>
    <div class="container-fluid">
        <header>
            <div class="row pb-5">
                <div class="col-3">
                    <img class="img-fluid float-right pt-5" src="{{URL::asset('/img/exclamation-gauche.png')}}"
                        width="120px" alt="point d'exclamation, logo de la fve">
                </div>
                <div class="col-6">
                    <div class="row" style="padding-top:120px;">
                        <div class="col-md-12 text-center" style="padding-left:0px;padding-right:0px;">
                            <img class="img-fluid" style="min-width:220px;margin-top:20px;" src="{{URL::asset('/img/logo.png')}}"
                                alt="logo">
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-3 mt-4">
                            <img class="img-fluid float-right" style="min-height:50px;min-width:20px;"
                                src="{{URL::asset('/img/fleche-verte.png')}}" alt="flèche verte">
                        </div>
                        <div class="col-9 mt-4 text-left p-0">
                            <h1 class="display-4">Erreur 404</h1>
                            <h6>Page non trouvée.</h6>
                            <h6>Désolé, nous ne trouvons pas la page que vous cherchez.</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1 pl-1 pt-1">
                            <a href="{{ url('eventList/asc') }}" class="btn btn-lg btn-success btn-block">Agenda</a>
                        </div>
                        <div class="col-md-6 pl-1 pr-1 pt-1">
                            <a href="{{ url('register') }}" class="btn btn-lg btn-success btn-block">Créer
                                un
                                compte</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1 pl-1 pt-1">
                            <a href="{{ url('about') }}" class="btn btn-lg btn-success btn-block">À
                                propos</a>
                        </div>
                        <div class="col-md-6 pl-1 pr-1 pt-1">
                            <a href="{{ url('login') }}" class="btn btn-lg btn-success btn-block">Se
                                connecter</a>
                        </div>
                    </div>
                </div>
                <div class="col-3 pr-0">
                    <img class="img-fluid float-right" src="{{URL::asset('/img/exclamation-droite.png')}}" width="200px"
                        height="100%" alt="point d'exclamation, logo de la fve">
                </div>
            </div>
        </header>
    </div>
    @include('layout.footer')
</body>

</html>