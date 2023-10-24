<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('hospital.png') }}">
    <title>{{ config('app.name') }}</title>
    <!-- Bootstrap CSS -->
    <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('template/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{ asset('template/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('template/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('template/assets/css/soft-ui-dashboard.css?v=1.0.7')}}" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Seus estilos e scripts aqui, se necessário -->
</head>
<body class="">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
      <div class="container">
        <div class="d-flex justify-content-between w-100">
          <a class="navbar-brand font-weight-bolder ms-3 text-white" href="{{route('welcome')}}">
            Receituario Digital
          </a>
          <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon mt-2">
              <span class="navbar-toggler-bar bar1"></span>
              <span class="navbar-toggler-bar bar2"></span>
              <span class="navbar-toggler-bar bar3"></span>
            </span>
          </button>
          <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ms-auto me-3">
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="{{route('welcome')}}">
                  <i class="fas fa-home opacity-6 me-1"></i>
                  Página Inicial
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link me-2" href="{{route('login')}}">
                  <i class="fas fa-sign-in-alt opacity-6 me-1"></i>
                  Entrar
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <main class="main-content  mt-0">
      <section class="min-vh-100 mb-8">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('{{ asset('template/assets/img/curved-images/contato.jpg') }}');">
          <span class="mask bg-gradient-dark opacity-6"></span>
        </div>
        <div class="container">
          <div class="row mt-lg-n10 mt-md-n11 mt-n10">
            <div class="col-xl-8 col-lg-10 col-md-7 mx-auto">
              <div class="card z-index-0 shadow-lg p-3 mb-5 bg-white rounded">
                <div class="card-body ">
                    <form method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                              <label for="name" class="form-label">Nome</label>
                              <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6">
                              <label for="email" class="form-label">Email</label>
                              <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div class="">
                            <label for="subject" class="form-label">Assunto</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="mx-4 mb-4">
                            <label for="message" class="form-label">Mensagem</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-secondary mx-4">Enviar</button>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
      <footer class="footer py-5 bg-light rounded-top">
          <div class="container">
            <div class="row">
              <div class="col-lg-8 mb-4 mx-auto text-center">
                <span class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">Empresa</span>
              </div>
            </div>
            <div class="row">
              <div class="col-8 mx-auto text-center mt-1">
                <p class="mb-0 text-secondary">
                  Direitos autorais © <script>
                    document.write(new Date().getFullYear())
                  </script> Receituário Digital.
                </p>
              </div>
            </div>
          </div>
        </footer>
      <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    </main>
    <!--   Core JS Files   -->
    <script src="{{ asset('template/assets/js/core/popper.min.js')}}"></script>
    <script src="{{ asset('template/assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{ asset('template/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('template/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
    <script>
      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
          damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('template/assets/js/soft-ui-dashboard.min.js?v=1.0.7')}}"></script>
  </body>

