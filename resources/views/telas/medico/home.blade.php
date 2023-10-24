<x-geral.layout>
<body class="g-sidenav-show  bg-gray-100">
  <x-medico.home.home.menu-lateral>
  </x-medico.home.home.menu-lateral>  
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <x-medico.home.home.navbar-superior>
    </x-medico.home.home.navbar-superior>  
    <!-- End Navbar -->
    <div class="row">
      @if ($ultimaReceita)
        <div class="col-lg-6">
          <!-- Conteúdo da primeira div com informações da última receita -->
          <div class="card h-100 p-3">
            <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('../assets/img/ivancik.jpg');">
              <span class="mask bg-gradient-dark"></span>
              <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                <h5 class="text-white font-weight-bolder mb-4 pt-2">Última Receita</h5>
                <p class="text-white">Data da Receita: {{ \Carbon\Carbon::parse($ultimaReceita->data_prescricao)->format('d/m/Y') }}</p>
                @if ($ultimaReceita->token)
            <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="{{ route('receita.show', ['token' => $ultimaReceita->token]) }}">
              Ver Receita
              <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
            </a>
          @endif
              </div>
            </div>
          </div>
        </div>
      @else
        <div class="col-lg-6">
          <div class="alert alert-info mt-4">
            Nenhuma receita foi criada.
          </div>
        </div>
      @endif
    
      @if ($ultimoPaciente)
        <div class="col-lg-6">
          <!-- Conteúdo da segunda div com informações do último paciente -->
          <div class="card h-100 p-3">
            <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('../assets/img/ivancik.jpg');">
              <span class="mask bg-gradient-dark"></span>
              <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                <h5 class="text-white font-weight-bolder mb-4 pt-2">Último Paciente</h5>
                <p class="text-white">Nome do Paciente: {{ $ultimoPaciente->nome }}</p>
                <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="{{ route('paciente.show', ['id' => $ultimoPaciente->id]) }}">
                  Ver Paciente
                  <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      @else
        <div class="col-lg-6">
          <div class="alert alert-info mt-4">
            Nenhum paciente foi registrado.
          </div>
        </div>
      @endif
    </div>
    
    
    <x-footer>
    </x-footer>
  </main>
  <x-medico.home.home.script>
  </x-medico.home.home.script>
</body>
</x-geral.layout>