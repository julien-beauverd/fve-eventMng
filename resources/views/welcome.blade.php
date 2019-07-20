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
                    <img class="img-fluid float-right" src="{{URL::asset('/img/exclamation-gauche.png')}}" width="120px"
                        alt="point d'exclamation, logo de la fve">
                </div>
                <div class="col-6">
                    <div class="row pt-5">
                        <div class="col-md-12 text-center">
                            <img class="img-fluid" style="min-width:180px;" src="{{URL::asset('/img/logo.png')}}"
                                alt="logo">
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-3 mt-4">
                            <img class="img-fluid float-right" style="min-height:50px;min-width:20px;"
                                src="{{URL::asset('/img/fleche-verte.png')}}" alt="flèche verte">
                        </div>
                        <div class="col-9 mt-4 text-left p-0">
                            <p class="mb-1">
                                Bienvenue sur l'application web
                            </p>
                            <p class="mb-1">
                                des événements de la fédération
                            </p>
                            <p class="mb-5">
                                vaudoise des entrepreneurs
                            </p>
                        </div>
                    </div>
                    <div class="row mb-1">
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
    <div id="popup_iOS" class="alert alert-success" role="alert" style="display:none;">
        <p>Vous pouvez installer cette application web sur votre iPhone. Cliquez sur <img class="img-fluid ml-2 mr-2"
                src="{{URL::asset('/img/share_button_ios.png')}}" alt="bouton partage iOS">
            et ensuite sur
            "Ajouter à
            l'écran d'accueil".</p>
    </div>
    @include('layout.footer')

    <script>
        // Detects if device is on iOS 
    const isIos = () => {
        const userAgent = window.navigator.userAgent.toLowerCase();
        return /iphone|ipad|ipod/.test(userAgent);
    }
    // Detects if device is in standalone mode
    const isInStandaloneMode = () => ('standalone' in window.navigator) && (window.navigator.standalone);

    // Checks if should display install popup notification:
    if (isIos() && !isInStandaloneMode()) {
        document.getElementById('popup_iOS').style.display = 'flex';
    }
    </script>
</body>

</html>