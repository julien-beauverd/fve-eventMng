<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    @include('layout.head')
    <script src="{{ asset('js/scripts.js') }}"></script>

</head>

<body id="page-top" class="sidebar-toggled">

    <div id="wrapper">
        @include('layout.nav-mobile')
        <div id="content-wrapper" class="d-flex flex-column">
            @include('layout.nav')
            <div style="background-image: url('{{URL::asset('/img/verify.jpg')}}');background-size: cover;">
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

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 mt-4 pt-5 mb-2 pb-2">
                                <div class="d-flex justify-content-center h-100">
                                    <div class="card" style="height: auto;">
                                        <div class="card-header">
                                            <h5 class="text-white">Afin de profiter pleinement de toutes les
                                                fonctionalités, vous devez confirmer votre email.</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="input-group form-group text-white">

                                                <p>Pour cela, cliquez sur le lien dans l'e-mail de validation que vous
                                                    avez reçu
                                                    dans votre boîte de réception.
                                                </p>

                                                <a class="text-white mt-3"
                                                    href="{{ route('verification.resend') }}">Cliquer ici pour
                                                    envoyer un nouveau lien de validation.</a>

                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="d-flex justify-content-center">
                                                @if (session('resent'))
                                                <div class="alert alert-success" role="alert">
                                                    Un nouveau lien a été envoyé à votre adresse email.
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
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