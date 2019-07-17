<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    @include('layout.head')
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <style>

    </style>
</head>

<body id="page-top" class="sidebar-toggled">

    <div id="wrapper">
        @include('layout.nav-mobile')
        <div id="content-wrapper" class="d-flex flex-column">
            @include('layout.nav')
            <div style="background-image: url('{{URL::asset('/img/verify.jpg')}}');background-size: cover">
                <div id="content">
                    <!-- Topbar -->
                    <nav class="d-lg-none navbar navbar-expand navbar-light bg-white topbar static-top shadow">
                        <div class="col-1">
                            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>
                        <div class="col-11">
                            <a
                                class="sidebar-brand d-flex align-items-center justify-content-center p-0 d-lg-none rounded-circle mr-3">
                                <div><img src="{{URL::asset('/img/logo.png')}}" width="200em" class="float-right"></div>
                            </a>
                        </div>
                    </nav>

                    <div class="container-fluid" style="min-height:600px;">
                        <div class="row usefulLink">
                            <div class="col-md-6 p-4">
                                <h2 class="text-center">
                                    e-shop de la fve
                                </h2>
                                <p>
                                    La fédération vaudoise des entrepreneurs a développé depuis peu un e-shop mettant en
                                    vente de
                                    nombreux produits.
                                </p>
                                <p>
                                    <a class="float-right list-item doc text-success btn"
                                        href="https://www.fve.ch/accueil.html">lien du e-shop <i
                                            class="fas fa-external-link-alt"></i></a>
                                </p>
                            </div>
                            <div class="col-md-6 p-4">
                                <h2 class="text-center">
                                    Les offres de formation continue
                                </h2>
                                <p>
                                    Vous trouverez sur le lien suivant les offres de formation continue proposées par la
                                    fédération vaudoise des entrepreneurs. Celles-ci couvrent tous les secteurs d’une
                                    entreprise,
                                    afin de répondre aux attentes de la direction, des cadres, des collaborateurs
                                    techniques et
                                    administratifs.
                                </p>
                                <p>
                                    <a class="float-right list-item doc text-success btn"
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