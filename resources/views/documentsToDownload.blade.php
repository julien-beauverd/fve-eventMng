<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    @include('layout.head')

    <script src="{{ asset('js/scripts.js') }}"></script>

</head>

<body id="page-top" class="sidebar-toggled">
    <div id="wrapper">
        @include('layout.nav-mobile')
        <div id="content-wrapper" class="d-flex flex-column">
            @include('layout.nav')
            <div id="content">
                @include('layout.nav-responsive')
                <img class="img-fluid" src="{{URL::asset('/img/docs_to_download.jpg')}}" alt="banner" width="100%">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 pt-5">
                            <h2 class="text-center">Documents à télécharger</h2>
                        </div>
                    </div>
                    @if(count($docsToDownload) == 0)
                    <h4 class="text-center pt-5">Il n'y a pas de document à télécharger pour le moment.</h4>
                    @else
                    @foreach($docsToDownload as $docToDownload)
                    @if($loop->iteration == 1 || $loop->iteration % 4 == 0)
                    <div class="row">
                        @endif
                        <div class="col-lg-4 d-flex ">
                            <div class="jumbotron card card-block docToDownload">
                                <h3>
                                    {{$docToDownload->title}}
                                </h3>
                                <p class="text-justify">
                                    {{$docToDownload->description}}
                                </p>
                                <p>
                                    <a class="btn btn-success btn-md" style="position:absolute;bottom:15px"
                                        href="{{URL::asset('/docs/download/'.$docToDownload->name.'')}}"
                                        download>Télécharger ce document</a>
                                </p>
                            </div>
                        </div>
                        @if($loop->iteration % 3 == 0)
                    </div>
                    @endif
                    @endforeach
                    @endif
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