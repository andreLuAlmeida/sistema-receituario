<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <!--Mostra em qual pagina estou-->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{route('medico.home')}}:;">Páginas</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="{{ route('profile.show') }}">Perfil</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Perfil</h6>
      </nav>
        <!--Termina em qual pagina estou-->
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">  
        </div>
        <ul class="navbar-nav  justify-content-end">
          <li class="nav-item d-flex align-items-center">
            <a href="{{ route('medico.home') }}" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-home me-sm-1"></i>
                <span class="d-sm-inline d-none">Home</span>
            </a>
        </li>
        </ul>
      </div>
    </div>
  </nav>