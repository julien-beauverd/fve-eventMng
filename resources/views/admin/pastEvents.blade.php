<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    @include('layout.head')
    <script src="{{ asset('js/scripts.js') }}"></script>
    <style>
        @media (max-width: 767px) {

            h6,
            h5 {
                text-align: center;
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
                            <h1 class="text-center pt-5">Les événements passés</h1>
                        </div>
                    </div>
                    @foreach($events as $event)
                    <div class="row" style="padding-top:30px;">
                        <div class="pointer col-md-12"
                            onclick="window.location.href = '{{ url('/event/'.$event->id.'') }}';">
                            <div class="card border-left-success h-100 py-2 mx-auto"
                                style="background-color:white;max-width:900px;">
                                <div class="card-body p-0 pl-2 pr-2">
                                    <div class="row">
                                        <div class="col-md-12">
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
                                                            {{ $event->location->city }}</h6>
                                                    </div>
                                                    <div class="col-md-5 text-right">
                                                        <?php setlocale (LC_ALL, "fr_FR") ?>
                                                        <h6 class="mb-0">
                                                            {{strftime("%A %e %B %Y",strtotime($event->date))}}</h6>
                                                    </div>
                                                </div>
                                            </div>
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