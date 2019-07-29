<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    @include('layout.head')
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <style>
        @media (max-width: 992px) {

            .col-lg-4 {
                padding-left: 20px !important;
            }
        }
    </style>
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
                        <div class="col-lg-4 pr-0">
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
                        <div class="col-lg-4 pl-0">
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
                            <!-- The next event -->
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
                                            <h6>
                                                {{ $event->name }}
                                            </h6>
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
                                        <th>
                                            Supprimer
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
                                            <td>
                                                <!--button that can delete the user-->
                                                <a id="{{$user->id}}" data-toggle="modal"
                                                    data-target="#ModalUserDel-{{$user->id}}"
                                                    class="btn-doc btn btn-danger btn-circle btn-sm p-1"
                                                    style="border-radius:100%;background-color:#e74a3b;">
                                                    <i style="pointer-events: none;
                                                                            cursor: default;"
                                                        class="fas fa-trash text-white"></i>
                                                </a>
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
                                            <td>
                                                <!--button that can delete the user-->
                                                <a id="{{$user->id}}" data-toggle="modal"
                                                    data-target="#ModalUserDel-{{$user->id}}"
                                                    class="btn-doc btn btn-danger btn-circle btn-sm p-1"
                                                    style="border-radius:100%;background-color:#e74a3b;">
                                                    <i style="pointer-events: none;
                                                                                cursor: default;"
                                                        class="fas fa-trash text-white"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- pagination -->
                            {{ $users->links() }}
                        </div>
                    </div>
                    <!-- create a pop-up for each user because the button has to be unique-->
                    @foreach($users as $user)
                    <div class="modal fade" id="ModalUserDel-{{$user->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        Confirmation
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Êtes-vous sûr de vouloir supprimer ce compte ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"
                                        onclick="window.location.href = '{{ url('admin/deleteUser/'.$user->id.'') }}';">Oui,
                                        je suis
                                        sûr.</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
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
    $(document).ready(function () {
    
        //function to animate the text
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
});
</script>