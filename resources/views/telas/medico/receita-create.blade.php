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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link id="pagestyle" href="{{ asset('template/assets/css/soft-ui-dashboard.css?v=1.0.7')}}" rel="stylesheet" />
</head>

<body class="">
  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <!--Mostra em qual pagina estou-->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{route('medico.home')}}">Páginas</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a href="{{route('medico.pacientes')}}">Receitas</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a href="{{route('paciente.create')}}">Criar</a></li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Criar Receita</h6>
      </nav>
        <!--Termina em qual pagina estou-->
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">  
        </div>
        <ul class="navbar-nav  justify-content-end">
          <li class="nav-item d-flex align-items-center">
            <a href="{{ route('medico-profile.show') }}" class="nav-link text-body font-weight-bold px-0">
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
        <div class="page-header align-items-center min-vh-50 pt-5 pb-11 m-1 border-radius-lg" style="background-image: url('{{ asset('template/assets/img/curved-images/paciente-online.jpg') }}');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center mb-4">
                        <h1 class="text-white mb-2 mt-5">Receita</h1>
                        <p class="text-lead text-white">Crie uma nova receita médica personalizada para seus pacientes. Selecione o paciente, adicione os detalhes da prescrição e salve sua receita com facilidade.</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card z-index-0">
                            <div class="card-body col-md-10 mx-auto">
                                <form id="form-receita" method="POST" action="{{ route('receita.store', $receita->id) }}">
                                    @csrf
                                    <!-- Nome do Medicamento -->
                                    <div class="form-group">
                                        <h5>Paciente:</h5>
                                        <h5><pre>   {{ $receita->paciente->nome }} {{$receita->paciente->sobrenome}}</pre></h5>
                                    </div>
                                    <div class="form-group">
                                        <p>Prescrições:</p>
                                        <ul class="list-group">
                                            @forelse ($prescricoes as $prescricao)
                                            <li class="list-group-item">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-12">
                                                        <div class="card z-index-0">
                                                            <div class="card-body col-md-10 mx-auto">
                                                                <div>
                                                                    <div class="btn-group">
                                                                        <!-- Botão de Edição (Ícone de Lápis) -->
                                                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editarPrescricaoModal{{ $prescricao->id }}">
                                                                            <i class="fas fa-pencil-alt"></i> <!-- Ícone de Lápis -->
                                                                        </button>
                                                                        <!-- Botão de Exclusão (Ícone de Lixeira) -->
                                                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#excluirPrescricaoModal{{ $prescricao->id }}" data-prescricao-id="{{ $prescricao->id }}">
                                                                            <i class="fas fa-trash-alt"></i> <!-- Ícone de Lixeira -->
                                                                        </button>
                                                                    </div>
                                                                    <div class="row">
                                                                        <!-- Nome do Medicamento -->
                                                                        <div class="form-group col-md-6">
                                                                            <label for="nome_medicamento">Nome do Medicamento:</label>
                                                                            <div>{{ $prescricao->nome_medicamento }}</div>
                                                                        </div>
                                                                    
                                                                        <!-- Dose -->
                                                                        <div class="form-group col-md-2">
                                                                            <label for="dose">Dose:</label>
                                                                            <div>{{ $prescricao->dose }}</div>
                                                                        </div>
                                                                    
                                                                        <!-- Forma Farmacêutica -->
                                                                        <div class="form-group col-md-4">
                                                                            <label for="forma_farmaceutica">Forma Farmacêutica:</label>
                                                                            <div>{{ $prescricao->forma_farmaceutica }}</div>
                                                                        </div>
                                                                    
                                                                        <!-- Via de Administração -->
                                                                        <div class="form-group col-md-6">
                                                                            <label for="via_administracao">Via de Administração:</label>
                                                                            <div>{{ $prescricao->via_administracao }}</div>
                                                                        </div>
                                                                    
                                                                        <!-- Frequência de Administração -->
                                                                        <div class="form-group col-md-6">
                                                                            <label for="frequencia_administracao">Frequência de Administração:</label>
                                                                            <div>{{ $prescricao->frequencia_administracao }}</div>
                                                                        </div>
                                                                    
                                                                        <!-- Horário de Administração -->
                                                                        <div class="form-group col-md-6">
                                                                            <label for="horario">Horário de Administração:</label>
                                                                            <div>{{ $prescricao->horario }}</div>
                                                                        </div>
                                                                    
                                                                        <!-- Intervalo de Tempo -->
                                                                        <div class="form-group col-md-4">
                                                                            <label for="intervalo_tempo">Intervalo de Tempo:</label>
                                                                            <div>{{ $prescricao->intervalo_tempo }}</div>
                                                                        </div>
                                                                    
                                                                        <!-- Quantidade de Doses -->
                                                                        <div class="form-group col-md-4">
                                                                            <label for="quantidade_doses">Quantidade de Doses:</label>
                                                                            <div>{{ $prescricao->quantidade_doses }}</div>
                                                                        </div>
                                                                    
                                                                        <!-- Quantidade Total -->
                                                                        <div class="form-group col-md-4">
                                                                            <label for="quantidade_total">Quantidade Total:</label>
                                                                            <div>{{ $prescricao->quantidade_total }}</div>
                                                                        </div>
                                                                    
                                                                        <!-- Duração do Tratamento -->
                                                                        <div class="form-group col-md-4">
                                                                            <label for="duracao_tratamento">Duração do Tratamento:</label>
                                                                            <div>{{ $prescricao->duracao_tratamento }}</div>
                                                                        </div>
                                                                    
                                                                        <!-- Instruções de Cuidados -->
                                                                        <div class="form-group">
                                                                            <label for="instrucoes_cuidados">Instruções de Cuidados:</label>
                                                                            <div>{{ $prescricao->instrucoes_cuidados }}</div>
                                                                        </div>
                                                                    
                                                                        <!-- Outras Orientações -->
                                                                        <div class="form-group">
                                                                            <label for="outras_orientacoes">Outras Orientações:</label>
                                                                            <div>{{ $prescricao->outras_orientacoes }}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            @empty
                                
                                            @endforelse
                                        </ul>
                                    </div>
                                    <!-- Outras Orientações -->
                                    <div class="form-group">
                                        <label for="observacoes">Observação:</label>
                                        <textarea id="observacoes" name="observacoes" class="form-control" rows="5" cols="50"></textarea>
                                        @error('observacoes')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>                                    
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#prescricaoModal">
                                        +Adicionar prescrição
                                    </button>
                                    <button type="submit" class="btn btn-primary">Salvar Receita</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-footer/>
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
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('template/assets/js/soft-ui-dashboard.min.js?v=1.0.7')}}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

