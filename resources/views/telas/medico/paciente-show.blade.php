<x-geral.layout>
  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <!--Mostra em qual pagina estou-->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{route('medico.home')}}">Páginas</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a href="{{route('medico.pacientes')}}">Pacientes</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a href="">Ficha {{$paciente->nome}} {{$paciente->sobrenome}}</a></li>
        </ol>
        <h6 class="font-weight-bolder mb-0">{{$paciente->nome}} {{$paciente->sobrenome}}</h6>
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
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<main class="main-content mt-0">
  <section class="min-vh-100" id="meuElemento">
      <div class="page-header align-items-start min-vh-50 pt-5 pb-5 m-1 border-radius-lg" style="">
          <span class="mask bg-gradient-dark opacity-6"></span>
          <div class="container">
              <div class="row justify-content-center">
                  <div class="col-md-12">
                      <div class="card z-index-0">
                          <div class="card-body">
                              <div class="pt-2 d-flex justify-content-between align-items-center mb-4">
                                  <h5>Ficha do paciente:</h5>
                              </div>
                              <div class="row">
                                  <div class="col-12">
                                      <label for="nome" class="form-label">Nome Completo:</label>
                                      <p>{{ $paciente->nome }} {{ $paciente->sobrenome }}</p>
                                  </div>
                                  <div class="col-md-2">
                                      <label for="cpf" class="form-label">CPF:</label>
                                      <p>{{ $paciente->cpf }}</p>
                                  </div>
                                  <div class="col-md-2">
                                      <label for="rg" class="form-label">RG:</label>
                                      <p>{{ $paciente->rg }}</p>
                                  </div>
                                  <div class="col-md-8">
                                    
                                  </div>
                                  <div class="col-md-2">
                                      <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
                                      <p>{{ $paciente->data_nascimento }}</p>
                                  </div>
                                  <div class="col-md-2">
                                      <label for="sexo" class="form-label">Sexo:</label>
                                      <p>{{ $paciente->sexo }}</p>
                                  </div>
                                  <div class="col-md-2">
                                      <label for="profissao" class="form-label">Profissão:</label>
                                      <p>{{ $paciente->profissao }}</p>
                                  </div>
                                  <div class="col-md-6">
                                    
                                  </div>
                              </div>
                              <div class="pt-4 border-top mt-5">
                                  <h5>Contato:</h5>
                              </div>
                              <div class="row">
                                  <div class="col-md-12">
                                      <label for="email" class="form-label">Email:</label>
                                      <p>{{ $paciente->email }}</p>
                                  </div>
                                  <div class="col-md-2">
                                      <label for="celular" class="form-label">Celular:</label>
                                      <p>{{ $paciente->celular }}</p>
                                  </div>
                                  <div class="col-md-2">
                                      <label for="telefone" class="form-label">Telefone:</label>
                                      <p>{{ $paciente->telefone }}</p>
                                  </div>
                                  <div class="col-md-8">
                                    
                                  </div>
                              </div>
                              <div class="pt-4 border-top mt-5">
                                  <h5>Endereço:</h5>
                              </div>
                              <div class="row">
                                  <div class="col-2">
                                      <label for="rua" class="form-label">Rua:</label>
                                      <p>{{ $paciente->rua }}</p>
                                  </div>
                                  <div class="col-md-2">
                                      <label for="numero_residencial" class="form-label">Número:</label>
                                      <p>{{ $paciente->numero_residencial }}</p>
                                  </div>
                                  <div class="col-2">
                                      <label for="bairro" class="form-label">Bairro:</label>
                                      <p>{{ $paciente->bairro }}</p>
                                  </div>
                                  <div class="col-md-6">
                                    
                                  </div>
                                  <div class="col-md-2">
                                      <label for="cidade" class="form-label">Cidade:</label>
                                      <p>{{ $paciente->cidade }}</p>
                                  </div>
                                  <div class="col-md-2">
                                      <label for="estado" class="form-label">Estado:</label>
                                      <p>{{ $paciente->estado }}</p>
                                  </div>
                                  <div class="col-md-2">
                                      <label for="cep" class="form-label">CEP:</label>
                                      <p>{{ $paciente->cep }}</p>
                                  </div>
                              </div>
                              <div class="pt-4 border-top mt-5 d-flex justify-content-between">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adicionarObservacaoModal">+Adicionar Observação</button>                              
                                <div>
                                    <a href="{{ route('paciente.edit', $paciente->id) }}" class="btn btn-secondary">Editar</a>
                                    <button type="button" id="imprimirPagina" class="btn btn-secondary ml-2">Imprimir</button>
                                </div>
                            </div>                                                   
                          </div>
                          <div class="card-body col-md-12">
                            <div class="list-group">
                                @forelse ($observacoes as $observacao)
                                    <div class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($observacao->data_preenchimento)->format('d/m/Y H:i') }}</small>
                                            <div class="btn-group">
                                                <!-- Botão de Edição (Ícone de Lápis) -->
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editarObservacaoModal{{ $observacao->id }}">
                                                    <i class="fas fa-pencil-alt"></i> <!-- Ícone de Lápis -->
                                                </button>
                                                <!-- Botão de Exclusão (Ícone de Lixeira) -->
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#excluirObservacaoModal{{ $observacao->id }}" data-observacao-id="{{ $observacao->id }}">
                                                    <i class="fas fa-trash-alt"></i> <!-- Ícone de Lixeira -->
                                                </button>
                                            </div>
                                        </div>
                                        <p class="mb-1">{{ $observacao->observacao }}</p>
                                    </div>
                                @empty
                                
                                @endforelse
                            </div>
                                      
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
</main>
<x-footer>
</x-footer>

