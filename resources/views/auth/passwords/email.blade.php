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
            <div style="background-image: url('{{URL::asset('/img/password.jpg')}}');background-size: cover;">
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
                            <div class="col-md-12 mt-5 pt-5 mb-5 pb-5">
                                <div class="d-flex justify-content-center h-100">
                                    <div class="card" style="height: auto;">
                                        <div class="card-header">
                                            <h3>Réinitialiser le mot de passe</h3>
                                        </div>
                                        <div class="card-body">
                                            @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                            @endif
                                            <form method="POST" action="{{ route('password.email') }}">
                                                @csrf
                                                <div class="input-group form-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-envelope"></i></span>
                                                    </div>
                                                    <input id="email" type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ old('email') }}" required
                                                        autocomplete="email" autofocus placeholder="adresse email">
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn float-right btn-success btn-md">
                                                    Envoyer le lien de réinitialisation
                                                </button>
                                            </form>
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