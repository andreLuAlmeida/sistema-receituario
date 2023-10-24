<x-geral.layout>
<body class="g-sidenav-show  bg-gray-100">
  <x-medico.pacientes.pacientes.menu-lateral>
  </x-medico.pacientes.pacientes.menu-lateral>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <x-medico.pacientes.pacientes.navbar-superior>
    </x-medico.pacientes.pacientes.navbar-superior>
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
                  <h6 class="mb-0">Pacientes</h6>
                  <a href="{{route('paciente.create')}}" class="btn btn-primary">+ Adicionar</a>
              </div>
          </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome/Email</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Profissão</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sexo</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Data de nascimento</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($pacientes) > 0) <!-- Verifique se o array $pacientes possui elementos -->
                    @foreach($pacientes as $paciente)
        <tr>
            <td>
                <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $paciente['nome'] }} {{$paciente['sobrenome']}}</h6>
                        <p class="text-xs text-secondary mb-0">{{ $paciente['email'] }}</p>
                    </div>
                </div>
            </td>
            <td>
                <p class="text-xs font-weight-bold mb-0">{{ $paciente['profissao'] }}</p>
            </td>
            <td class="align-middle text-center text-sm">
              <p class="text-xs font-weight-bold mb-0">{{ $paciente['sexo'] }}</p>
            </td>
            <td class="align-middle text-center">
              <span class="text-xs font-weight-bold">
                {{ \Carbon\Carbon::parse($paciente['data_nascimento'])->format('d/m/Y') }}
            </span>       
            @php
            $dataNascimento = new DateTime($paciente['data_nascimento']);
            $dataAtual = new DateTime();
            $idade = $dataNascimento->diff($dataAtual)->y;
        @endphp
        @if ($idade >  0)
          <p class="text-xs text-secondary mb-0">{{ $idade }} anos</p>
        @endif
            </td>
            <td class="align-middle">
              <a href="{{route('paciente.show', $paciente->id)}}" class="text-primary text-xs font-weight-bold">Ficha</a>
            </td>
            <td class="align-middle">
              <a href="#" class="text-danger text-xs font-weight-bold" data-toggle="modal" data-target="#confirmDelete{{ $paciente->id }}">Deletar</a>
              <!-- Modal de Confirmação de Exclusão -->
              @component('components.medico.paciente-excluir', ['paciente' => $paciente])
              @endcomponent
          </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="5" class="text-center">Nenhum paciente encontrado.</td>
        </tr>
        @endif
                  </tbody>
                </table>
              </div>
              <div class="d-flex justify-content-end mt-3">
                {{ $pacientes->links() }}
            </div>
            </div>
          </div>
        </div>
      </div>
        <x-footer/>
    </div>
  </main>
  <x-medico.pacientes.pacientes.script>
  </x-medico.pacientes.pacientes.script>
</body>
</x-geral.layout>
