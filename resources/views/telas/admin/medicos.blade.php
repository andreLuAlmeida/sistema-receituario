<x-geral.layout>
<body class="g-sidenav-show  bg-gray-100">
  <x-admin.medicos.menu-lateral>
  </x-admin.medicos.menu-lateral>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <x-admin.medicos.navbar-superior>
    </x-admin.medicos.navbar-superior>
    <!-- End Navbar -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="d-flex justify-content-between align-items-center">
                  <h6 class="mb-0">Médicos</h6>
              </div>
          </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome/Email</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">CRM</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">aprovado</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($medicos) > 0)
                      @foreach($medicos as $medico)
                      <td>
                        <div class="d-flex px-2 py-1">
                          @foreach ($medico->users as $user)
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                            <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                        </div>
                          @endforeach
                      </div>
              </td>
              <td>
                <p class="text-xs font-weight-bold mb-0">{{ $medico->crm }}</p>
              </td>
              <td class="align-middle text-center text-sm">
                <p class="text-xs font-weight-bold mb-0">
                  @if($medico->aprovado)
                      Verdadeiro
                  @else
                      Falso
                  @endif
              </p>
              </td>
      <td class="align-middle">
        <a href="{{route('admin-medico.show', $medico->id)}}" class="text-primary text-xs font-weight-bold">Detalhes</a>
      </td>
      <td class="align-middle">
        <a href="#" class="text-danger text-xs font-weight-bold" data-toggle="modal" data-target="#confirmDelete{{ $medico->id }}">Deletar</a>
        <!-- Modal de Confirmação de Exclusão -->
        @component('components.admin.medico-excluir', ['medico' => $medico])
        @endcomponent
      </td>
    </tr>
    <tr>
        @endforeach
        
      
        @else
        <tr>
            <td colspan="5" class="text-center">Nenhum médico encontrado.</td>
        </tr>
        @endif
                  </tbody>
                </table>
              </div>
            </div>
            <div class="d-flex justify-content-center">
              <div class="ml-auto">
                  {{ $medicos->links() }}
              </div>
          </div>
          </div>
        </div>
      </div>
        <x-footer/>
    </div>
  </main>
  <x-admin.medicos.script>
  </x-admin.medicos.script>
</body>
</x-geral.layout>
