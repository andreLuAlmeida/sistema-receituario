<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('template/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/x-icon" href="{{ asset('hospital.png') }}">
  <title>{{ config('app.name') }}</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('hospital.png') }}">
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('template/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link id="pagestyle" href="{{ asset('template//assets/css/soft-ui-dashboard.css?v=1.0.7')}}" rel="stylesheet" />
  <script src="{{ asset('js/qrcode.js') }}"></script>
</head>

<body class="">
<main class="main-content mt-0">
    <div class="text-center justify-content-center d-flex mt-3" >
        <button type="button" id="imprimirPagina" class="btn btn-secondary ml-2 w-25">Imprimir</button>
        <a type="button" class="btn btn-danger ml-2 w-25" href="{{route( 'receita.show-dispense-form', $receita->token)}}">Dispensar</a>
    </div>
    <section class="min-vh-100" id="meuElemento">
        <div class="page-header align-items-center min-vh-50 pt-5 pb-11 m-1 border-radius-lg" style="background-image: url('{{ asset('template/assets/img/curved-images/pilulas-brancas.jpg') }}');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12 mb-5">
                                                <h3 class="text-center">Receita Digital</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Nome Completo: {{ $medico->name }}</h6>
                                                <h6>CRM: {{ $medico->crm }}</h6>
                                                <h6>Clínica ou Consultório: {{ $medico->consultorio_clinica }}</h6>
                                                <h6>Telefone: {{ $medico->telefone }}</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Endereço: {{ $medico->rua }} {{ $medico->numero }}</h6>
                                                <h6>Bairro: {{ $medico->bairro }}</h6>
                                                <h6>Cidade: {{ $medico->cidade }}</h6>
                                                <h6>UF: {{ $medico->estado }}</h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h6>Data: {{ \Carbon\Carbon::parse($receita->data_prescricao)->format('d/m/Y') }}</h6>
                                            </div>
                                        </div> <!-- Linha horizontal para separar os cabeçalhos -->
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Paciente: {{ $paciente->nome }} {{ $paciente->sobrenome }}</h6>
                                                <h6>CPF: {{ $paciente->cpf }}</h6>
                                                <h6>Data de Nascimento: {{ \Carbon\Carbon::parse($paciente->data_nascimento)->format('d/m/Y') }}</h6>
                                                <h6>Sexo: {{ $paciente->sexo }}</h6>
                                                <h6>Idade: {{ \Carbon\Carbon::parse($paciente->data_nascimento)->age }} anos</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Endereço: {{ $paciente->rua }} {{ $paciente->numero_residencial }}</h6>
                                                <h6>Bairro: {{ $paciente->bairro }}</h6>
                                                <h6>Cidade: {{ $paciente->cidade }}</h6>
                                                <h6>UF: {{ $paciente->estado }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <ul class="list-group">
                                        @forelse ($prescricoes as $prescricao)
                                        <li class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-md-12">
                                                    <div class="card border-0">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <p><strong>Nome do Medicamento:</strong> {{ $prescricao->nome_medicamento }} - <strong>Dose:</strong> {{ $prescricao->dose }}</p>
                                                                    <p><strong>Forma Farmacêutica:</strong> {{ $prescricao->forma_farmaceutica }} - <strong>Via de Administração:</strong> {{ $prescricao->via_administracao }}</p>
                                                                    <p><strong>Frequência de Administração:</strong> {{ $prescricao->frequencia_administracao }} - <strong>Horário de Administração:</strong> {{ $prescricao->horario }}</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p><strong>Intervalo de Tempo:</strong> {{ $prescricao->intervalo_tempo }} - <strong>Quantidade de Doses:</strong> {{ $prescricao->quantidade_doses }}</p>
                                                                    <p><strong>Quantidade Total:</strong> {{ $prescricao->quantidade_total }} - <strong>Duração do Tratamento:</strong> {{ $prescricao->duracao_tratamento }}</p>
                                                                    <p><strong>Instruções de Cuidados:</strong> {{ $prescricao->instrucoes_cuidados }}</p>
                                                                    <p><strong>Outras Orientações:</strong> {{ $prescricao->outras_orientacoes }}</p>
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
                                <div class="col-md-12 mt-5">                                
                                    <h6>Observação:</h6>
                                    <p>{{ $receita->observacoes}}</p>
                                </div>
                            </div>
                            <div class="container text-center mt-6 pb-5">
                                <p>_____________________________________________________________</p>
                                <p><strong>Assinatura ou carimbo do médico</strong></p>
                            </div>
                            <div class="d-flex align-items-center m-3 border-top">
                                <div id="qrcode" class="mt-3"></div>
                                <div class="ml-3">
                                    <p>Escaneie o QR Code acima para acessar esta receita digital.</p>
                                    <p>Agradecemos por usar nosso sistema.</p>
                                </div>
                            </div>
                            @if ($dispensa)
<div class="d-flex align-items-center m-3 pt-6 border-top">
    <div class="form-group">
        <div class="container">
            <div class="row">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Dispensada em: {{ \Carbon\Carbon::parse($dispensa->data_dispensa)->format('d/m/Y') }}</h5>
                        <h6>Atenção: fique atento para casos de dispensa única!</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <x-footer/>
</main>

  <!--   Core JS Files   -->
  <script src="{{ asset('js/printThis.js') }}"></script>
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
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
        loadCSS: '{{ asset('template/assets/css/soft-ui-dashboard.css?v=1.0.7')}}',
    });
  });
</script>
<script>
  const linkReceitaPublica = '{{ route('receita.show-public', ['token' => $receita->token]) }}';
  const qrcodeElement = document.getElementById('qrcode');

  const qrcode = new QRCode(qrcodeElement, {
    text: linkReceitaPublica,
    width: 128, // Ajuste o tamanho do QR code conforme necessário
    height: 128,
  });
</script>

</body>

</html>