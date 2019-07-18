<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    @include('layout.head')
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/notification.js')}}"></script>
</head>

<body id="page-top" class="sidebar-toggled">
    <!-- Modal -->
    <div class="modal fade" id="ModalMail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    Le message a bien été envoyé.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <div id="wrapper">
        @include('admin.layout.nav')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('admin.layout.nav-responsive')
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="text-center">Envoyer un mail</h1>
                        </div>
                    </div>
                    {{ Form::open(array('url' => '/sendMail', 'method' => 'POST')) }}
                    @csrf
                    <div class="row" style="padding-top:30px;padding-bottom:30px;">
                        <div class="col-md-12">
                            <div class="card border-left-success shadow h-100 py-2 mx-auto"
                                style="background-color:white;max-width:600px;">
                                <div class="card-body p-0 pl-2 pr-2">
                                    <div class="row">
                                        <div class="text-center col-md-8">
                                            <button id="specificEvent" type="button" class="btn btn-success">
                                                Aux participants d'un événement spécifique
                                            </button>
                                        </div>
                                        <div class="text-center col-md-4">
                                            <button id="allMembers" type="button" class="btn btn-outline-success">
                                                À tout les membres
                                            </button>
                                        </div>
                                    </div>
                                    <input id="mailType" name="mailType" type="hidden" value="specific">
                                    <div class="row" style="padding-top:30px;">
                                        <div class="col-md-12">
                                            <h4 id="titleSelect" style="display:flex">Sélectionner l'événement</h4>
                                            <div id="selectEvent" class="input-group form-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-list text-white"></i></span>
                                                </div>
                                                <select id="eventName" name="eventName" class="form-control">
                                                    @foreach($eventsWithUsers as $event)
                                                    <option value="{{$event->name}}">{{$event->name}}
                                                        <?php setlocale (LC_ALL, "fr_FR") ?>
                                                        {{strftime("%A %e %B %Y",strtotime($event->date))}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="input-group form-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-font text-white"></i></span>
                                                </div>
                                                <input id="subject" type="text" class="form-control" name="subject"
                                                    placeholder="sujet du mail" required autocomplete="subject"
                                                    autofocus>
                                            </div>
                                            <h4>Contenu</h4>
                                            <div class="input-group form-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-font text-white"></i></span>
                                                </div>
                                                <input id="title" type="text" class="form-control" name="title"
                                                    placeholder="titre (facultatif)" autocomplete="subject" autofocus>
                                            </div>
                                            <div class="input-group form-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-font text-white"></i></span>
                                                </div>
                                                <textarea id="message" class="form-control" name="message"
                                                    placeholder="message (obligatoire)" required autocomplete="message"
                                                    autofocus rows="4"></textarea>
                                            </div>
                                            <div class="row" style="padding-top:40px;">
                                                <div class="col-md-12">
                                                    <div class="form-group text-center">
                                                        <button type="submit"
                                                            class="btn btn-success btn-md pl-5 pr-5 mt-3">
                                                            <h6>Envoyer ce mail</h6>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                    <div id="mailOK" style="display:none;">
                        @error('OK') {{ $message }}@enderror
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