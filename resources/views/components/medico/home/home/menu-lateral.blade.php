<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" target="_blank">
      <span class="ms-1 font-weight-bold">ReceituárioDigital</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class=" w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link  active" href="{{route('medico.home')}}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-home"></i>
          </div>
          <span class="nav-link-text ms-1">Home</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  " href="{{route('medico.pacientes')}}">
          <i class="fa fa-user"></i>
          <span class="nav-link-text ms-1">Pacientes</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  " href="{{route('medico.receitas')}}">
          <i class="fa fa-book"></i>
          <span class="nav-link-text ms-1">Receitas</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Opções de conta</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link  " href="{{route('medico.show')}}">
          <i class="fas fa-user-md"></i>
          <span class="nav-link-text ms-1">Dados de médico</span>
        </a>
      </li>
    </ul>
  </div>
</aside>