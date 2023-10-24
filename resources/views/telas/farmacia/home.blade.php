<x-geral.layout>

  <body class="g-sidenav-show  bg-gray-100">
    <x-farmacia.receitas.receitas.menu-lateral>
    </x-farmacia.receitas.receitas.menu-lateral>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
      <!-- Navbar -->
      <x-farmacia.receitas.receitas.navbar-superior>
      </x-farmacia.receitas.receitas.navbar-superior>
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-12 mt-4">
            <div class="card">
              <div class="card-header pb-0 px-3 d-flex justify-content-between align-items-center">
                  <h6 class="mb-0">Registros De Dispensas:</h6>
              </div>
            @if($registrosDeDispensas->isEmpty())
              <div class="mt-3 mb-3 ms-5">
              <tr>
                    <td colspan="5" class="text-center">Nenhuma dispensa encontrada.</td>
              </tr>
            </div>
            @else
                @foreach($registrosDeDispensas as $registroDeDispensa)
                        <div class="card-body pt-4 p-3">
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">Quem realizou a dispensa: {{ $registroDeDispensa->nome_balconista}}</h6>
                                        <h6 class="mb-3 text-sm">Paciente: {{ $registroDeDispensa->receita->paciente->nome }}</h6>
                                        <span class="mb-2 text-xs">Data: <span class="text-dark font-weight-bold ms-sm-2">{{ \Carbon\Carbon::parse($registroDeDispensa->data_dispensa)->format('d/m/Y') }}</span></span>
                                      </div>
                                    <div class="ms-auto text-end">
                                        <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('dispensa.show', $registroDeDispensa->id) }}"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Detalhes</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                @endforeach
            @endif
          </div>
          <div class="d-flex justify-content-end mt-3">
            {{ $registrosDeDispensas->links() }}
        </div>
        </div>
        
        </div>
        <x-footer>
        </x-footer>
      </div>
    </main>
   <x-farmacia.receitas.receitas.script>
   </x-farmacia.receitas.receitas.script>
  </body>
  </x-geral.layout>