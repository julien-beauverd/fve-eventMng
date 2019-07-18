<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
  @include('layout.head')
  <script src="{{URL::asset('/js/scripts.js')}}"></script>
  <style>
    @media (max-width: 1300px) {
      .pointer h4 {
        font-size: 1.3rem;
      }

      .pointer h5 {
        font-size: 1.15rem;
      }
    }

    @media (max-width: 1100px) {
      .pointer h4 {
        font-size: 1.10rem;
      }

      .pointer h5 {
        font-size: 0.9rem;
      }
    }

    @media (max-width: 992px) {

      .col-lg-7,
      .col-lg-4,
      .col-lg-1,
      .col-lg-12 {
        padding: 0;
      }

      .pointer h4 {
        font-size: 1.2rem;
        text-align: center;
      }

      .pointer h5 {
        font-size: 1rem;
        text-align: center;
      }
    }

    @media (max-width: 767px) {

      .pointer {
        padding: 5px 5px 5px 5px !important
      }

      .pointer h4 {
        font-size: 1.2rem;
      }

      .pointer h5 {
        font-size: 1rem;
      }
    }

    @media (max-width: 576px) {


      h5,
      .col-sm-8 {
        text-align: center;
      }

      .pointer h4 {
        font-size: 1.1rem;

      }

      .pointer h5 {
        font-size: 0.9rem;

      }

    }

    @media (max-width: 442px) {

      .pointer h4 {
        font-size: 0.9rem;

      }

      .pointer h5 {
        font-size: 0.7rem;

      }

    }

    @media (max-width: 365px) {

      .pointer h4 {
        font-size: 0.75rem;

      }

      .pointer h5 {
        font-size: 0.6rem;

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
                  <div class="row mr-1 ml-1 pr-0 pl-0" style="background-color:{{$backgroundColor}};">
                    <div class="col-lg-7 pr-0">
                      <h4 class="text-white">
                        {{ $event->name }}
                      </h4>
                    </div>
                    <div class="col-lg-4">
                      <h5 class="text-white">
                        <?php setlocale (LC_ALL, "fr_FR") ?>
                        {{strftime("%A %e %B %Y",strtotime($event->date))}}
                      </h5>
                    </div>
                    <div class="col-lg-1 pl-0">
                      <h5 class="text-white">
                        {{date("H:i",strtotime($times[$loop->index]))}}
                      </h5>
                    </div>
                  </div>
                  <div class="row mr-1 ml-1 pr-0 pl-0" style="background-color:{{$backgroundColor}};">
                    <div class="col-lg-12">
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
                    <div class="col-lg-7 pr-0">
                      <h4 class="text-white">
                        {{ $event->name }}
                      </h4>
                    </div>
                    <div class="col-lg-4">
                      <h5 class="text-white">
                        <?php setlocale (LC_ALL, "fr_FR") ?>
                        {{strftime("%A %e %B %Y",strtotime($event->date))}}
                      </h5>
                    </div>
                    <div class="col-lg-1 pl-0">
                      <h5 class="text-white">
                        {{date("H:i",strtotime($times[$loop->index]))}}
                      </h5>
                    </div>
                  </div>
                  <div class="row mr-1 ml-1 pr-0 pl-0" style="background-color:{{$backgroundColor}};">
                    <div class="col-lg-12">
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