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
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow">
                    <div class="col-1">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
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
                <div id="parent" class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="text-center">Les prochains événements</h1>
                        </div>
                    </div>
                    @foreach($events as $event)
                    <div class="row" style="padding-top:30px;">
                        <div class="col-md-12 mb-2">
                            <div class="card border-left-success shadow h-100 py-2 mx-auto"
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
                                                            {{strftime("%A %e %B %Y",strtotime($event->date))}}</h6>
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
                                                modifier cet événement
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