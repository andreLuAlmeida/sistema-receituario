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
            <li class="nav-item">
              <a class="nav-link me-2" href="{{route('contact.index')}}">
                <i class="fas fa-envelope opacity-6 me-1"></i>
                Contato
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
      <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('{{ asset('template/assets/img/curved-images/closeup-vista-da-mao-do-farmaceutico-tirando-a-caixa-de-remedios-da-prateleira-da-farmacia.jpg') }}');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
              <h1 class="text-white mb-2 mt-5">Bem-vindo ao Cadastro de Farmácia</h1>
              <p class="text-lead text-white">Aqui, farmacêuticos podem acessar e reter receitas emitidas por médicos através desta plataforma.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
          <div class="col-xl-8 col-lg-10 col-md-7 mx-auto">
            <div class="card z-index-0">
              <div class="card-body">
                <form class="row g-3" action="{{ route('register.farmacia') }}" method="POST">
                  @csrf
              
                  <div class="col-md-6">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                      @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="col-md-6">
                      <label for="password" class="form-label">Senha</label>
                      <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}">
                      @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
              
                  <div class="pt-4 border-top mt-5">
                      <h5>Informações:</h5>
                  </div>
                  <div class="col-8">
                      <label for="name" class="form-label">Nome da Farmácia</label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                      @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="col-md-4">
                      <label for="cnpj" class="form-label">CNPJ</label>
                      <input type="text" class="form-control @error('cnpj') is-invalid @enderror" id="cnpj" placeholder="xx.xxx.xxx/xxxx-xx" name="cnpj" value="{{ old('cnpj') }}">
                      @error('cnpj')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
              
                  <div class="pt-4 border-top mt-5">
                      <h5>Contato:</h5>
                  </div>
                  <div class="col-md-6">
                      <label for="celular" class="form-label">Celular</label>
                      <input type="text" class="form-control @error('celular') is-invalid @enderror" id="celular" placeholder="(xx) xxxxx-xxxx" name="celular" value="{{ old('celular') }}">
                      @error('celular')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="col-md-6">
                      <label for="telefone" class="form-label">Telefone</label>
                      <input type="text" class="form-control @error('telefone') is-invalid @enderror" id="telefone" placeholder="(xx) xxxx-xxxx" name="telefone" value="{{ old('telefone') }}">
                      @error('telefone')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
              
                  <div class="pt-4 border-top mt-5">
                      <h5>Endereço:</h5>
                  </div>
                  <div class="col-10">
                      <label for="rua" class="form-label">Rua</label>
                      <input type="text" class="form-control @error('rua') is-invalid @enderror" id="rua" placeholder="Ex: Rua Exemplo" name="rua" value="{{ old('rua') }}">
                      @error('rua')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="col-md-2">
                      <label for="numero" class="form-label">Número</label>
                      <input type="text" class="form-control @error('numero') is-invalid @enderror" id="numero" name="numero" value="{{ old('numero') }}">
                      @error('numero')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="col-12">
                      <label for="bairro" class="form-label">Bairro</label>
                      <input type="text" class="form-control @error('bairro') is-invalid @enderror" id="bairro" placeholder="Ex: Bairro Exemplo" name="bairro" value="{{ old('bairro') }}">
                      @error('bairro')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="col-md-6">
                      <label for="cidade" class="form-label">Cidade</label>
                      <input type="text" class="form-control @error('cidade') is-invalid @enderror" id="cidade" name="cidade" value="{{ old('cidade') }}">
                      @error('cidade')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="col-md-4">
                      <label for="estado" class="form-label">Estado</label>
                      <select id="estado" class="form-select @error('estado') is-invalid @enderror" name="estado">
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
                      <input type="text" class="form-control @error('cep') is-invalid @enderror" id="cep" name="cep" value="{{ old('cep') }}">
                      @error('cep')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="col-12">
                      <button type="submit" class="btn btn-primary w-100 mt-2">Cadastrar</button>
                  </div>
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