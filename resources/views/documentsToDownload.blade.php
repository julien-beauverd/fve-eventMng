<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    @include('layout.head')

    <script src="{{ asset('js/scripts.js') }}"></script>
    <style>

    </style>
</head>

<body id="page-top" class="sidebar-toggled">

    <div id="wrapper">
        @include('layout.nav-mobile')
        <div id="content-wrapper" class="d-flex flex-column">
            @include('layout.nav')

            <div id="content">
                @include('layout.nav-responsive')
                <div style="background-image: url('{{URL::asset('/img/batiment-fve.jpg')}}');background-size: cover">
                    <div class="container-fluid" style="min-height:600px;">
                        @foreach($docsToDownload as $docToDownload)
                        @if($loop->iteration == 1 || $loop->iteration % 4 == 0)
                        <div class="row">
                            @endif
                            <div class="col-lg-4">
                                <div class="jumbotron card card-block docToDownload">
                                    <h2>
                                        {{$docToDownload->title}}
                                    </h2>
                                    <p class="text-justify">
                                        {{$docToDownload->description}}
                                    </p>
                                    <p>
                                        <a class="btn btn-success btn-large"
                                            href="{{URL::asset('/docs/download/'.$docToDownload->name.'')}}"
                                            download>Télécharger ce document</a>
                                    </p>
                                </div>
                            </div>
                            @if($loop->iteration % 3 == 0)
                        </div>
                        @endif
                        @endforeach
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