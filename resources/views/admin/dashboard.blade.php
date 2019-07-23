<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    @include('layout.head')
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</head>

<body id="page-top" class="sidebar-toggled">
    <div id="wrapper">
        @include('admin.layout.nav')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('admin.layout.nav-responsive')
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="text-center pt-5">Tableau de bord</h1>
                        </div>
                    </div>
                    <div class="row" style="padding-top:80px;">
                        <div class="col-lg-4">
                            <h5 class="text-success pb-4">
                                Nombre d'événements de la fédération vaudoise des entrepreneurs
                            </h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="counter-count display-4 pr-5" style="display:inline">{{$eventCount}}</h1>
                                    <i class="far fa-calendar-alt fa-4x" style="display:inline"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <h5 class="text-success pb-5">
                                Nombre total de comptes créés
                            </h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="counter-count display-4 pr-5" style="display:inline">{{ $totalAccount }}
                                    </h1>
                                    <i class="fas fa-user-circle fa-4x" style="display:inline"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="text-success pb-5">
                                        Prochain événement
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="counter-count display-4 pr-1" style="display:inline;">
                                        @if($participantCount == 0)
                                        0
                                        @else
                                        {{$participantCount[0]->count}}
                                        @endif
                                    </h1>
                                    <h4 class="pr-5" style="display:inline;"> Participants</h4>
                                    <i class="fas fa-users fa-4x" style="display:inline;"></i>
                                </div>
                            </div>
                            <div class="row">
                                @if($event == '')
                                @else
                                <div class="col-md-12 pointer"
                                    onclick="window.location.href = '{{ url('/event/'.$event->id.'') }}';">
                                    <div class="row pt-3">
                                        <div class="col-md-12">
                                            <img class="img-fluid" src="{{URL::asset('/img/events/'.$event->image.'')}}"
                                                alt="img event">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pt-3">
                                            <h5>
                                                {{ $event->name }}
                                            </h5>
                                        </div>
                                        <div class="col-md-4 pt-3">
                                            <h6>
                                                <?php setlocale (LC_TIME, "fr_FR") ?>
                                                {{strftime("%e %B %Y",strtotime($event ->date))}}
                                            </h6>
                                        </div>
                                        <div class="col-md-2 pt-3">
                                            <h6>
                                                {{date("H:i",strtotime($event->topics[0]->time))}}
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6>
                                                {{ $event->location->street }}
                                                {{ $event->location->street_number }},
                                                {{ $event->location->zip_code }}
                                                {{ $event->location->city }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top:30px;">
                        <div class="col-md-12">
                            <h3 class="text-success">
                                Liste complète de tous les membres
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