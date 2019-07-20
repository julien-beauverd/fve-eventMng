<!-- Sidebar -->
<ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion toggled" style="background-color: #009932 !important;"
    id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center p-0" style="background-color:white;">
        <img id="logo" src="{{URL::asset('/img/logo-2.png')}}" width="100%">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/admin/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tableau de bord</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Événements
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/admin/nextEvents') }}">
            <i class="fas fa-list"></i>
            <span>Prochains événements</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/admin/pastEvents') }}">
            <i class="fas fa-history"></i>
            <span>Événements passés</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/admin/newEvent') }}">
            <i class="fas fa-plus-square"></i>
            <span>Nouvel événement</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Message
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/admin/sendMail') }}">
            <i class="fas fa-bell"></i>
            <span>Envoyer un mail</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Documents à télécharger
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/admin/docsToDownloadManagement') }}">
            <i class="fas fa-file"></i>
            <span>Gérer les documents</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/eventList/asc') }}">
            <i class="fas fa-chevron-left"></i>
            <span>Retour au site web</span>
        </a>
    </li>

</ul>
<!-- End of Sidebar -->