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
        @include('admin.layout.nav')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow">
                    <div class="col-1" style="min-width:50px;">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle" style="margin-right:0 !important;padding:0 !important;">
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
                        <div class="col-md-12">
                            <h1 class="text-center">Tableau de bord</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="padding-top:80px;">
                            <h5 class="text-success">
                                Nombre d'événements de la fédération vaudoise des entrepreneurs
                            </h5>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h1 class="counter-count display-4 pr-5" style="display:inline">{{$eventCount}}</h1>
                                    <i class="far fa-calendar-alt fa-4x" style="display:inline"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="padding-top:80px;">
                            <h5 class="text-success">
                                Nombre total de compte crée
                            </h5>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h1 class="counter-count display-4 pr-5" style="display:inline">{{ $totalAccount }}
                                    </h1>
                                    <i class="fas fa-user-circle fa-4x" style="display:inline"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top:80px;">
                        <div class="col-md-6">
                            <h5 class="text-success">
                                Prochain événement
                            </h5>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h1 class="counter-count display-4 pr-1" style="display:inline;">
                                        {{$participantCount[0]->count}}</h1>
                                    <h4 class="pr-5" style="display:inline;"> Participants</h4>
                                    <i class="fas fa-users fa-4x" style="display:inline;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="pointer col-md-6"
                            onclick="window.location.href = '{{ url('/event/'.$event->id.'') }}';">
                            <div class="row">
                                <div class="col-md-12">
                                    <img class="img-fluid" src="{{URL::asset('/img/events/'.$event->image.'')}}"
                                        alt="img event">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>
                                        {{ $event->name }}
                                    </h4>
                                </div>
                                <div class="col-md-4">
                                    <h5>
                                        <?php setlocale (LC_TIME, "French") ?>
                                        {{strftime("%A %e %B %Y",strtotime($event ->date))}}
                                    </h5>
                                </div>
                                <div class="col-md-2">
                                    <h5>
                                        {{ $event->topics[0]->time }}
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>
                                        {{ $event->location->street }} {{ $event->location->street_number }},
                                        {{ $event->location->zip_code }}
                                        {{ $event->location->city }}
                                    </h5>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row" style="padding-top:100px;">
                        <div class="col-md-12">
                            <h3 class="text-success">
                                Liste complète de tout les membres
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <th>
                                            Nom
                                        </th>
                                        <th>
                                            Prénom
                                        </th>
                                        <th>
                                            Nom de l'entreprise
                                        </th>
                                        <th>
                                            Adresse email
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        @if($loop->odd)
                                        <tr>
                                            <td>
                                                {{$user->name}}
                                            </td>
                                            <td>
                                                {{$user->first_name}}
                                            </td>
                                            <td>
                                                {{$user->company_name}}
                                            </td>
                                            <td>
                                                {{$user->email}}
                                            </td>
                                        </tr>
                                        @else
                                        <tr class="table-secondary">
                                            <td>
                                                {{$user->name}}
                                            </td>
                                            <td>
                                                {{$user->first_name}}
                                            </td>
                                            <td>
                                                {{$user->company_name}}
                                            </td>
                                            <td>
                                                {{$user->email}}
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $users->links() }}
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
<script>
    $('.counter-count').each(function () {                 
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
            },
            {
                duration: 2000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
        });
    });
</script>