<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    @include('layout.head')
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/newEvent.js') }}"></script>
    <style>
        @media (max-width: 767px) {

            .col-md-4 {
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

                <div class="modal fade" id="ModalImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                L'image est trop lourde. La taille limite est de 2MB.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="ModalDocument" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <div class="modal fade" id="Modalevent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                L'événement a bien été crée.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="eventOK" style="display:none;">
                    @error('OK') {{ $message }}@enderror
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="text-center pt-5">Nouvel événement</h1>
                        </div>
                    </div>
                    {{ Form::open(array('url' => '/admin/newEvent', 'method' => 'POST', 'enctype' => "multipart/form-data")) }}
                    @csrf
                    <div class="row" style="padding-top:40px;">
                        <div class="col-md-6">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i
                                            class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                </div>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" placeholder="nom de l'événement" required autocomplete="name" autofocus
                                    value="{{old('name')}}">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i
                                            class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                </div>
                                <textarea id="description"
                                    class="form-control @error('description') is-invalid @enderror" name="description"
                                    placeholder="description de l'événement" required autocomplete="name" autofocus
                                    rows="8">{{old('description')}}</textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="font-weight-bold">Date de l'événement</h6>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt text-info"></i></span>
                                </div>
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror"
                                    name="date" placeholder="date de l'événement" required autocomplete="date" autofocus
                                    value="{{old('date')}}">

                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <p id="pastEvent" class="text-danger" style="display:none;">L'événement ne peut pas se
                                dérouler dans le passé.</p>
                            <h6 class="font-weight-bold">Lieu de l'événement</h6>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i
                                                    class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                        </div>
                                        <input id="city" type="text"
                                            class="form-control @error('city') is-invalid @enderror" name="city"
                                            placeholder="localité / ville" required autocomplete="city" autofocus
                                            value="{{old('city')}}">

                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i
                                                    class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                        </div>
                                        <input id="zip_code" type="text"
                                            class="form-control @error('zip_code') is-invalid @enderror" name="zip_code"
                                            placeholder="code postal à 4 chiffres" required autocomplete="zip_code"
                                            autofocus value="{{old('zip_code')}}">

                                        @error('zip_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i
                                                    class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                        </div>
                                        <input id="street" type="text"
                                            class="form-control @error('street') is-invalid @enderror" name="street"
                                            placeholder="rue" required autocomplete="street" autofocus
                                            value="{{old('street')}}">

                                        @error('street')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i
                                                    class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                        </div>
                                        <input id="street_number" type="text"
                                            class="form-control @error('street_number') is-invalid @enderror"
                                            name="street_number" placeholder="numéro" required
                                            autocomplete="street_number" autofocus value="{{old('street_number')}}">

                                        @error('street_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-building text-info"></i></span>
                                </div>
                                <input id="building" type="text"
                                    class="form-control @error('buidling') is-invalid @enderror" name="building"
                                    placeholder="bâtiment / salle" required autocomplete="building" autofocus
                                    value="{{old('building')}}">

                                @error('building')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row" style="padding-top:40px;">
                        <div class="col-md-12">
                            <h5 class="text-left font-weight-bold">Programme de l'événement</h5>
                        </div>
                    </div>
                    <div id="parent">
                        <input id="topicCount" name="topicCount" type="hidden" value="{{old('topicCount')}}">
                        <input id="topicNumber" name="topicNumber" type="hidden" value="{{old('topicNumber')}}">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock text-info"></i></span>
                                    </div>
                                    <input id="time_topic_1" type="time"
                                        class="form-control @error('time_topic') is-invalid @enderror"
                                        name="time_topic_1" placeholder="heure" required autocomplete="time_topic"
                                        autofocus value="{{old('time_topic_1')}}">

                                    @error('time_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="title_topic_1" type="text"
                                        class="form-control @error('title_topic') is-invalid @enderror"
                                        name="title_topic_1" placeholder="titre" required autocomplete="title_topic"
                                        autofocus value="{{old('title_topic_1')}}">

                                    @error('title_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user text-info"></i></span>
                                    </div>
                                    <input id="speaker_topic_1" type="text"
                                        class="form-control @error('speaker_topic') is-invalid @enderror"
                                        name="speaker_topic_1" placeholder="orateur" autocomplete="speaker_topic"
                                        autofocus value="{{old('speaker_topic_1')}}">

                                    @error('speaker_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="description_topic_1" type="text"
                                        class="form-control @error('description_topic') is-invalid @enderror"
                                        name="description_topic_1" placeholder="description"
                                        autocomplete="description_topic" autofocus
                                        value="{{old('description_topic_1')}}">

                                    @error('description_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock text-info"></i></span>
                                    </div>
                                    <input id="time_topic_2" type="time"
                                        class="form-control @error('time_topic') is-invalid @enderror"
                                        name="time_topic_2" placeholder="heure" required autocomplete="time_topic"
                                        autofocus value="{{old('time_topic_2')}}">

                                    @error('time_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="title_topic_2" type="text"
                                        class="form-control @error('title_topic') is-invalid @enderror"
                                        name="title_topic_2" placeholder="titre" required autocomplete="title_topic"
                                        autofocus value="{{old('title_topic_2')}}">

                                    @error('title_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user text-info"></i></span>
                                    </div>
                                    <input id="speaker_topic_2" type="text"
                                        class="form-control @error('speaker_topic') is-invalid @enderror"
                                        name="speaker_topic_2" placeholder="orateur" autocomplete="speaker_topic"
                                        autofocus value="{{old('speaker_topic_2')}}">

                                    @error('speaker_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="description_topic_2" type="text"
                                        class="form-control @error('description_topic') is-invalid @enderror"
                                        name="description_topic_2" placeholder="description"
                                        autocomplete="description_topic" autofocus
                                        value="{{old('description_topic_2')}}">

                                    @error('description_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock text-info"></i></span>
                                    </div>
                                    <input id="time_topic_3" type="time"
                                        class="form-control @error('time_topic') is-invalid @enderror"
                                        name="time_topic_3" placeholder="heure" required autocomplete="time_topic"
                                        autofocus value="{{old('time_topic_3')}}">

                                    @error('time_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="title_topic_3" type="text"
                                        class="form-control @error('title_topic') is-invalid @enderror"
                                        name="title_topic_3" placeholder="titre" required autocomplete="title_topic"
                                        autofocus value="{{old('title_topic_3')}}">

                                    @error('title_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user text-info"></i></span>
                                    </div>
                                    <input id="speaker_topic_3" type="text"
                                        class="form-control @error('speaker_topic') is-invalid @enderror"
                                        name="speaker_topic_3" placeholder="orateur" autocomplete="speaker_topic"
                                        autofocus value="{{old('speaker_topic_3')}}">

                                    @error('speaker_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="description_topic_3" type="text"
                                        class="form-control @error('description_topic') is-invalid @enderror"
                                        name="description_topic_3" placeholder="description"
                                        autocomplete="description_topic" autofocus
                                        value="{{old('description_topic_3')}}">

                                    @error('description_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock text-info"></i></span>
                                    </div>
                                    <input id="time_topic_4" type="time"
                                        class="form-control @error('time_topic') is-invalid @enderror"
                                        name="time_topic_4" placeholder="heure" autocomplete="time_topic" autofocus
                                        value="{{old('time_topic_4')}}">

                                    @error('time_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="title_topic_4" type="text"
                                        class="form-control @error('title_topic') is-invalid @enderror"
                                        name="title_topic_4" placeholder="titre" autocomplete="title_topic" autofocus
                                        value="{{old('title_topic_4')}}">

                                    @error('title_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user text-info"></i></span>
                                    </div>
                                    <input id="speaker_topic_4" type="text"
                                        class="form-control @error('speaker_topic') is-invalid @enderror"
                                        name="speaker_topic_4" placeholder="orateur" autocomplete="speaker_topic"
                                        autofocus value="{{old('speaker_topic_4')}}">

                                    @error('speaker_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="description_topic_4" type="text"
                                        class="form-control @error('description_topic') is-invalid @enderror"
                                        name="description_topic_4" placeholder="description"
                                        autocomplete="description_topic" autofocus
                                        value="{{old('description_topic_4')}}">

                                    @error('description_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock text-info"></i></span>
                                    </div>
                                    <input id="time_topic_5" type="time"
                                        class="form-control @error('time_topic') is-invalid @enderror"
                                        name="time_topic_5" placeholder="heure" autocomplete="time_topic" autofocus
                                        value="{{old('time_topic_5')}}">

                                    @error('time_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="title_topic_5" type="text"
                                        class="form-control @error('title_topic') is-invalid @enderror"
                                        name="title_topic_5" placeholder="titre" autocomplete="title_topic" autofocus
                                        value="{{old('title_topic_5')}}">

                                    @error('title_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user text-info"></i></span>
                                    </div>
                                    <input id="speaker_topic_5" type="text"
                                        class="form-control @error('speaker_topic') is-invalid @enderror"
                                        name="speaker_topic_5" placeholder="orateur" autocomplete="speaker_topic"
                                        autofocus value="{{old('speaker_topic_5')}}">

                                    @error('speaker_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="description_topic_5" type="text"
                                        class="form-control @error('description_topic') is-invalid @enderror"
                                        name="description_topic_5" placeholder="description"
                                        autocomplete="description_topic" autofocus
                                        value="{{old('description_topic_5')}}">

                                    @error('description_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock text-info"></i></span>
                                    </div>
                                    <input id="time_topic_6" type="time"
                                        class="form-control @error('time_topic') is-invalid @enderror"
                                        name="time_topic_6" placeholder="heure" autocomplete="time_topic" autofocus
                                        value="{{old('time_topic_6')}}">

                                    @error('time_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="title_topic_6" type="text"
                                        class="form-control @error('title_topic') is-invalid @enderror"
                                        name="title_topic_6" placeholder="titre" autocomplete="title_topic" autofocus
                                        value="{{old('title_topic_6')}}">

                                    @error('title_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user text-info"></i></span>
                                    </div>
                                    <input id="speaker_topic_6" type="text"
                                        class="form-control @error('speaker_topic') is-invalid @enderror"
                                        name="speaker_topic_6" placeholder="orateur" autocomplete="speaker_topic"
                                        autofocus value="{{old('speaker_topic_6')}}">

                                    @error('speaker_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="description_topic_6" type="text"
                                        class="form-control @error('description_topic') is-invalid @enderror"
                                        name="description_topic_6" placeholder="description"
                                        autocomplete="description_topic" autofocus
                                        value="{{old('description_topic_6')}}">

                                    @error('description_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock text-info"></i></span>
                                    </div>
                                    <input id="time_topic_7" type="time"
                                        class="form-control @error('time_topic') is-invalid @enderror"
                                        name="time_topic_7" placeholder="heure" autocomplete="time_topic" autofocus
                                        value="{{old('time_topic_7')}}">

                                    @error('time_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="title_topic_7" type="text"
                                        class="form-control @error('title_topic') is-invalid @enderror"
                                        name="title_topic_7" placeholder="titre" autocomplete="title_topic" autofocus
                                        value="{{old('title_topic_7')}}">

                                    @error('title_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user text-info"></i></span>
                                    </div>
                                    <input id="speaker_topic_7" type="text"
                                        class="form-control @error('speaker_topic') is-invalid @enderror"
                                        name="speaker_topic_7" placeholder="orateur" autocomplete="speaker_topic"
                                        autofocus value="{{old('speaker_topic_7')}}">

                                    @error('speaker_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="description_topic_7" type="text"
                                        class="form-control @error('description_topic') is-invalid @enderror"
                                        name="description_topic_7" placeholder="description"
                                        autocomplete="description_topic" autofocus
                                        value="{{old('description_topic_7')}}">

                                    @error('description_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock text-info"></i></span>
                                    </div>
                                    <input id="time_topic_8" type="time"
                                        class="form-control @error('time_topic') is-invalid @enderror"
                                        name="time_topic_8" placeholder="heure" autocomplete="time_topic" autofocus
                                        value="{{old('time_topic_8')}}">

                                    @error('time_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="title_topic_8" type="text"
                                        class="form-control @error('title_topic') is-invalid @enderror"
                                        name="title_topic_8" placeholder="titre" autocomplete="title_topic" autofocus
                                        value="{{old('title_topic_8')}}">

                                    @error('title_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user text-info"></i></span>
                                    </div>
                                    <input id="speaker_topic_8" type="text"
                                        class="form-control @error('speaker_topic') is-invalid @enderror"
                                        name="speaker_topic_8" placeholder="orateur" autocomplete="speaker_topic"
                                        autofocus value="{{old('speaker_topic_8')}}">

                                    @error('speaker_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="description_topic_8" type="text"
                                        class="form-control @error('description_topic') is-invalid @enderror"
                                        name="description_topic_8" placeholder="description"
                                        autocomplete="description_topic" autofocus
                                        value="{{old('description_topic_8')}}">

                                    @error('description_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock text-info"></i></span>
                                    </div>
                                    <input id="time_topic_9" type="time"
                                        class="form-control @error('time_topic') is-invalid @enderror"
                                        name="time_topic_9" placeholder="heure" autocomplete="time_topic" autofocus
                                        value="{{old('time_topic_9')}}">

                                    @error('time_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="title_topic_9" type="text"
                                        class="form-control @error('title_topic') is-invalid @enderror"
                                        name="title_topic_9" placeholder="titre" autocomplete="title_topic" autofocus
                                        value="{{old('title_topic_9')}}">

                                    @error('title_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user text-info"></i></span>
                                    </div>
                                    <input id="speaker_topic_9" type="text"
                                        class="form-control @error('speaker_topic') is-invalid @enderror"
                                        name="speaker_topic_9" placeholder="orateur" autocomplete="speaker_topic"
                                        autofocus value="{{old('speaker_topic_9')}}">

                                    @error('speaker_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="description_topic_9" type="text"
                                        class="form-control @error('description_topic') is-invalid @enderror"
                                        name="description_topic_9" placeholder="description"
                                        autocomplete="description_topic" autofocus
                                        value="{{old('description_topic_9')}}">

                                    @error('description_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock text-info"></i></span>
                                    </div>
                                    <input id="time_topic_10" type="time"
                                        class="form-control @error('time_topic') is-invalid @enderror"
                                        name="time_topic_10" placeholder="heure" autocomplete="time_topic" autofocus
                                        value="{{old('time_topic_10')}}">

                                    @error('time_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="title_topic_10" type="text"
                                        class="form-control @error('title_topic') is-invalid @enderror"
                                        name="title_topic_10" placeholder="titre" autocomplete="title_topic" autofocus
                                        value="{{old('title_topic_10')}}">

                                    @error('title_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user text-info"></i></span>
                                    </div>
                                    <input id="speaker_topic_10" type="text"
                                        class="form-control @error('speaker_topic') is-invalid @enderror"
                                        name="speaker_topic_10" placeholder="orateur" autocomplete="speaker_topic"
                                        autofocus value="{{old('speaker_topic_10')}}">

                                    @error('speaker_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="description_topic_10" type="text"
                                        class="form-control @error('description_topic') is-invalid @enderror"
                                        name="description_topic_10" placeholder="description"
                                        autocomplete="description_topic" autofocus
                                        value="{{old('description_topic_10')}}">

                                    @error('description_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock text-info"></i></span>
                                    </div>
                                    <input id="time_topic_11" type="time"
                                        class="form-control @error('time_topic') is-invalid @enderror"
                                        name="time_topic_11" placeholder="heure" autocomplete="time_topic" autofocus
                                        value="{{old('time_topic_11')}}">

                                    @error('time_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="title_topic_11" type="text"
                                        class="form-control @error('title_topic') is-invalid @enderror"
                                        name="title_topic_11" placeholder="titre" autocomplete="title_topic" autofocus
                                        value="{{old('title_topic_11')}}">

                                    @error('title_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user text-info"></i></span>
                                    </div>
                                    <input id="speaker_topic_11" type="text"
                                        class="form-control @error('speaker_topic') is-invalid @enderror"
                                        name="speaker_topic_11" placeholder="orateur" autocomplete="speaker_topic"
                                        autofocus value="{{old('speaker_topic_11')}}">

                                    @error('speaker_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="description_topic_11" type="text"
                                        class="form-control @error('description_topic') is-invalid @enderror"
                                        name="description_topic_11" placeholder="description"
                                        autocomplete="description_topic" autofocus
                                        value="{{old('description_topic_11')}}">

                                    @error('description_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock text-info"></i></span>
                                    </div>
                                    <input id="time_topic_12" type="time"
                                        class="form-control @error('time_topic') is-invalid @enderror"
                                        name="time_topic_12" placeholder="heure" autocomplete="time_topic" autofocus
                                        value="{{old('time_topic_12')}}">

                                    @error('time_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="title_topic_12" type="text"
                                        class="form-control @error('title_topic') is-invalid @enderror"
                                        name="title_topic_12" placeholder="titre" autocomplete="title_topic" autofocus
                                        value="{{old('title_topic_12')}}">

                                    @error('title_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user text-info"></i></span>
                                    </div>
                                    <input id="speaker_topic_12" type="text"
                                        class="form-control @error('speaker_topic') is-invalid @enderror"
                                        name="speaker_topic_12" placeholder="orateur" autocomplete="speaker_topic"
                                        autofocus value="{{old('speaker_topic_12')}}">

                                    @error('speaker_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="description_topic_12" type="text"
                                        class="form-control @error('description_topic') is-invalid @enderror"
                                        name="description_topic_12" placeholder="description"
                                        autocomplete="description_topic" autofocus
                                        value="{{old('description_topic_12')}}">

                                    @error('description_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock text-info"></i></span>
                                    </div>
                                    <input id="time_topic_13" type="time"
                                        class="form-control @error('time_topic') is-invalid @enderror"
                                        name="time_topic_13" placeholder="heure" autocomplete="time_topic" autofocus
                                        value="{{old('time_topic_13')}}">

                                    @error('time_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="title_topic_13" type="text"
                                        class="form-control @error('title_topic') is-invalid @enderror"
                                        name="title_topic_13" placeholder="titre" autocomplete="title_topic" autofocus
                                        value="{{old('title_topic_13')}}">

                                    @error('title_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user text-info"></i></span>
                                    </div>
                                    <input id="speaker_topic_13" type="text"
                                        class="form-control @error('speaker_topic') is-invalid @enderror"
                                        name="speaker_topic_13" placeholder="orateur" autocomplete="speaker_topic"
                                        autofocus value="{{old('speaker_topic_13')}}">

                                    @error('speaker_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="description_topic_13" type="text"
                                        class="form-control @error('description_topic') is-invalid @enderror"
                                        name="description_topic_13" placeholder="description"
                                        autocomplete="description_topic" autofocus
                                        value="{{old('description_topic_13')}}">

                                    @error('description_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock text-info"></i></span>
                                    </div>
                                    <input id="time_topic_14" type="time"
                                        class="form-control @error('time_topic') is-invalid @enderror"
                                        name="time_topic_14" placeholder="heure" autocomplete="time_topic" autofocus
                                        value="{{old('time_topic_14')}}">

                                    @error('time_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="title_topic_14" type="text"
                                        class="form-control @error('title_topic') is-invalid @enderror"
                                        name="title_topic_14" placeholder="titre" autocomplete="title_topic" autofocus
                                        value="{{old('title_topic_14')}}">

                                    @error('title_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user text-info"></i></span>
                                    </div>
                                    <input id="speaker_topic_14" type="text"
                                        class="form-control @error('speaker_topic') is-invalid @enderror"
                                        name="speaker_topic_14" placeholder="orateur" autocomplete="speaker_topic"
                                        autofocus value="{{old('speaker_topic_14')}}">

                                    @error('speaker_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="description_topic_14" type="text"
                                        class="form-control @error('description_topic') is-invalid @enderror"
                                        name="description_topic_14" placeholder="description"
                                        autocomplete="description_topic" autofocus
                                        value="{{old('description_topic_14')}}">

                                    @error('description_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock text-info"></i></span>
                                    </div>
                                    <input id="time_topic_15" type="time"
                                        class="form-control @error('time_topic') is-invalid @enderror"
                                        name="time_topic_15" placeholder="heure" autocomplete="time_topic" autofocus
                                        value="{{old('time_topic_15')}}">

                                    @error('time_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="title_topic_15" type="text"
                                        class="form-control @error('title_topic') is-invalid @enderror"
                                        name="title_topic_15" placeholder="titre" autocomplete="title_topic" autofocus
                                        value="{{old('title_topic_15')}}">

                                    @error('title_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user text-info"></i></span>
                                    </div>
                                    <input id="speaker_topic_15" type="text"
                                        class="form-control @error('speaker_topic') is-invalid @enderror"
                                        name="speaker_topic_15" placeholder="orateur" autocomplete="speaker_topic"
                                        autofocus value="{{old('speaker_topic_15')}}">

                                    @error('speaker_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                    </div>
                                    <input id="description_topic_15" type="text"
                                        class="form-control @error('description_topic') is-invalid @enderror"
                                        name="description_topic_15" placeholder="description"
                                        autocomplete="description_topic" autofocus
                                        value="{{old('description_topic_15')}}">
                                    @error('description_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <p id="errorTime" class="text-danger" style="display:none;">Le programme doit être trié dans l'ordre
                        chronologique.</p>
                    <div class="row">
                        <div class="text-center col-md-2">

                        </div>
                        <div class="col-md-2">
                            <button id="addTopic" type="button" class="btn btn-outline-success">
                                Rajouter une ligne
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button id="removeTopic" type="button" class="btn btn-outline-secondary">
                                Supprimer la dernière ligne
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="row" style="padding-top:40px;">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="font-weight-bold">Type d'événement</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-image text-info"></i></span>
                                        </div>
                                        <select id="typeEvent" name="typeEvent" class="form-control">
                                            <option value="grand-rdv"
                                                {{ (old("typeEvent") == 'grand-rdv' ? "selected":"") }}>Grand
                                                rendez-vous
                                            </option>
                                            <option value="rdv-juridique"
                                                {{ (old("typeEvent") == "rdv-juridique" ? "selected":"") }}>Rendez-vous
                                                juridique</option>
                                            <option value="rdv-formation"
                                                {{ (old("typeEvent") == "rdv-formation" ? "selected":"") }}>Rendez-vous
                                                de la
                                                formation</option>
                                            <option value="rencontres-entrepreneurs"
                                                {{ (old("typeEvent") == "rencontres-entrepreneurs" ? "selected":"") }}>
                                                Rencontre des entrepreneurs</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-12">
                                <h6 class="font-weight-bold">Bannière de l'événement</h6>
                            </div>
                            <div class="input-group form-group">

                                <input id="image" type="file" class=" @error('image_upload') is-invalid @enderror"
                                    name="image" placeholder="bannière de l'événement" accept="image/*" required
                                    autocomplete="image" autofocus value="{{old('image')}}">
                                @error('image_upload')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <p class="mb-0">Dimension recommandée :</p><p> 2000 x 730</p>
                                <p><i class="fas fa-exclamation-circle"></i> Taille max de l'image : 2MB</p>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="font-weight-bold">Documents liés à l'événement</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="DocumentParent">
                                        <input id="docCount" name="docCount" type="hidden" value="1">
                                        <div class="input-group form-group">
                                            <input id="document_1" type="file"
                                                class=" @error('document') is-invalid @enderror" name="document_1"
                                                placeholder="document de l'événement" autocomplete="image" autofocus
                                                value="{{old('document_1')}}">
                                            @error('document')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div id="dimensionDoc" class="col-md-12">
                                    <p><i class="fas fa-exclamation-circle"></i> Taille max d'un document : 8MB</p>
                                </div>
                                <div class="text-center col-md-12">
                                    <button id="addDocument" type="button" class="btn btn-outline-success">
                                        Rajouter un document
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top:40px;">
                        <div class="col-md-7">

                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <button id="submitButton" type="submit"
                                    class="btn float-left btn-success btn-md pl-5 pr-5 mt-3 mb-3">
                                    <h6>Créer cet événement</h6>
                                </button>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                    <div id="template" class="row" style="display:none">
                        <div class="col-md-2">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-clock text-info"></i></span>
                                </div>
                                <input id="time_topic" type="time"
                                    class="form-control @error('time_topic') is-invalid @enderror" name="time_topic"
                                    placeholder="heure" required autocomplete="time_topic" autofocus
                                    value="{{old('time_topic')}}">

                                @error('time_topic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i
                                            class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                </div>
                                <input id="title_topic" type="text"
                                    class="form-control @error('title_topic') is-invalid @enderror" name="title_topic"
                                    placeholder="titre" required autocomplete="title_topic" autofocus
                                    value="{{old('title_topic')}}">

                                @error('title_topic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user text-info"></i></span>
                                </div>
                                <input id="speaker_topic" type="text"
                                    class="form-control @error('speaker_topic') is-invalid @enderror"
                                    name="speaker_topic" placeholder="orateur" autocomplete="speaker_topic" autofocus
                                    value="{{old('speaker_topic')}}">

                                @error('speaker_topic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i
                                            class="fas fa-pencil-alt fa-flip-horizontal text-info"></i></span>
                                </div>
                                <input id="description_topic" type="text"
                                    class="form-control @error('description_topic') is-invalid @enderror"
                                    name="description_topic" placeholder="description" autocomplete="description_topic"
                                    autofocus value="{{old('description_topic')}}">

                                @error('description_topic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div id="documentTemplate" style="display:none">
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