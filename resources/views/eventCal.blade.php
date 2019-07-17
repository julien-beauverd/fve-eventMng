<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
        <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    @include('layout.head')
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/locale/fr.js'></script>
    <script src="{{URL::asset('/js/scripts.js')}}"></script>
    {!! $calendar->script() !!}

</head>

<body id="page-top" class="sidebar-toggled">

    <div id="wrapper">
        @include('layout.nav-mobile')
        <div id="content-wrapper" class="d-flex flex-column">
            @include('layout.nav')

            <div id="content">
                <!-- Topbar -->
                <nav class="d-lg-none navbar navbar-expand navbar-light bg-white topbar static-top shadow">
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
                <img class="img-fluid" src="{{URL::asset('/img/banner.png')}}" alt="banner" width="100%">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row" style="padding-top:10px;">
                                <div class="col-md-8">

                                </div>
                                <div class="col-2">
                                    <h5>
                                        <a class="text-dark" href="{{ url('/eventList/asc') }}">Liste</a>
                                    </h5>
                                </div>
                                <div class="col-2">
                                    <h5>
                                        <a class="text-success" href="{{ url('/eventCal') }}">Calendrier</a>
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="padding-left:10%;padding-right:10%;margin-bottom:20px;">
                                    {!! $calendar->calendar() !!}
                                </div>
                            </div>
                        </div>
                    </div>
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
