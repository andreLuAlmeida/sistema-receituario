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
  <link id="pagestyle" href="{{ asset('template//assets/css/soft-ui-dashboard.css?v=1.0.7')}}" rel="stylesheet" />
</head>

<body class="">
  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <!--Mostra em qual pagina estou-->
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{route('farmacia.home')}}">Páginas</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a href="{{route('farmacia.show')}}">Dados de médicio</a></li>
          </ol>
          <h6 class="font-weight-bolder mb-0"></h6>
        </nav>
        <!--Termina em qual pagina estou-->
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">  
        </div>
        <ul class="navbar-nav  justify-content-end">
          <li class="nav-item d-flex align-items-center">
            <a href="{{ route('farmacia-profile.show') }}" class="nav-link text-body font-weight-bold px-0">
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
        <div class="page-header align-items-start min-vh-50 pt-5 pb-9 m-1 border-radius-lg" style="background-image: url('{{ asset('') }}');">
            <span class="mask bg-gradient-dark opacity-4"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <h2 class="text-white mb-2 mt-5">Informações</h2>
                        <p class="text-lead text-white">Caso necessite, altere os dados:</p>
                    </div>
                    <div class="col-md-8">
                        <div class="card z-index-0">
                            <div class="card-body pb-3">
                              <form class="row g-3" method="POST" action="{{ route('farmacia.updateinformacoes', $farmacia->id) }}">
                                @csrf
                                @method('PUT')
                            
                                <div class="col-md-12">
                                    <label for="cnpj" class="form-label">CNPJ</label>
                                    <input type="text" class="form-control @error('cnpj') is-invalid @enderror" id="cnpj" placeholder="xx.xxx.xxx/xxxx-xx" name="cnpj" value="{{ $farmacia->cnpj }}">
                                    @error('cnpj')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                            
                                <x-button>
                                    {{ __('Alterar') }}
                                </x-button>
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!---->
                <div class="pt-4 border-top mt-5">
                </div>
                <!---->
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <h2 class="text-white mb-2 mt-5">Contatos</h2>
                        <p class="text-lead text-white">Caso necessite, altere os dados:</p>
                    </div>
                    <div class="col-md-8">
                        <div class="card z-index-0">
                            <div class="card-body pb-3">
                              <form class="row g-3" method="POST" action="{{ route('farmacia.updatecontatos', $farmacia->id) }}">
                                @csrf
                                @method('PUT')
                            
                                <div class="col-md-6">
                                    <label for="celular" class="form-label">Celular</label>
                                    <input type="text" class="form-control @error('celular') is-invalid @enderror" id="celular" placeholder="(xx) xxxxx-xxxx" name="celular" value="{{ $farmacia->celular }}">
                                    @error('celular')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <input type="text" class="form-control @error('telefone') is-invalid @enderror" id="telefone" placeholder="(xx) xxxx-xxxx" name="telefone" value="{{ $farmacia->telefone }}">
                                    @error('telefone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <x-button>
                                    {{ __('Alterar') }}
                                </x-button>
                            </form>                          
                            </div>
                        </div>
                    </div>
                </div>
                <!---->
                <div class="pt-4 border-top mt-5">
                </div>
                <!---->
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <h2 class="text-white mb-2 mt-5">Endereço</h2>
                        <p class="text-lead text-white">Caso necessite, altere os dados:</p>
                    </div>
                    <div class="col-md-8">
                        <div class="card z-index-0">
                            <div class="card-body pb-3">
                              <form class="row g-3" method="POST" action="{{ route('farmacia.updateenderecos', $farmacia->id) }}">
                                @csrf
                                @method('PUT')                                  
                                
                                <div class="col-10">
                                    <label for="rua" class="form-label">Rua</label>
                                    <input type="text" class="form-control @error('rua') is-invalid @enderror" id="rua" placeholder="Ex: Rua Exemplo" name="rua" value="{{ $farmacia->rua }}">
                                    @error('rua')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="numero" class="form-label">Número</label>
                                    <input type="text" class="form-control @error('numero') is-invalid @enderror" id="numero" name="numero" value="{{ $farmacia->numero }}">
                                    @error('numero')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="bairro" class="form-label">Bairro</label>
                                    <input type="text" class="form-control @error('bairro') is-invalid @enderror" id="bairro" placeholder="Ex: Bairro Exemplo" name="bairro" value="{{ $farmacia->bairro }}">
                                    @error('bairro')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="cidade" class="form-label">Cidade</label>
                                    <input type="text" class="form-control @error('cidade') is-invalid @enderror" id="cidade" name="cidade" value="{{ $farmacia->cidade }}">
                                    @error('cidade')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="estado" class="form-label">Estado</label>
                                    <select id="estado" class="form-select @error('estado') is-invalid @enderror" name="estado">
                                        <option value="{{$farmacia->estado}}">{{$farmacia->estado}}</option>
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                    </select>
                                    @error('estado')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="cep" class="form-label">Cep</label>
                                    <input type="text" class="form-control @error('cep') is-invalid @enderror" id="cep" name="cep" value="{{ $farmacia->cep }}">
                                    @error('cep')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <x-button>
                                    {{ __('Alterar') }}
                                </x-button>
                            </form>                          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
      <x-footer/>
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
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('template/assets/js/soft-ui-dashboard.min.js?v=1.0.7')}}"></script>
</body>

</html>