<div class="modal fade" id="prescricaoModal" tabindex="-1" aria-labelledby="prescricaoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="prescricaoModalLabel">Adicionar Prescrição</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-prescricao" method="POST" action="{{ route('prescricao.store', $receita->id) }}">
                    @csrf
            <div class="row">
                    <!-- Nome do Medicamento -->
                    <div class="form-group col-md-6">
                        <label for="nome_medicamento">Nome do Medicamento:</label>
                        <input type="text" id="nome_medicamento" name="nome_medicamento" class="form-control">
                        @error('nome_medicamento')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <!-- Dose -->
                    <div class="form-group col-md-2">
                        <label for="dose">Dose:</label>
                        <input type="text" id="dose" name="dose" class="form-control">
                        @error('dose')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Forma Farmacêutica -->
                    <div class="form-group col-md-4">
                        <label for="forma_farmaceutica">Forma Farmacêutica:</label>
                        <select id="forma_farmaceutica" name="forma_farmaceutica" class="form-control">
                            <option value="comprimido">Comprimido</option>
                            <option value="cápsula">Cápsula</option>
                            <option value="solução oral">Solução Oral</option>
                            <option value="pomada">Pomada</option>
                        </select>
                        @error('forma_farmaceutica')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Via de Administração -->
                    <div class="form-group col-md-6">
                        <label for="via_administracao">Via de Administração:</label>
                        <input type="text" id="via_administracao" name="via_administracao" class="form-control">
                        @error('via_administracao')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Frequência de Administração -->
                    <div class="form-group col-md-6">
                        <label for="frequencia_administracao">Frequência de Administração:</label>
                        <input type="text" id="frequencia_administracao" name="frequencia_administracao" class="form-control">
                        @error('frequencia_administracao')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Horário de Administração -->
                    <div class="form-group col-md-6">
                        <label for="horario">Horário de Administração:</label>
                        <input type="text" id="horario" name="horario" class="form-control">
                        @error('horario')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <!-- Intervalo de Tempo -->
                    <div class="form-group col-md-4">
                        <label for="intervalo_tempo">Intervalo de Tempo:</label>
                        <input type="text" id="intervalo_tempo" name="intervalo_tempo" class="form-control">
                        @error('intervalo_tempo')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <!-- Quantidade de Doses -->
                    <div class="form-group col-md-4">
                        <label for="quantidade_doses">Quantidade de Doses:</label>
                        <input type="text" id="quantidade_doses" name="quantidade_doses" class="form-control">
                        @error('quantidade_doses')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <!-- Quantidade Total -->
                    <div class="form-group col-md-4">
                        <label for="quantidade_total">Quantidade Total:</label>
                        <input type="text" id="quantidade_total" name="quantidade_total" class="form-control">
                        @error('quantidade_total')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <!-- Duração do Tratamento -->
                    <div class="form-group col-md-4">
                        <label for="duracao_tratamento">Duração do Tratamento:</label>
                        <input type="text" id="duracao_tratamento" name="duracao_tratamento" class="form-control">
                        @error('duracao_tratamento')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <!-- Instruções de Cuidados -->
                    <div class="form-group">
                        <label for="instrucoes_cuidados">Instruções de Cuidados:</label>
                        <textarea id="instrucoes_cuidados" name="instrucoes_cuidados" class="form-control"></textarea>
                        @error('instrucoes_cuidados')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <!-- Outras Orientações -->
                    <div class="form-group">
                        <label for="observacao">Outras Orientações:</label>
                        <textarea id="outras_orientacoes" name="outras_orientacoes" class="form-control"></textarea>
                        @error('outras_orientacoes')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                    <button type="submit" class="btn btn-primary">Salvar Prescrição</button>
                </form>
                
            </div>
        </div>
    </div>
