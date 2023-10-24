<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>{{ config('app.name') }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('hospital.png') }}">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('Medilab/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
  <link href="{{asset('Medilab/assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('Medilab/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('Medilab/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('Medilab/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('Medilab/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('Medilab/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('Medilab/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('Medilab/assets/css/style.css')}}" rel="stylesheet">

</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
   
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto">Receituário Digital</h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="{{asset('Medilab/assets/img/logo.png')}}" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="/">Home</a></li>
          <li><a class="nav-link scrollto" href="{{route('register.medico')}}">Médico</a></li>
          <li><a class="nav-link scrollto" href="{{route('register.farmacia')}}">Farmacia</a></li>
          <li><a class="nav-link scrollto" href="{{route('login')}}">Login</a></li>
          <li><a class="nav-link scrollto" href="{{route('contact.index')}}">Contato</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container">
        <h1>Seja bem-vindo</h1>
        <h2>Aqui você pode criar prescrições e validá-las facilmente</h2>        
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container">

        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="content">
                <h3>Por que escolher o Receituário Digital?</h3>
                <p>
                  O Receituário Digital é a solução ideal tanto para médicos quanto para farmácias, oferecendo uma plataforma abrangente que atende às necessidades de ambos.</p>
                
              <div class="text-center">
                <a href="#about" class="more-btn">Mais sobre<i class="bx bx-chevron-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-xl-4 d-flex align-items-stretch">
                    <div class="icon-box mt-4 mt-xl-0">
                      <i class="fas fa-stethoscope"></i> 
                      <h4>Cadastro de Médico</h4> 
                  
                      <a href="{{route('register.medico')}}"><p>Cadastre-se como médico </p> </a> <!-- Substitua "link-para-o-registro-do-medico" pelo link real -->
                    </div>
                  </div>                  
                  <div class="col-xl-4 d-flex align-items-stretch">
                    <div class="icon-box mt-4 mt-xl-0">
                      <i class="fas fa-prescription-bottle"></i> 
                      <h4>Cadastro de Farmácia</h4>
                      <a href="{{ route('register.farmacia') }}"><p>Cadastre-se como farmácia</p></a> <!-- Link para o registro de farmácia -->
                    </div>
                  </div>                  
                  <div class="col-xl-4 d-flex align-items-stretch">
                    <div class="icon-box mt-4 mt-xl-0">
                      <i class="fas fa-sign-in-alt"></i> 
                      <h4>Acessar a Sua Conta</h4>
                      <a href="{{ route('login') }}"><p>Faça login na sua conta</p></a>
                    </div>
                  </div>                  
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->

     <!-- ======= About Section ======= -->
     <section id="about" class="about">
        <div class="container-fluid">
  
          <div class="row">
            <div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch position-relative">
            </div>
  
            <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
                <h3 class="text-center">Funcionalidades</h3>
                <ul class="list-unstyled">
                  <li class="mb-3">
                    <strong>Registro de Pacientes:</strong> Para médicos, oferecemos a capacidade de registrar informações detalhadas dos pacientes de forma organizada e acessível, facilitando o acompanhamento do histórico de saúde.
                  </li>
              
                  <li class="mb-3">
                    <strong>Receitas Digitais Seguras:</strong> Crie receitas digitais de forma segura e eficiente para seus pacientes. Nossa plataforma oferece uma maneira simplificada de prescrever medicamentos, eliminando o risco de erros manuais.
                  </li>
              
                  <li class="mb-3">
                    <strong>Envio de Receitas:</strong> Envie as prescrições diretamente para seus pacientes, economizando tempo e garantindo que eles recebam as informações necessárias para seu tratamento.
                  </li>
              
                  <li class="mb-3">
                    <strong>Dispensação de Receitas:</strong> Para farmácias, oferecemos a capacidade de receber e dispensar as receitas digitais com facilidade, melhorando a eficiência e a precisão do processo.
                  </li>
              
                  <li class="mb-3">
                    <strong>Registro de Receitas Dispensadas:</strong> Mantenha um registro preciso de todas as receitas dispensadas, ajudando a acompanhar os medicamentos fornecidos aos pacientes e garantindo a conformidade.
                  </li>
                </ul>
              
                <p class="text-center mt-4">
                  O Receituário Digital é uma solução abrangente que aprimora a colaboração entre médicos e farmácias, tornando a prática médica mais eficiente e segura. Junte-se a nós e simplifique a sua rotina profissional.
                </p>
              </div>
              
          </div>
  
        </div>
      </section><!-- End About Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
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

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('Medilab/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('Medilab/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('Medilab/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('Medilab/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('Medilab/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('Medilab/assets/js/main.js')}}"></script>

</body>

</html>