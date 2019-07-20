<!-- Sidebar -->
<ul class="d-lg-none navbar-nav bg-gradient sidebar sidebar-dark accordion toggled"
    style="background-color: #F0F0F0 !important;" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center p-0" style="background-color:white;">
        <img id="logo" src="{{URL::asset('/img/logo-2.png')}}" width="100%" style="display: none;">
    </a>

    @if(Auth::check() && Auth::User()->email_verified_at != null && Auth::User()->is_admin)
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin/dashboard') }}" style="color:#212529;">
            <i class="fas fa-tasks" style="color:#212529;"></i>
            <span>Administrateur</span>
        </a>
    </li>

    @else
    <hr class="sidebar-divider">
    @endif

    <!-- Heading -->
    <div class="sidebar-heading" style="color:#212529;">
        Événements
    </div>
    @if(Auth::check())
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('myEvents/'.Auth::User()->id.'') }}" style=" color:#212529;">
            <i class="fas fa-list" style="color:#212529;"></i>
            <span>Mes événements</span>
        </a>
    </li>
    @endif
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" style="color:#212529;" href="{{ url('/eventList/asc') }}">
            <i class="far fa-calendar-alt" style="color:#212529;"></i>
            <span>Agenda</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" style="background-color:#212529;">

    <div class="sidebar-heading" style="color:#212529;">
        Informations
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" style="color:#212529;" href="{{ url('/usefulLinks') }}">
            <i class="fas fa-external-link-alt" style="color:#212529;"></i>
            <span>Liens utiles</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" style="color:#212529;" href="{{ url('/documentsToDownload') }}">
            <i class="far fa-file" style="color:#212529;"></i>
            <span>Documents à télécharger</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" style="color:#212529;" href="{{ url('/about') }}">
            <i class="far fa-id-card" style="color:#212529;"></i>
            <span>À propos</span>
        </a>
    </li>
    @if(Auth::check())
    <li class="nav-item">
        <a class="nav-link collapsed" style="color:#212529;" href="{{ url('/profile') }}">
            <i class="far fa-user" style="color:#212529;"></i>
            <span>Mon profil</span>
        </a>
    </li>
    @endif
    <hr class="sidebar-divider" style="background-color:#212529;">

    <div class="sidebar-heading" style="color:#212529;">
        connexion
    </div>

    @if(Auth::check())

    <li class="nav-item">
        <a class="nav-link collapsed" style="color:#212529;" href="{{ url('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt" style="color:#212529;"></i>
            <span>Se déconnecter</span>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </a>

    </li>

    @else
    <li class="nav-item">
        <a class="nav-link collapsed" style="color:#212529;" href="{{ url('register') }}">
            <i class="fas fa-sign-in-alt" style="color:#212529;"></i>
            <span>Se créer un compte</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" style="color:#212529;" href="{{ url('/login') }}">
            <i class="fas fa-sign-in-alt" style="color:#212529;"></i>
            <span>Se connecter</span>
        </a>
    </li>
    @endif

</ul>




<!-- End of Sidebar -->