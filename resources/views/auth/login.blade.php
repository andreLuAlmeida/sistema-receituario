
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('template/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/x-icon" href="{{ asset('hospital.png') }}">
  <title>{{ config('app.name') }}</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset('template/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('template/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{asset('template/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('template/assets/css/soft-ui-dashboard.css?v=1.0.7')}}" rel="stylesheet" />
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid pe-0">
              <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3" href="{{route('welcome')}}">
                  Receituario Digital
              </a>
              <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation"
                  aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon mt-2">
                      <span class="navbar-toggler-bar bar1"></span>
                      <span class="navbar-toggler-bar bar2"></span>
                      <span class="navbar-toggler-bar bar3"></span>
                  </span>
              </button>
              <div class="collapse navbar-collapse" id="navigation">
                  <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">
                      <li class="nav-item">
                          <a class="nav-link me-2" href="{{route('register.medico')}}">
                              <i class="fas fa-stethoscope opacity-6 text-dark me-1"></i>
                              Cadastro de Médico
                          </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link me-2" href="{{route('register.farmacia')}}">
                              <i class="fas fa-pills opacity-6 text-dark me-1"></i>
                              Cadastro de Farmácia
                          </a>
                      </li>
                  </ul>
              </div>
          </div>
      </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-7">
                @if(session('message'))
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Bem vindo novamente!</h3>
                  <p class="mb-0">Entre com seu email e senha</p>
                </div>
                <div class="card-body mt-0">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input type="email" class="form-control" id="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email">
                        </div>
                    
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password" placeholder="Senha">
                        </div>
                    
                        <div class="mb-3 form-check">
                          <input class="form-check-input" type="checkbox" name="remember" id="rememberMe" checked>
                          <label class="form-check-label" for="rememberMe">{{ __('Lembre-se') }}</label>
                      </div>
                      
                      <div class="text-center">
                          <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                              {{ __('Esqueceu sua senha?') }}
                          </a>
                      
                          <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">{{ __('Entrar') }}</button>
                      </div>
                    </form>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6 min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('{{ asset('template/assets/img/curved-images/foto-de-grande-angular-de-um-estetoscopio-em-um-documento-de-inscricao-de-seguro-de-viagem.jpg') }}');">
                  <span class="mask bg-gradient-dark opacity-6"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mb-4 mx-auto text-center">
          <a href="{{route('contact.index')}}" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Entre em contato
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-0 text-secondary">
            Direitos reservados © <script>
              document.write(new Date().getFullYear())
            </script> criado por Almeida Desenvolvimento
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="{{asset('template/assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('template/assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('template/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('template/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
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
  <script src="{{asset('template/assets/js/soft-ui-dashboard.min.js?v=1.0.7')}}"></script>
</body>

</html>