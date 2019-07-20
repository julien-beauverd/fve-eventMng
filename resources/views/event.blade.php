<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    @include('layout.head')
    <script src="{{ asset('js/scripts.js') }}"></script>
    <style>
        @media (max-width: 1100px) {
            h2 {
                font-size: 1.8rem;
            }
        }

        @media (max-width: 992px) {

            h2,
            h4 {
                text-align: center;
            }

            h5 {
                text-align: left;
            }

            .col-3 {
                text-align: right !important;
            }

            #informations {
                order: 0;
            }

            #description {
                order: 1;
            }

            .col-lg-7 {
                padding-right: 15px !important;
            }
        }
    </style>
</head>

<body id="page-top" class="sidebar-toggled" style="background-color: lightgray;">

    <?php $participate = false ?>
    @if(Auth::check())
    @foreach($event[0]->users as $user)
    @if($user->id == Auth::User()->id)
    <?php $participate = true ?>
    @else
    @endif
    @endforeach
    @endif
    <?php $old = false ?>
    @if($event[0]->date < date('Y-m-d')) <?php $old = true ?> @endif <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div id="modalToHide" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if(Auth::Check())
                            Confirmation
                            @else
                            Connexion
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @if(Auth::Check() && Auth::User()->email_verified_at != null)
                    <div class="modal-body">
                        Êtes-vous sûr de vous s'inscrire à cet événement ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">non</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal"
                            onclick="window.location.href = '{{ url('/participate/' .$event[0]->id.'') }}';">Oui</button>
                    </div>
                    @elseif(Auth::Check() && Auth::User()->email_verified_at == null)
                    <div class="modal-body">
                        Vous devez valider votre email pour vous inscrire à un événement. Pour cela, cliquez sur le lien
                        dans l'e-mail de validation que vous avez reçu
                        dans votre boîte de réception.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                    </div>
                    @else
                    <div class="modal-body">
                        Vous devez être connecté pour vous inscrire à un événement.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">annuler</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal"
                            onclick="window.location.href = '{{ url('/register') }}';">créer un compte</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal"
                            onclick="window.location.href = '{{ url('/login') }}';">se connecter</button>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div id="participateOK" style="display:none;">
            @if($OK == 1)
            OK
            @endif
        </div>
        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog"
            aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div id="confirmationModal" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Validation
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Vous êtes maintenant inscrit à cet événement !
                        <p>Vous pouvez désormais retrouver cet événement sur la page <b>Mes événements</b>.</p>
                        <p>Vous avez également accès aux documents et à la liste des participants de cet événement.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal"
                            onclick="window.location.href = '{{ url('/event/'.$event[0]->id.'') }}';">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="wrapper">
            @include('layout.nav-mobile')
            <div id="content-wrapper" class="d-flex flex-column">
                @include('layout.nav')

                <div id="content">
                    @include('layout.nav-responsive')
                    <div class="container-fluid event">
                        <div class="row" style="padding-bottom: 20px;">
                            <div class="col-sm-12">
                                <button onclick="window.location.href = '{{ url('/eventList/asc') }}';" type="button"
                                    class="btn btn-outline-success btn-md btnProfile">
                                    retour à la liste
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <img class="img-fluid" src="{{URL::asset('/img/events/'.$event[0]->image.'')}}"
                                    alt="img event">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mt-4">
                                @if($participate)
                                <button type="button" class="btn btn-block btn-success btn-md active"
                                    style="cursor:default;">
                                    Je participe <i class="fas fa-check"></i>
                                </button>
                                @else
                                <button type="button" class="btn btn-block btn-success btn-md" data-toggle="modal"
                                    data-target="#exampleModal">
                                    Participer
                                </button>
                                @endif
                            </div>
                            <div class="col-lg-6 mt-4">
                                <h2>
                                    {{ $event[0]->name}}
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div id="description" class="col-lg-6 pt-4">
                                <h4 class="font-weight-bold">
                                    Description
                                </h4>
                                <p class="text-justify" style="white-space:pre-line;">
                                    {{ $event[0]->description}}
                                </p>
                            </div>
                            <div id="informations" class="col-lg-6 pt-4">
                                <div class="row mt-3">
                                    <div class="col-3 text-center">
                                        <i class="far fa-calendar text-success fa-2x"></i>
                                    </div>
                                    <div class="col-9 pt-2">
                                        <h5>
                                            <?php setlocale (LC_ALL, "fr_FR") ?>
                                            {{strftime("%A %e %B %Y",strtotime($event[0]->date))}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-3 text-center">
                                        <i class="fas fa-map-marker-alt text-success fa-2x"></i>
                                    </div>
                                    <div class="col-9 pt-2">
                                        <h5>
                                            {{ $event[0]->location->street}}
                                            {{ $event[0]->location->street_number}}
                                        </h5>
                                        <h5>
                                            {{ $event[0]->location->city}} {{ $event[0]->location->zip_code}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-3 text-center">
                                        <i class="far fa-clock text-success fa-2x"></i>
                                    </div>
                                    <div class="col-9 pt-2">

                                        @foreach($event[0]->topics as $topic)
                                        @if($loop->first)
                                        <h5>
                                            {{date("H:i",strtotime($topic->time))}}
                                        </h5>
                                        <?php $eventStart = $topic->time ?>
                                        @endif
                                        @if($loop->last)
                                        <?php $eventEnd = $topic->time ?>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($participate == true || $old == true)
                                <div class="row mt-4">
                                    <div class="col-lg-3">
                                    </div>
                                    <div class="col-lg-9">
                                        <a href="{{URL::asset('/docs/export.blade.php?name='.$event[0]->name.'&date='.$event[0]->date.'&address='.$event[0]->location->street.'&street_number='.$event[0]->location->street_number.'&city='.$event[0]->location->city.'&zip_code='.$event[0]->location->zip_code.'&description='.$event[0]->description.'&start='.$eventStart.'&end='.$eventEnd.'')}}"
                                            download style="text-decoration: none;">
                                            <button type="button" class="btn btn-outline-success btn-block btnProfile">
                                                exporter ce rendez-vous
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 pt-5">
                                <h4 class="font-weight-bold">
                                    Programme
                                </h4>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                            @foreach($event[0]->topics as $topic)
                                            @if($loop->odd)
                                            <tr>
                                                <td>
                                                    {{date("H:i",strtotime($topic->time))}}
                                                </td>
                                                <td style="min-width: 15em;">
                                                    {{$topic->title}}
                                                </td>
                                                <td style="min-width: 10em;">
                                                    {{$topic->speaker}}
                                                </td>
                                                <td style="min-width: 20em;">
                                                    {{$topic->description}}
                                                </td>
                                            </tr>
                                            @else
                                            <tr class="table-secondary">
                                                <td>
                                                    {{date("H:i",strtotime($topic->time))}}
                                                </td>
                                                <td>
                                                    {{$topic->title}}
                                                </td>
                                                <td>
                                                    {{$topic->speaker}}
                                                </td>
                                                <td>
                                                    {{$topic->description}}
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if($participate == true || $old == true)
                        <div class="row">
                            <div class="col-lg-4 pt-5">
                                <h4 class="font-weight-bold">Documents</h4>
                                <ul>
                                    @foreach($event[0]->documents as $document)
                                    <li class="list-item doc">
                                        <a href="{{URL::asset('/docs/events/'.$document->name.'')}}" download>
                                            {{$document->name}}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-lg-8 pt-5">
                                <h4 class="font-weight-bold">Participants</h4>
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
                                            @foreach($event[0]->users as $user)
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
                            </div>
                        </div>
                        @endif
                    </div>

                </div>
                <!-- End of Main Content -->
                @include(' layout.footer')
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
</body>

</html>
<script>
    window.onload = function () {
            detectIfparticipateOK();
        };
        
        function detectIfparticipateOK() {
        var participate = document.getElementById('participateOK');
            if (participate.innerHTML.indexOf("OK") !== -1) {
                console.log("test");
                $("#confirmationModal").modal();
            }
        }
</script>