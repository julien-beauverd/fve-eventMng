<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    @include('layout.head')
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</head>

<body id="page-top" class="sidebar-toggled">
    <div id="wrapper">
        @include('layout.nav-mobile')
        <div id="content-wrapper" class="d-flex flex-column">
            @include('layout.nav')
            <div id="content">
                @include('layout.nav-responsive')
                <img class="img-fluid" src="{{URL::asset('/img/usefulLinks.png')}}" alt="useful links" width="100%">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 pt-5">
                            <h2 class="text-center">Liens utiles</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 d-flex ">
                            <div class="jumbotron card card-block docToDownload" style="max-width:none">
                                <h3>
                                    e-shop de la fve
                                </h3>
                                <p class="text-justify">
                                    La fédération vaudoise des entrepreneurs a développé depuis peu un e-shop mettant en
                                    vente de
                                    nombreux produits.
                                </p>
                                <p>
                                    <a class="float-right list-item doc text-success btn pl-0"
                                        style="position:absolute;bottom:15px"
                                        href="https://www.fve.ch/accueil.html">lien du e-shop <i
                                            class="fas fa-external-link-alt"></i></a>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex">
                            <div class="jumbotron card card-block docToDownload" style="max-width:none">
                                <h3>
                                    Les offres de formation continue
                                </h3>
                                <p class="text-justify">
                                    Vous trouverez sur le lien suivant les offres de formation continue proposées par la
                                    fédération vaudoise des entrepreneurs. Celles-ci couvrent tous les secteurs d’une
                                    entreprise,
                                    afin de répondre aux attentes de la direction, des cadres, des collaborateurs
                                    techniques et
                                    administratifs.
                                </p>
                                <p>
                                    <a class="float-right list-item doc text-success btn pl-0"
                                        style="position:absolute;bottom:15px"
                                        href="https://www.ecole-construction.ch/formations/formation-continue/">lien
                                        pour les
                                        formations <i class="fas fa-external-link-alt"></i></a>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- End of Main Content -->
            @include('layout.footer')
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
</body>

</html>