</div>

@if ($prescricoes->count() > 0)
@foreach ($prescricoes as $prescricao)
  <!-- Modal de Edição de Observação -->
  <div class="modal fade" id="editarPrescricaoModal{{ $prescricao->id }}" tabindex="-1" role="dialog" aria-labelledby="editarPrescricaoModalLabel{{ $prescricao->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarPrescricaoModalLabel{{ $prescricao->id }}">Editar Prescrição</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('prescricao.update', $prescricao->id) }}">
                @csrf
                @method('PUT')
            <div class="row">
                <!-- Nome do Medicamento -->
                <div class="form-group col-md-6">
                    <label for="nome_medicamento">Nome do Medicamento:</label>
                    <input type="text" id="nome_medicamento" name="nome_medicamento" class="form-control" value="{{ $prescricao->nome_medicamento ?? '' }}">
                    @error('nome_medicamento')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            
                <!-- Dose -->
                <div class="form-group col-md-2">
                    <label for= "dose">Dose:</label>
                    <input type="text" id="dose" name="dose" class="form-control" value="{{ $prescricao->dose ?? '' }}">
                    @error('dose')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            
                <!-- Forma Farmacêutica -->
                <div class="form-group col-md-4">
                    <label for="forma_farmaceutica">Forma Farmacêutica:</label>
                    <select id="forma_farmaceutica" name="forma_farmaceutica" class="form-control">
                        <option value="comprimido" {{ ($prescricao->forma_farmaceutica ?? '') === 'comprimido' ? 'selected' : '' }}>Comprimido</option>
                        <option value="cápsula" {{ ($prescricao->forma_farmaceutica ?? '') === 'cápsula' ? 'selected' : '' }}>Cápsula</option>
                        <option value="solução oral" {{ ($prescricao->forma_farmaceutica ?? '') === 'solução oral' ? 'selected' : '' }}>Solução Oral</option>
                        <option value="pomada" {{ ($prescricao->forma_farmaceutica ?? '') === 'pomada' ? 'selected' : '' }}>Pomada</option>
                    </select>
                    @error('forma_farmaceutica')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            
                <!-- Via de Administração -->
                <div class="form-group col-md-6">
                    <label for="via_administracao">Via de Administração:</label>
                    <input type="text" id="via_administracao" name="via_administracao" class="form-control" value="{{ $prescricao->via_administracao ?? '' }}">
                    @error('via_administracao')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Frequência de Administração -->
                <div class="form-group col-md-6">
                    <label for="frequencia_administracao">Frequência de Administração:</label>
                    <input type="text" id="frequencia_administracao" name="frequencia_administracao" class="form-control" value="{{ $prescricao->frequencia_administracao ?? '' }}">
                    @error('frequencia_administracao')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            
                <!-- Horário de Administração -->
                <div class="form-group col-md-6">
                    <label for="horario">Horário de Administração:</label>
                    <input type="text" id="horario" name="horario" class="form-control" value="{{ $prescricao->horario ?? '' }}">
                    @error('horario')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Intervalo de Tempo -->
                <div class="form-group col-md-4">
                    <label for="intervalo_tempo">Intervalo de Tempo:</label>
                    <input type="text" id="intervalo_tempo" name="intervalo_tempo" class="form-control" value="{{ $prescricao->intervalo_tempo ?? '' }}">
                    @error('intervalo_tempo')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Quantidade de Doses -->
                <div class="form-group col-md-4">
                    <label for="quantidade_doses">Quantidade de Doses:</label>
                    <input type="text" id="quantidade_doses" name="quantidade_doses" class="form-control" value="{{ $prescricao->quantidade_doses ?? '' }}">
                    @error('quantidade_doses')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Quantidade Total -->
                <div class="form-group col-md-4">
                    <label for="quantidade_total">Quantidade Total:</label>
                    <input type="text" id="quantidade_total" name="quantidade_total" class="form-control" value="{{ $prescricao->quantidade_total ?? '' }}">
                    @error('quantidade_total')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Duração do Tratamento -->
                <div class="form-group col-md-4">
                    <label for="duracao_tratamento">Duração do Tratamento:</label>
                    <input type="text" id="duracao_tratamento" name="duracao_tratamento" class="form-control" value="{{ $prescricao->duracao_tratamento ?? '' }}">
                    @error('duracao_tratamento')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Instruções de Cuidados -->
                <div class="form-group">
                    <label for="instrucoes_cuidados">Instruções de Cuidados:</label>
                    <textarea id="instrucoes_cuidados" name="instrucoes_cuidados" class="form-control">{{ $prescricao->instrucoes_cuidados ?? '' }}</textarea>
                    @error('instrucoes_cuidados')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Outras Orientações -->
                <div class="form-group">
                    <label for="outras_orientacoes">Outras Orientações:</label>
                    <textarea id="outras_orientacoes" name="outras_orientacoes" class="form-control">{{ $prescricao->outras_orientacoes ?? '' }}</textarea>
                    @error('outras_orientacoes')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </form>
        </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($prescricoes as $prescricao)
<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="excluirPrescricaoModal{{ $prescricao->id }}" tabindex="-1" role="dialog" aria-labelledby="excluirPrescricaoModalLabel{{ $prescricao->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="excluirPrescricaoModalLabel{{ $prescricao->id }}">Confirmar Exclusão</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Tem certeza de que deseja excluir esta prescrição?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <form method="POST" action="{{ route('prescricao.destroy', $prescricao->id) }}">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
@endif

</html>