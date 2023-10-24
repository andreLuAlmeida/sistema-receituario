@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Aprovar Médico</div>

                    <div class="card-body">
                        <h2>Informações do Médico</h2>
                        <ul>
                            <li><strong>Nome:</strong> {{ $medico->user->name }}</li>
                            <li><strong>CRM:</strong> {{ $medico->crm }}</li>
                            <li><strong>Especialidade:</strong> {{ $medico->especialidade }}</li>
                            <li><strong>CPF:</strong> {{ $medico->cpf }}</li>
                            <li><strong>RG:</strong> {{ $medico->rg ?? 'N/A' }}</li>
                            <li><strong>Data de Nascimento:</strong> {{ $medico->data_nascimento }}</li>
                            <li><strong>Telefone:</strong> {{ $medico->telefone ?? 'N/A' }}</li>
                            <li><strong>Celular:</strong> {{ $medico->celular ?? 'N/A' }}</li>
                            <li><strong>CEP:</strong> {{ $medico->cep }}</li>
                            <li><strong>Estado:</strong> {{ $medico->estado }}</li>
                            <li><strong>Cidade:</strong> {{ $medico->cidade }}</li>
                            <li><strong>Bairro:</strong> {{ $medico->bairro }}</li>
                            <li><strong>Rua:</strong> {{ $medico->rua }}</li>
                            <li><strong>Número:</strong> {{ $medico->numero }}</li>
                            <li><strong>QR Code de Assinatura:</strong> {{ $medico->qrcode_assinatura ?? 'N/A' }}</li>
                        </ul>

                        <form method="POST" action="{{ route('admin.medico.processar-aprovacao', $medico) }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $medico->token_aprovacao }}">
                            <div class="form-group">
                                <label for="aprovacao">Aprovar ou Desaprovar:</label>
                                <select class="form-control" id="aprovacao" name="aprovacao">
                                    <option value="aprovar">Aprovar</option>
                                    <option value="desaprovar">Desaprovar</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
