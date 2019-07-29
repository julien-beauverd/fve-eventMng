<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    @include('layout.head')
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/nextEvents.js') }}"></script>
    <style>
        @media (max-width: 767px) {

            h6,
            h5,
            .btn-circle,
            .col-md-1 {
                text-align: center !important;
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
                <div id="parent" class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="text-center pt-5">Les prochains événements</h1>
                        </div>
                    </div>
                    @if(count($events)== 0)
                    <h3 class="text-center pt-5">Il n'y a pas d'événement prévu pour le moment.</h3>
                    @else
                    @foreach($events as $event)
                    <div class="row" style="padding-top:30px;">
                        <div class="col-md-12 mb-2">
                            <div class="card border-left-success h-100 py-2 mx-auto"
                                style="background-color:white;max-width:900px;">
                                <div class="card-body p-0 pl-2 pr-2">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                <div class="row">
                                                    <div class="col-md-10 pb-0">
                                                        <h5>{{$event->name}}</h5>
                                                    </div>
                                                    <div class="col-md-2 text-right">
                                                        <h6>{{date("H:i",strtotime($event->topics[0]->time))}}</h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <h6 class="mb-0">{{ $event->location->street }}
                                                            {{ $event->location->street_number }},
                                                            {{ $event->location->zip_code }}
                                                            {{ $event->location->city }}
                                                        </h6>
                                                    </div>
                                                    <div class="col-md-5 text-right">
                                                        <?php setlocale (LC_ALL, "fr_FR") ?>
                                                        <h6 class="mb-0">
                                                            {{strftime("%e %B %Y",strtotime($event->date))}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="popover-content" class='list-group' style="display:none;">
                                            <a download
                                                href="{{URL::asset('/docs/CSV.blade.php?id='.$event->id.'&name='.$event->name.'&names='.urlencode(serialize($nameArray)).'&first_names='.urlencode(serialize($firstNameArray)).'&company_names='.urlencode(serialize($companyNameArray)).'&emails='.urlencode(serialize($emailArray)).'')}}"
                                                class='list-group-item list-group-item-action btn-nextEvents p-2'>
                                                Télécharger la liste des participants
                                            </a>
                                            <a href='{{ url('/event/'.$event->id.'') }}'
                                                class='list-group-item list-group-item-action btn-nextEvents p-2'>
                                                Consulter cet événement
                                            </a>
                                            <a href='{{ url('/admin/modifyEvent/'.$event->id.'') }}'
                                                class='list-group-item list-group-item-action btn-nextEvents p-2'>
                                                Modifier cet événement
                                            </a>
                                            <a id="btnDel-{{$event->id}}" data-toggle="modal" href="#"
                                                class='list-group-item list-group-item-action btn-nextEventsDel p-2'>
                                                Supprimer cet événement
                                            </a>
                                        </div>
                                        <div class="col-md-1 pb-0 text-right" data-container="body"
                                            data-toggle="popover-1" data-placement="top">
                                            <a id="1" href="#" class="btn btn-success btn-circle p-1"
                                                style="border-radius:100%;">
                                                ...
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
                @foreach($events as $event)
                <div class="modal fade" id="ModalEventDel-{{$event->id}}" tabindex="-1" role="dialog"
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
                                Êtes-vous sûr de vouloir supprimer cet événement ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"
                                    onclick="window.location.href = '{{ url('admin/deleteEvent/'.$event->id.'') }}';">Oui,
                                    je suis
                                    sûr.</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
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
    
    $(document).on("click", ".btn-nextEventsDel", function(e) {
        var lastChar = e.target.id[e.target.id.length -1];
        $('#ModalEventDel-'+lastChar).modal();
    });
});
        
</script>