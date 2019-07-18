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
            <div style="background-image: url('{{URL::asset('/img/connexion.jpg')}}');background-size: cover;">

                <div id="content">
                    @include('layout.nav-responsive')
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 mt-4 pt-5 mb-2 pb-2">
                                <div class="d-flex justify-content-center h-100">
                                    <div class="card mb-5" style="height: auto;">
                                        <div class="card-header">
                                            <h3>Se connecter</h3>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf
                                                <div class="input-group form-group">
                                                    <div class="btn-success input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-envelope"></i></span>
                                                    </div>
                                                    <input id="email" type="email" placeholder="adresse email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ old('email') }}" required
                                                        autocomplete="email" autofocus>

                                                    @error('email')
                                                    <span class="invalid-feedback text-white">
                                                        <strong>{{$message}}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="input-group form-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                                    </div>
                                                    <input id="password" type="password" placeholder="mot de passe"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" required autocomplete="current-password">

                                                    @error('password')
                                                    <span class="invalid-feedback text-white" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="row align-items-center remember">
                                                    <input type="checkbox" name="remember" id="remember"
                                                        {{ old('remember') ? 'checked' : '' }}>
                                                    Rester connecté
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn float-right btn-success btn-md">
                                                        Se connecter
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="card-footer">
                                            <div class="d-flex justify-content-center">
                                                @if (Route::has('password.request'))
                                                <a class="text-white" href="{{ route('password.request') }}">
                                                    Vous avez oublié votre mot de passe ?
                                                </a>
                                                @endif
                                            </div>
                                            <div class="d-flex justify-content-center links">
                                                <a class="text-white" href="{{ url('register') }}">Créer un compte</a>
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