<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
  @include('layout.head')
  <script src="{{ asset('js/scripts.js') }}"></script>
</head>

<body id="page-top" class="sidebar-toggled">
  <div id="wrapper">
    @include('layout.nav-mobile')
    <div id="content-wrapper" class="d-flex flex-column">
      @include('layout.nav')
      <div id="content" style="background-image: url('{{URL::asset('/img/verify.jpg')}}');background-size: cover;">
        @include('layout.nav-responsive')
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 mt-2 pt-2 mb-0 pb-0">
              <div class="d-flex justify-content-center h-100 mb-5">
                <div class="card ml-1 mr-1" style="height: auto;">
                  <div class="card-header">
                    <h3>Modifier son compte</h3>
                  </div>
                  <div class="card-body">

                    {{ Form::open(array('url' => '/profile/edit/'.Auth::User()->id.'', 'method' => 'PUT', 'class'=>'col-md-12')) }}
                    @csrf
                    <div class="input-group form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i
                            class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                      </div>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{Auth::User()->name}}" placeholder="nom" required autocomplete="name" autofocus>

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
                      <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                        name="first_name" value="{{Auth::User()->first_name}}" required autocomplete="first_name"
                        placeholder="prénom">

                      @error('first_name')
                      <span class="invalid-feedback text-white" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="input-group form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-building text-info"></i></span>
                      </div>
                      <input id="company_name" type="text"
                        class="form-control @error('company_name') is-invalid @enderror" name="company_name"
                        value="{{Auth::User()->company_name}}" required autocomplete="company_name"
                        placeholder="nom de l'entreprise">

                      @error('company_name')
                      <span class="invalid-feedback text-white" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="input-group form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope text-info"></i></span>
                      </div>
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{Auth::User()->email}}" placeholder="adresse email" required
                        autocomplete="email">

                      @error('email')
                      <span class="invalid-feedback text-white" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <!-- if the user want to change the password, go to logout and reset password -->
                    <div class="input-group form-group">
                      <a class="btnProfile btn btn-outline-success form-control" href="{{ route('logout') }}"
                        style="border-radius: 4px;"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Changer de mot de passe
                      </a>

                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn float-right btn-success btn-md btn-block">
                        Valider les changements
                      </button>
                    </div>
                    {{ Form::close() }}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
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