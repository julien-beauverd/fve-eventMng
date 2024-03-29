<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    @include('layout.head')
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/register.js') }}"></script>

</head>

<body id="page-top" class="sidebar-toggled">
    <div class="modal fade" id="Modalregister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Validation
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Votre compte a bien été crée.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick="window.location.href = '{{ url('/login') }}';">Aller à la page de connexion</button>
                </div>
            </div>
        </div>
    </div>
    <div id="wrapper">
        @include('layout.nav-mobile')
        <div id="content-wrapper" class="d-flex flex-column">
            @include('layout.nav')

            <div id="content"
                style="background-image: url('{{URL::asset('/img/register.png')}}');background-size: cover;">
                @include('layout.nav-responsive')
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 mt-2 pt-2 mb-0 pb-0">
                            <div class="d-flex justify-content-center h-100">
                                <div class="card ml-1 mr-1 mb-3" style="height: auto;">
                                    <div class="card-header">
                                        <h3>Créer un compte</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="input-group form-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                                </div>
                                                <input id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    value="{{ old('name') }}" placeholder="nom" required
                                                    autocomplete="name" autofocus>

                                                @error('name')
                                                <span class="invalid-feedback text-white" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="input-group form-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                                </div>
                                                <input id="first_name" type="text"
                                                    class="form-control @error('first_name') is-invalid @enderror"
                                                    name="first_name" value="{{ old('first_name') }}" required
                                                    autocomplete="first_name" placeholder="prénom">

                                                @error('first_name')
                                                <span class="invalid-feedback text-white" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="input-group form-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-building text-info"></i></span>
                                                </div>
                                                <input id="company_name" type="text"
                                                    class="form-control @error('company_name') is-invalid @enderror"
                                                    name="company_name" value="{{ old('company_name') }}" required
                                                    autocomplete="company_name" placeholder="nom de l'entreprise">

                                                @error('company_name')
                                                <span class="invalid-feedback text-white" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="input-group form-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-envelope text-info"></i></span>
                                                </div>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" placeholder="adresse email"
                                                    required autocomplete="email">

                                                @error('email')
                                                <span class="invalid-feedback text-white" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="input-group form-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-key text-info"></i></span>
                                                </div>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="new-password"
                                                    placeholder="mot de passe">
                                                @error('password')
                                                <span class="invalid-feedback text-white" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="input-group form-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-key text-info"></i></span>
                                                </div>
                                                <input id="password_confirm" type="password" class="form-control"
                                                    name="password_confirmation" required autocomplete="new-password"
                                                    placeholder="confirmer le mot de passe">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit"
                                                    class="btn float-right btn-success btn-md btn-block">
                                                    Créer un compte
                                                </button>
                                            </div>
                                            <div class="text-white mt-2" style="padding-top:60px">
                                                <p class="mb-0" style="font-size:15px;">Le mot de passe doit respecter les critères
                                                    suivants:</p>
                                                <ul style="padding-left:18px;font-size:15px;margin-bottom:0px!important;">
                                                    <li>minimum 8 caractères</li>
                                                    <li>minimum 1 chiffre</li>
                                                    <li>minimum 1 minuscule</li>
                                                    <li>minimum 1 majuscule</li>
                                                </ul>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="registerOK" style="display:none;">
                                        @error('OK') {{ $message }}@enderror
                                    </div>
                                    <div class=" card-footer">
                                        <div class="d-flex justify-content-center links">
                                            <a class="text-white" href="{{ url('login') }}">Vous avez déjà un compte
                                                ?</a>
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