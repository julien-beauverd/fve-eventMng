<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
  @include('layout.head')
  <script src="{{URL::asset('/js/scripts.js')}}"></script>
  <style>
    @media (max-width: 767px) {

      .pointer h4,
      .pointer h5 {
        text-align: center;
      }

      .col-md-2 h5 {
        text-align: right;
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
        <!-- Topbar -->
        <nav class="d-lg-none navbar navbar-expand navbar-light bg-white topbar static-top shadow">
          <div class="col-1">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>
          </div>
          <div class="col-11">
            <a class="sidebar-brand d-flex align-items-center justify-content-center p-0 d-lg-none rounded-circle mr-3">
              <div><img src="{{URL::asset('/img/logo.png')}}" width="200em" class="float-right"></div>
            </a>
          </div>
        </nav>
        <img class="img-fluid" src="{{URL::asset('/img/myEvents.jpg')}}" alt="banner" width="100%">

        <div class="container-fluid mb-5">
          <div class="row">
            <div class="col-md-12">
              @if($events == null)
              @if($times == 0)
              <h5>Vous n'avez pas accès à la liste des autres personnes.</h5>
              @else
              <div class="row">
                <div class="col-md-12">
                  <h2 class="text-center">Liste de mes événements</h2>
                </div>
              </div>
              <h5 class="text-center">Vous n'êtes inscrit à aucun événement pour le moment.</h5>
              <p class="text-center">Rendez vous sur la page <a href='{{ url('/eventList/asc') }}'>Agenda</a> afin de
                vous
                s'inscrire à un
                événement.</p>
              @endif
              @else
              <div class="row">
                <div class="col-md-12 text-center">
                  <h2>Liste de mes événements</h2>
                </div>
              </div>
              @foreach ($events as $event)
              @if($loop->odd)
              <div class="row">
                @if($event->type == 'grand-rdv')
                <?php $backgroundColor = '#962404'?>
                @elseif($event->type == 'rdv-juridique')
                <?php $backgroundColor = '#12437C' ?>
                @elseif($event->type == 'rdv-formation')
                <?php $backgroundColor = '#1EAFE6'?>
                @else
                <?php $backgroundColor = '#E49D0A'?>
                @endif
                <div class="pointer col-md-6 pt-5"
                  onclick="window.location.href = '{{ url('/event/'.$event->id.'') }}';">
                  <div class="row">
                    <div class="col-md-12">
                      <img class="img-fluid pr-2 ml-1" src="{{URL::asset('/img/events/'.$event->image.'')}}"
                        alt="img event">
                    </div>
                  </div>
                  <div class="row  mr-1 ml-1 pr-0 pl-0" style="background-color:{{$backgroundColor}};">
                    <div class="col-md-7 pr-0">
                      <h4 class="text-white">
                        {{ $event->name }}
                      </h4>
                    </div>
                    <div class="col-md-4">
                      <h5 class="text-white">
                        <?php setlocale (LC_ALL, "fr_FR") ?>
                        {{strftime("%A %e %B %Y",strtotime($event ->date))}}
                      </h5>
                    </div>
                    <div class="col-md-1 pl-0">
                      <h5 class="text-white">
                        {{date("H:i",strtotime($times[$loop->index]))}}
                      </h5>
                    </div>
                  </div>
                  <div class="row  mr-1 ml-1 pr-0 pl-0" style="background-color:{{$backgroundColor}};">
                    <div class="col-md-12">
                      <h5 class="text-white">
                        {{ $event->street }} {{ $event->street_number }}, {{ $event->zip_code }}
                        {{ $event->city }}
                      </h5>
                    </div>
                  </div>
                </div>
                @else
                @if($event->type == 'grand-rdv')
                <?php $backgroundColor = '#962404'?>
                @elseif($event->type == 'rdv-juridique')
                <?php $backgroundColor = '#12437C' ?>
                @elseif($event->type == 'rdv-formation')
                <?php $backgroundColor = '#1EAFE6'?>
                @else
                <?php $backgroundColor = '#E49D0A'?>
                @endif
                <div class="pointer col-md-6 pt-5"
                  onclick="window.location.href = '{{ url('/event/'.$event->id.'') }}';">
                  <div class="row">
                    <div class="col-md-12">
                      <img class="img-fluid pr-2 ml-1" src="{{URL::asset('/img/events/'.$event->image.'')}}"
                        alt="img event">
                    </div>
                  </div>
                  <div class="row mr-1 ml-1 pr-0 pl-0" style="background-color:{{$backgroundColor}};">
                    <div class="col-md-7 pr-0">
                      <h4 class="text-white">
                        {{ $event->name }}
                      </h4>
                    </div>
                    <div class="col-md-4">
                      <h5 class="text-white">
                        <?php setlocale (LC_ALL, "fr_FR") ?>
                        {{strftime("%A %e %B %Y",strtotime($event ->date))}}
                      </h5>
                    </div>
                    <div class="col-md-1 pl-0">
                      <h5 class="text-white">
                        {{date("H:i",strtotime($times[$loop->index]))}}
                      </h5>
                    </div>
                  </div>
                  <div class="row mr-1 ml-1 pr-0 pl-0" style="background-color:{{$backgroundColor}};">
                    <div class="col-md-12">
                      <h5 class="text-white">
                        {{ $event->street }} {{ $event->street_number }}, {{ $event->zip_code }}
                        {{ $event->city }}
                      </h5>
                    </div>
                  </div>
                </div>
              </div>
              @endif
              @endforeach
              @endif
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