<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('template/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/x-icon" href="{{ asset('hospital.png') }}">
  <title>{{ config('app.name') }}</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('template/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{ asset('template/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('template/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link id="pagestyle" href="{{ asset('template//assets/css/soft-ui-dashboard.css?v=1.0.7')}}" rel="stylesheet" />
</head>

<body class="">
  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <!--Mostra em qual pagina estou-->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{route('medico.home')}}">Páginas</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a href="{{route('medico.pacientes')}}">Receitas</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a href="{{route('paciente.create')}}">Criar</a></li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Criar Receita</h6>
      </nav>
        <!--Termina em qual pagina estou-->
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">  
        </div>
        <ul class="navbar-nav  justify-content-end">
          <li class="nav-item d-flex align-items-center">
            <a href="{{ route('medico-profile.show') }}" class="nav-link text-body font-weight-bold px-0">
              <i class="fa fa-user me-sm-1"></i>
              <span class="d-sm-inline d-none">Perfil</span>
            </a>
          </li>
          <li class="nav-item px-3 d-flex align-items-center">
            <a href="#" class="nav-link text-body p-0" id="logoutLink" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
              <i class="fa fa-sign-out me-1"></i>
          </a>
          <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </li>     
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
<main class="main-content mt-0">
    <section class="min-vh-100">
        <div class="page-header align-items-center min-vh-50 pt-5 pb-11 m-1 border-radius-lg" style="background-image: url('{{ asset('template/assets/img/curved-images/paciente-online.jpg') }}');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center mb-4">
                        <h1 class="text-white mb-2 mt-5">Receita</h1>
                        <p class="text-lead text-white">Crie uma nova receita médica personalizada para seus pacientes. Selecione o paciente para dar continuidade.</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card z-index-0">
                            <div class="card-body col-md-10 mx-auto">
                                <form id="form-receita" method="POST" action="{{ route('prereceita.store') }}">
                                    @csrf
                                
                                    <div class="form-group">
                                        <label for="termo">Digite o nome, sobrenome, CPF ou RG do paciente:</label>
                                        <input type="text" id="termo" name="termo" class="form-control @error('termo') is-invalid @enderror">
                                        @error('termo')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                
                                    <button type="submit" class="btn btn-primary">Ir para prescrição</button>
                                </form>               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-footer/>
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>