<x-medico.pacientes.pacientes.script>
</x-medico.pacientes.pacientes.script>

</x-geral.layout>
<!-- jQuery --> 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- PrintThis Js --> 
<script src="{{ asset('js/printThis.js') }}"></script>
<script>
/*  document.getElementById('imprimirPagina').addEventListener('click', function (e) {
    e.preventDefault();

    $("#meuElemento").printThis({  
      importCSS: true,
      removeElements: '.btn, a',
    });
  });*/
  $(document).on('click', '#imprimirPagina',function(){
    console.log('teste')
    $("#meuElemento").printThis({  
        importCSS: true,      // Importar estilos da página
        importStyle: true,
        removeElements: '.btn, a, .btn-group',  // Remover botões, links e elementos com classe .btn-group
    });
  });
</script>

<div class="modal fade" id="adicionarObservacaoModal" tabindex="-1" role="dialog" aria-labelledby="adicionarObservacaoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="adicionarObservacaoModalLabel">Adicionar Observação</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form method="POST" action="{{ route('observacao.store', $paciente->id) }}">
              @csrf
              <div class="modal-body">
                  <div class="form-group">
                      <label for="observacao">Observação:</label>
                      <textarea class="form-control" id="observacao" name="observacao" rows="3" required></textarea>
                  </div>
                  <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Salvar</button>
              </div>
          </form>
      </div>
  </div>
</div>

@if ($observacoes->count() > 0)
@foreach ($observacoes as $observacao)
  <!-- Modal de Edição de Observação -->
  <div class="modal fade" id="editarObservacaoModal{{ $observacao->id }}" tabindex="-1" role="dialog" aria-labelledby="editarObservacaoModalLabel{{ $observacao->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarObservacaoModalLabel{{ $observacao->id }}">Editar Observação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('observacao.update', $observacao->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="observacao">Observação:</label>
                        <textarea class="form-control" id="observacao" name="observacao" rows="3" required>{{ $observacao->observacao }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@foreach ($observacoes as $observacao)
<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="excluirObservacaoModal{{ $observacao->id }}" tabindex="-1" role="dialog" aria-labelledby="excluirObservacaoModalLabel{{ $observacao->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="excluirObservacaoModalLabel{{ $observacao->id }}">Confirmar Exclusão</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Tem certeza de que deseja excluir esta observação?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <form method="POST" action="{{ route('observacao.destroy', $observacao->id) }}">
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