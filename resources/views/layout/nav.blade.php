<div class="d-none d-lg-block">
  <div
    class="marge d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm container-fluid">
    <a class="my-0 mr-md-auto font-weight-normal" href="{{ url('/eventList/asc') }}"><img
        src="{{URL::asset('/img/logo.png')}}" width="350em" alt="logo du site événements de la fve"></a>
    <nav class="my-2 my-md-0 mr-md-3">
      @if(Auth::check() && Auth::User()->email_verified_at != null && Auth::User()->is_admin)
      <a class="p-2 text-dark text-uppercase"
        style="font-size:14px; border-right: 1px solid #31a85d;padding-top:0 !important;padding-bottom:0 !important;"
        href="{{ url('admin/dashboard') }}">Administrateur</a>
      @endif
      @if(Auth::check())
      <a class="p-2 text-dark text-uppercase"
        style="font-size:14px; border-right: 1px solid #31a85d;padding-top:0 !important;padding-bottom:0 !important;"
        href="{{ url('myEvents/'.Auth::User()->id.'') }}">Mes événements</a>
      @endif
      <a class="p-2 text-dark text-uppercase"
        style="font-size:14px; border-right: 1px solid #31a85d;padding-top:0 !important;padding-bottom:0 !important;"
        href="{{ url('eventList/asc') }}">Agenda</a>
      <a class="p-2 text-dark text-uppercase"
        style="font-size:14px; border-right: 1px solid #31a85d;padding-top:0 !important;padding-bottom:0 !important;"
        href="{{ url('usefulLinks') }}">Liens utiles</a>
      <a class="p-2 text-dark text-uppercase"
        style="font-size:14px; border-right: 1px solid #31a85d;padding-top:0 !important;padding-bottom:0 !important;"
        href="{{ url('documentsToDownload') }}">Documents à télécharger</a>
      <a class="p-2 text-dark text-uppercase"
        style="font-size:14px; border-right: 1px solid #31a85d;padding-top:0 !important;padding-bottom:0 !important;"
        href="{{ url('about') }}">À propos</a>
      @if(Auth::check())
      <a class="p-2 text-dark text-uppercase"
        style="font-size:14px; border-right: 1px solid #31a85d;padding-top:0 !important;padding-bottom:0 !important;"
        href="{{ url('profile') }}">Mon profil</a>
      <a class="p-2 text-dark text-uppercase" href="{{ route('logout') }}"
        style="font-size:14px;padding-top:0 !important;padding-bottom:0 !important;"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Se déconnecter
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
      @else
      <a class="p-2 text-dark text-uppercase"
        style="font-size:14px; border-right: 1px solid #31a85d;padding-top:0 !important;padding-bottom:0 !important;"
        href="{{ url('register') }}">Créer un compte</a>
      <a class="p-2 text-dark text-uppercase"
        style="font-size:14px;padding-top:0 !important;padding-bottom:0 !important;" href="{{ url('login') }}">Se
        connecter</a>
      @endif
    </nav>
  </div>
</div>