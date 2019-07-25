<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    @include('layout.head')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/locale/fr.js'></script>
    <script src="{{URL::asset('/js/scripts.js')}}"></script>
    {!! $calendar->script() !!}
    <style>
        @media (max-width: 576px) {
            .col-sm-2 {
                text-align: center;
            }
        }
    </style>
</head>

<body id="page-top" class="sidebar-toggled">

    <div id="wrapper">
        @include('layout.nav-mobile')
        <div id="content-wrapper" class="d-flex flex-column">
            @include('layout.nav')

            <div id="content">
                @include('layout.nav-responsive')
                <img class="img-fluid" src="{{URL::asset('/img/calendar.png')}}" alt="calendar" width="100%">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row" style="padding-top:10px;">
                                <div class="col-md-8">

                                </div>
                                <div class="col-sm-2">
                                    <h5>
                                        <a class="text-dark" href="{{ url('/eventList/asc') }}">Liste</a>
                                    </h5>
                                </div>
                                <div class="col-sm-2">
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