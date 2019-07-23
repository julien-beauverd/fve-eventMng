<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
  @include('layout.head')
  <script src="{{URL::asset('/js/scripts.js')}}"></script>
  <style>
    @media (max-width: 1300px) {
      .pointer h4 {
        font-size: 1.2rem;
      }

      .pointer h5 {
        font-size: 1.10rem;
      }
    }

    @media (max-width: 1110px) {
      .pointer h4 {
        font-size: 1.10rem;
      }

      .pointer h5 {
        font-size: 0.9rem;
      }
    }

    @media (max-width: 991px) {

      .col-lg-6 {
        padding: 30px;
      }

      .pointer h4 {
        font-size: 2rem;
        text-align: center;
      }

      .pointer h5 {
        font-size: 1.5rem;
        text-align: center;
      }
    }

    @media (max-width: 767px) {

      .pointer h4 {
        font-size: 1.8rem;
      }

      .pointer h5 {
        font-size: 1.3rem;
      }

      footer {
        padding-top: 200px !important;
        position: relative;
        bottom: 0;
      }
    }

    @media (max-width: 576px) {

      h5,
      .col-sm-8 {
        text-align: center;
        
      }

      .pointer h4 {
        font-size: 1.6rem;

      }

      .pointer h5 {
        font-size: 1.2rem;

      }
    }

    @media (max-width:428px) {
      a.text-dark {
        padding-right: 5px !important;
      }

      .pointer h4 {
        font-size: 1.3rem;

      }

      .pointer h5 {
        font-size: 1rem;

      }
    }

    @media (max-width: 365px) {

      .pointer h4 {
        font-size: 1.1rem;

      }

      .pointer h5 {
        font-size: 0.9rem;

      }

    }

    @media (max-width: 301px) {

      .pointer h4 {
        font-size: 0.9rem;

      }

      .pointer h5 {
        font-size: 0.7rem;

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
        <img class="img-fluid" src="{{URL::asset('/img/banner.png')}}" alt="banner" width="100%">
        <div class="container-fluid" style="margin-bottom:100px">
          <div class="row">
            <div class="col-md-12">
              <div class="row" style="padding-top:10px;">
                <div class="col-sm-8">
                  <h5 class="pr-4" style="display:inline-flex;vertical-align: top;">
                    Tri
                  </h5>
                  <h5 style="display:inline-flex">
                    <a href="{{ url('/eventList/asc') }}" class="text-dark pr-3">
                      <i class="far fa-arrow-alt-circle-up fa-2x"></i>
                    </a>
                  </h5>
                  <h5 style="display:inline-flex">
                    <a href="{{ url('/eventList/desc') }}" class="text-dark">
                      <i class="far fa-arrow-alt-circle-down fa-2x"></i>
                    </a>
                  </h5>
                </div>
                <div class="col-sm-2">
                  <h5>
                    <a class="text-success" href="{{ url('/eventList/asc') }}">Liste</a>
                  </h5>
                </div>
                <div class="col-sm-2">
                  <h5>
                    <a class="text-dark" href="{{ url('/eventCal') }}">Calendrier</a>
                  </h5>
                </div>
              </div>
              @if(count($events) == 0)
              <h3 class="text-center pt-5">Il n'y a pas d'événement prévu pour le moment.</h3>
              @else
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
                <div class="pointer col-lg-6 pt-5"
                  onclick="window.location.href = '{{ url('/event/'.$event->id.'') }}';">
                  <div class="row">
                    <div class="col-md-12">
                      <img class="img-fluid pr-2 ml-1" src="{{URL::asset('/img/events/'.$event->image.'')}}"
                        alt="img event">
                    </div>
                  </div>
                  <div class="row mr-1 ml-1 pr-0 pl-0 pt-2" style="background-color:{{$backgroundColor}};">
                    <div class="col-lg-7 pr-0">
                      <h4 class="text-white">
                        {{ $event->name }}
                      </h4>
                    </div>
                    <div class="col-lg-4 pl-1 pr-1">
                      <h5 class="text-white">
                        <?php setlocale (LC_ALL, "fr_FR") ?>
                        {{strftime("%e %B %Y",strtotime($event->date))}}
                      </h5>
                    </div>
                    <div class="col-lg-1 pl-0">
                      <h5 class="text-white">
                        {{date("H:i",strtotime($event->topics[0]->time))}}
                      </h5>
                    </div>
                  </div>
                  <div class="row mr-1 ml-1 pr-0 pl-0" style="background-color:{{$backgroundColor}};">
                    <div class="col-lg-12">
                      <h5 class="text-white">
                        {{ $event->location->street }} {{ $event->location->street_number }},
                        {{ $event->location->zip_code }}
                        {{ $event->location->city }}
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
                <div class="pointer col-lg-6 pt-5"
                  onclick="window.location.href = '{{ url('/event/'.$event->id.'') }}';">
                  <div class="row">
                    <div class="col-md-12">
                      <img class="img-fluid pr-2 ml-1" src="{{URL::asset('/img/events/'.$event->image.'')}}"
                        alt="img event">
                    </div>
                  </div>
                  <div class="row mr-1 ml-1 pr-0 pl-0 pt-2" style="background-color:{{$backgroundColor}};">
                    <div class="col-lg-7 pr-0">
                      <h4 class="text-white">
                        {{ $event->name }}
                      </h4>
                    </div>
                    <div class="col-lg-4">
                      <h5 class="text-white">
                        <?php setlocale (LC_ALL, "fr_FR") ?>
                        {{strftime("%e %B %Y",strtotime($event->date))}}
                      </h5>
                    </div>
                    <div class="col-lg-1 pl-0">
                      <h5 class="text-white">
                        {{date("H:i",strtotime($event->topics[0]->time))}}
                      </h5>
                    </div>
                  </div>
                  <div class="row mr-1 ml-1 pr-0 pl-0" style="background-color:{{$backgroundColor}};">
                    <div class="col-lg-12">
                      <h5 class="text-white">
                        {{ $event->location->street }} {{ $event->location->street_number }},
                        {{ $event->location->zip_code }}
                        {{ $event->location->city }}
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