<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
  @include('layout.head')
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="{{ asset('js/scripts.js') }}"></script>
  <style>
    @media (max-width: 992px) {

      #imgBatiment {
        order: 0;
        padding-bottom: 20px;
      }

      #contentText {
        order: 1;
      }

      .col-lg-6 {
        text-align: center !important;
        padding: 0 0 20px 0 !important;
      }

      #logo {
        padding: 0 0 20px 0 !important;
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
        <img class="img-fluid" src="{{URL::asset('/img/banner-about.jpg')}}" alt="banner" width="100%">
        <div class="container-fluid">
          <div class="row ml-5 mr-5 mt-5">
            <div class="col-lg-6 pr-3 pl-5 text-left">
              <img id="logo" class="img-fluid pb-5 pt-0 pr-5" style="background-color: transparent;"
                src="{{URL::asset('/img/fve-logo.png')}}" alt="logo fve" width="500rem">
            </div>
            <div class="col-lg-6 pl-3 pr-5">
              <p class="text-left">
                La fédération propose de nombreuses prestations à ses membres, dont :
              </p>
              <ul class="text-left pl-3">
                <li>
                  Les assurances sociales (1er et 2ème piliers, assurances conventionnelles)
                </li>
                <li>
                  Les assurances maladie (contrats-cadre avec la Caisse maladie Philos)
                </li>
                <li>
                  Le traitement des salaires et diverses prestations ressources humaines
                </li>
                <li>
                  Une assistance juridique
                </li>
                <li>
                  Des conseils et une assistance techniques dans le domaine des marchés publics
                </li>
                <li>
                  Un soutien administratif pour l’apprentissage (contrat, outil de recrutement, salaires, aspects légaux
                  et
                  examens)
                </li>
                <li>
                  Un service social pour les travailleurs
                </li>
                <li>
                  Des informations régulières sur l’actualité de la construction, ainsi que sur les changements
                  législatifs
                  et
                  réglementaires
                </li>
              </ul>
            </div>
          </div>
          <div class="row ml-5 mr-5 mt-2">
            <div id="contentText" class="col-lg-6 pr-3 pl-5">
              <p class="text-justify">
                La fédération vaudoise des entrepreneurs est la plus importante association patronale de la
                construction dans le canton de Vaud. Elle réunit les métiers du gros œuvre, du second œuvre et de la
                construction métallique. Près de 2’800 entreprises et 22’000 travailleurs bénéficient de ces prestations
                et
                services.

                La fédération est également très active auprès des instances politiques pour défendre des
                conditions-cadre
                favorables au secteur de la construction.

                Au travers de l’Ecole de la construction, elle propose un centre de formation unique en Suisse pour les
                métiers du bâtiment, qui accueille chaque année plus de 2’200 apprentis pour les cours interentreprises
                et
                plus de 2’000 personnes pour la formation continue.
              </p>
            </div>
            <div id="imgBatiment" class="col-lg-6 pr-5" style="padding-left:18px!important;">
              <img class="img-fluid" src="{{URL::asset('/img/batiment-fve.jpg')}}" alt="batiment de la fve" width="80%">
            </div>
          </div>
          <div class="row text-center p-5 mt-5" style="background-color:#009932;color:white">
            <div class="col-sm-4">
              <div class="row">
                <div class="col-md-12 pb-3">
                  <i class="fas fa-building fa-4x" style="color:white;"></i>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h1 class="counter-count display-4">2726</h1>
                  <p class="pt-4">
                    entreprises membres et affiliées
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="row">
                <div class="col-md-12 pb-3">
                  <i class="fas fa-calendar-alt fa-4x" style="color:white;"></i>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h2 class="counter-count display-4">
                    20523
                  </h2>
                  <p class="pt-4">
                    travailleurs de la construction
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="row">
                <div class="col-md-12 pb-3">
                  <i class="fas fa-home fa-4x" style="color:white;"></i>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h5 class="display-5" style="display:inline">Depuis </h5>
                  <h2 class="counter-count display-4" style="display:inline">
                    1904
                  </h2>
                  <p class="mb-0" style="padding-top:30px;">
                    elle s'engage à soutenir les métiers du gros oeuvre,</p>
                  <p> du second oeuvre et de la construction
                    métallique.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 p-0">
              <img class="img-fluid" width="100%" src="{{URL::asset('/img/chantier.jpg')}}" alt="chantier">
            </div>
          </div>
          <div class="row text-center mb-5">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-2 mt-5">
              <div class="row">
                <div class="col-md-12 pb-3">
                  <i class="fas fa-desktop fa-3x"></i>
                </div>
              </div>
              <div class="row" style="padding-top:5px;">
                <div class="col-md-12">
                  <a class="h5 text-success" href="https://www.fve.ch">www.fve.ch</a>
                </div>
              </div>
            </div>
            <div class="col-sm-2 mt-5">
              <div class="row">
                <div class="col-md-12 pb-3">
                  <i class="fas fa-phone fa-3x"></i>
                </div>
              </div>
              <div class="row" style="padding-top:5px;">
                <div class="col-md-12">
                  <a class="h5 text-success" href="tel:+41216321000">021 632 10 00</a>
                </div>
              </div>
            </div>
            <div class="col-sm-2 mt-5">
              <div class="row">
                <div class="col-md-12 pb-3">
                  <i class="far fa-envelope fa-3x"></i>
                </div>
              </div>
              <div class="row" style="padding-top:5px;">
                <div class="col-md-12">
                  <a class="h5 text-success" href="mailto:info@fve.ch">info@fve.ch</a>
                </div>
              </div>
            </div>
            <div class="col-sm-2 mt-5">
              <div class="row">
                <div class="col-md-12 pb-3">
                  <i class="fab fa-facebook fa-3x"></i>
                </div>
              </div>
              <div class="row" style="padding-top:5px;">
                <div class="col-md-12 pb-3">
                  <a class="h5 text-success"
                    href="https://www.facebook.com/federation.vaudoise.des.entrepreneurs/">Facebook</a>
                </div>
              </div>
            </div>
            <div class="col-sm-2 mt-5">
              <div class="row">
                <div class="col-md-12 pb-3">
                  <i class="fab fa-youtube fa-3x"></i>
                </div>
              </div>
              <div class="row" style="padding-top:5px;">
                <div class="col-md-12">
                  <a class="h5 text-success" href="https://www.youtube.com/channel/UCl8Qd5qnbVdwnmLIWuE64WA">YouTube</a>
                </div>
              </div>
            </div>
            <div class="col-sm-1">
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
<script>
  var executed = 0;
      $(window).scroll(function () {
          var height = $(window).scrollTop();
          if (height > '599') {
              $('.counter-count').each(function () {
                  if (executed < 3) {
                      executed++;
                      $(this).prop('Counter', 0).animate({
                          Counter: $(this).text()
                      }, {
                          duration: 3000,
                          easing: 'swing',
                          step: function (now) {
                              $(this).text(Math.ceil(now));
                          }
                      });
                  }
              });
          }
      });
</script>