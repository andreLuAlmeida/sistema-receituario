<x-geral.layout>

<body class="g-sidenav-show  bg-gray-100">
  <x-medico.receitas.receitas.menu-lateral>
  </x-medico.receitas.receitas.menu-lateral>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <x-medico.receitas.receitas.navbar-superior>
    </x-medico.receitas.receitas.navbar-superior>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12 mt-4">
          <div class="card">
            <div class="card-header pb-0 px-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Receitas:</h6>
                <div>
                    <a class="btn bg-gradient-dark mb-0" href="{{ route('prereceita.create') }}"><i class="fas fa-plus"></i>&nbsp;&nbsp; Criar receita</a>
                </div>
            </div>
          @if($receitas->isEmpty())
            <div class="mt-3 mb-3 ms-5">
            <tr>
                  <td colspan="5" class="text-center">Nenhuma receita encontrado.</td>
            </tr>
          </div>
          @else
              @foreach($receitas->sortByDesc('data_prescricao') as $receita)
                      <div class="card-body pt-4 p-3">
                          <ul class="list-group">
                              <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                  <div class="d-flex flex-column">
                                      <h6 class="mb-3 text-sm">Paciente: {{ $receita->paciente->nome }} {{$receita->paciente->sobrenome}}</h6>
                                      <span class="mb-2 text-xs">Data: <span class="text-dark font-weight-bold ms-sm-2">{{ \Carbon\Carbon::parse($receita->data_prescricao)->format('d/m/Y') }}</span></span>
                                    </div>
                                  <div class="ms-auto text-end">
                                      <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('receita.show', $receita->token) }}"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Detalhes</a>
                                  </div>
                              </li>
                          </ul>
                      </div>
              @endforeach
              <div class="d-flex justify-content-end mt-3">
                {{ $receitas->links() }}
            </div>
            
          @endif
        </div>
      </div>
      
      </div>
      <x-footer>
      </x-footer>
    </div>
  </main>
 <x-medico.receitas.receitas.script>
 </x-medico.receitas.receitas.script>
</body>
</x-geral.layout>