<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    @include('layout.head')
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/modifyDocsToDownload.js') }}"></script>
</head>

<body id="page-top" class="sidebar-toggled">
    <div class="modal fade" id="ModalDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Erreur
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Le fichier est trop lourd. La taille limite est de 8MB.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="Modaldocs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                    La liste des documents a bien été modifié.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"
                        onclick="window.location.href = '{{ url('/admin/docsToDownloadManagement') }}';">OK</button>
                </div>
            </div>
        </div>
    </div>
    <div id="wrapper">
        @include('admin.layout.nav')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('admin.layout.nav-responsive')


                <div id="docsOK" style="display:none;">
                    @error('OK') {{ $message }}@enderror
                </div>
                <div class="container-fluid p-5">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="text-center pb-5">Gestion des documents à télécharger</h1>
                        </div>
                    </div>
                    {{ Form::open(array('url' => '/admin/docsToDownloadManagement', 'method' => 'PUT', 'enctype' => "multipart/form-data")) }}
                    @csrf
                    <div class="row">
                        <div class="d-none d-md-block col-md-3">
                            <h6 class="font-weight-bold">Nom du fichier</h6>
                        </div>
                        <div class="d-none d-md-block col-md-3">
                            <h6 class="font-weight-bold">Titre du document</h6>
                        </div>
                        <div class="d-none d-md-block col-md-5">
                            <h6 class="font-weight-bold">Description du document</h6>
                        </div>
                        <div class="d-none d-md-block col-md-1">
                            <h6 class="font-weight-bold">Supprimer</h6>
                        </div>
                    </div>
                    @foreach($docsToDownload as $docToDownload)
                    <div class="row">
                        <div class="col-md-3">

                            <a id="doc-{{$loop->iteration}}"
                                href="{{URL::asset('/docs/download/'.$docToDownload->name.'')}}" download>
                                {{$docToDownload->name}}
                            </a>
                            <input id="delDoc_{{$loop->iteration}}" name="delDoc_{{$loop->iteration}}" type="hidden"
                                value="0">
                        </div>
                        <div class="col-md-3">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-font text-info"></i></span>
                                </div>
                                <input id="title_document_{{$loop->iteration}}" type="text"
                                    class="form-control @error('title_document') is-invalid @enderror"
                                    name="title_document_{{$loop->iteration}}" placeholder="titre du document" required
                                    autocomplete="title_document" autofocus
                                    value="{{old('title_document_'.$loop->iteration.'') ?? $docToDownload->title}}">

                                @error('title_document')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-font text-info"></i></span>
                                </div>
                                <input id="description_document_{{$loop->iteration}}" type="text"
                                    class="form-control @error('description_document') is-invalid @enderror"
                                    name="description_document_{{$loop->iteration}}"
                                    placeholder="description du document" required autocomplete="description_document"
                                    autofocus
                                    value="{{old('description_document_'.$loop->iteration.'') ?? $docToDownload->description}}">

                                @error('description_document')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-1">
                            <a id="{{$loop->iteration}}" class="btn-doc btn btn-danger btn-circle btn-sm p-1"
                                style="border-radius:100%;background-color:#e74a3b;">
                                <i style="pointer-events: none;
                                                cursor: default;" class="fas fa-trash text-white"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    <div id="DocumentParent">
                        <input id="docCount" name="docCount" type="hidden" value="{{old('docCount') ?? $docCount}}">
                    </div>
                    <div class="row" style="padding-top:40px;">
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-3">
                            <button id="addDocument" type="button" class="btn btn-outline-success btn-md">
                                Rajouter un document
                            </button>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <button id="submitButton" type="submit" class="btn btn-success btn-md">
                                    Valider la liste
                                </button>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                    <div id="documentTemplate" class="row" style="display:none">
                        <div class="col-md-3">
                            <div class="input-group form-group">

                                <input id="document" type="file" class=" @error('document') is-invalid @enderror"
                                    name="document" placeholder="document de l'événement" autocomplete="image" autofocus
                                    value="{{old('document')}}">
                                @error('document')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-font text-info"></i></span>
                                </div>
                                <input id="title_document" type="text"
                                    class="form-control @error('title_document') is-invalid @enderror"
                                    name="title_document" placeholder="titre du document" required
                                    autocomplete="title_document" autofocus value="{{old('title_document_1')}}">

                                @error('title_document')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-font text-info"></i></span>
                                </div>
                                <input id="description_document" type="text"
                                    class="form-control @error('description_document') is-invalid @enderror"
                                    name="description_document" placeholder="description du document" required
                                    autocomplete="description_document" autofocus
                                    value="{{old('description_document_1')}}">

                                @error('description_document')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
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