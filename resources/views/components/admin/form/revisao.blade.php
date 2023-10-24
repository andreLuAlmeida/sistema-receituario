<form class="row g-3" method="POST" action="{{ route('medico.aprovar', ['id' => $medico->id]) }}">
  @csrf
  @method('PUT')

    <!-- Verificar se há erros de validação e exibir mensagens de erro -->
    
    <div class="col-md-12">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
      @error('email')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
  </div>
  
  <div class="pt-4 border-top mt-5">
      <h5>Informações:</h5>
  </div>
  <div class="col-6">
      <label for="name" class="form-label">Nome completo</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
      @error('name')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
  </div>

  <div class="col-6">
    <label for="consultorio_clinica" class="form-label">Clínica, consultório ou local de atuação</label>
    <input type="text" class="form-control @error('consultorio_clinica') is-invalid @enderror" id="consultorio_clinica" name="consultorio_clinica" value="{{ old('consultorio_clinica', $medico->consultorio_clinica) }}">
    @error('consultorio_clinica')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
  
  <div class="col-md-4">
      <label for="cpf" class="form-label">CPF</label>
      <input type="text" class="form-control @error('cpf') is-invalid @enderror" id="cpf" placeholder="xxx.xxx.xxx-xx" name="cpf" value="{{ old('cpf', $medico->cpf) }}">
      @error('cpf')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
  </div>
  
  <div class="col-md-4">
      <label for="rg" class="form-label">RG</label>
      <input type="text" class="form-control @error('rg') is-invalid @enderror" id="rg" placeholder="xx.xxx.xxx-x" name="rg" value="{{ old('rg', $medico->rg) }}">
      @error('rg')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
  </div>
  
  <div class="col-md-4">
      <label for="data_nascimento" class="form-label">Data de Nascimento</label>
      <input type="date" class="form-control @error('data_nascimento') is-invalid @enderror" id="data_nascimento" name="data_nascimento" value="{{ old('data_nascimento', $medico->data_nascimento) }}">
      @error('data_nascimento')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
  </div>
  
  <div class="col-md-4">
      <label for="crm" class="form-label">CRM</label>
      <input type="text" class="form-control @error('crm') is-invalid @enderror" id="crm" placeholder="xxxxxxxx" name="crm" value="{{ old('crm', $medico->crm) }}">
      @error('crm')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
  </div>
  
  <div class="col-md-8">
      <label for="especialidade" class="form-label">Especialidade Médica</label>
      <input type="text" class="form-control @error('especialidade') is-invalid @enderror" id="especialidade" placeholder="Digite sua especialidade" name="especialidade" value="{{ old('especialidade', $medico->especialidade) }}">
      @error('especialidade')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
  </div>
  
  <div class="pt-4 border-top mt-5">
      <h5>Contato:</h5>
  </div>
  
  <div class="col-md-6">
      <label for="celular" class="form-label">Celular</label>
      <input type="text" class="form-control @error('celular') is-invalid @enderror" id="celular" placeholder="(xx) xxxxx-xxxx" name="celular" value="{{ old('celular', $medico->celular) }}">
      @error('celular')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
  </div>
  
  <div class="col-md-6">
      <label for="telefone" class="form-label">Telefone</label>
      <input type="text" class="form-control @error('telefone') is-invalid @enderror" id="telefone" placeholder="(xx) xxxx-xxxx" name="telefone" value="{{ old('telefone', $medico->telefone) }}">
      @error('telefone')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
  </div>
  
  <div class="pt-4 border-top mt-5">
      <h5>Endereço:</h5>
  </div>
  
  <div class="col-10">
      <label for="rua" class="form-label">Rua</label>
      <input type="text" class="form-control @error('rua') is-invalid @enderror" id="rua" placeholder="Ex: Rua Exemplo" name="rua" value="{{ old('rua', $medico->rua) }}">
      @error('rua')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
  </div>
  
  <div class="col-md-2">
      <label for="numero" class="form-label">Número</label>
      <input type="text" class="form-control @error('numero') is-invalid @enderror" id="numero" name="numero" value="{{ old('numero', $medico->numero) }}">
      @error('numero')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
  </div>
  
  <div class="col-12">
      <label for="bairro" class="form-label">Bairro</label>
      <input type="text" class="form-control @error('bairro') is-invalid @enderror" id="bairro" placeholder="Ex: Rua Bairro Exemplo" name="bairro" value="{{ old('bairro', $medico->bairro) }}">
      @error('bairro')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
  </div>
  
  <div class="col-md-6">
      <label for="cidade" class="form-label">Cidade</label>
      <input type="text" class="form-control @error('cidade') is-invalid @enderror" id="cidade" name="cidade" value="{{ old('cidade', $medico->cidade) }}">
      @error('cidade')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
  </div>
  
  <div class="col-md-4">
      <label for="estado" class="form-label">Estado</label>
      <select id="estado" class="form-select" name="estado" value="{{ $medico->estado }}">
        <option value="{{ $medico->estado }}" selected>{{ $medico->estado }}</option>
        <option value="AC">Acre</option>
        <option value="AL">Alagoas</option>
        <option value="AP">Amapá</option>
        <option value="AM">Amazonas</option>
        <option value="BA">Bahia</option>
        <option value="CE">Ceará</option>
        <option value="DF">Distrito Federal</option>
        <option value="ES">Espírito Santo</option>
        <option value="GO">Goiás</option>
        <option value="MA">Maranhão</option>
        <option value="MT">Mato Grosso</option>
        <option value="MS">Mato Grosso do Sul</option>
        <option value="MG">Minas Gerais</option>
        <option value="PA">Pará</option>
        <option value="PB">Paraíba</option>
        <option value="PR">Paraná</option>
        <option value="PE">Pernambuco</option>
        <option value="PI">Piauí</option>
        <option value="RJ">Rio de Janeiro</option>
        <option value="RN">Rio Grande do Norte</option>
        <option value="RS">Rio Grande do Sul</option>
        <option value="RO">Rondônia</option>
        <option value="RR">Roraima</option>
        <option value="SC">Santa Catarina</option>
        <option value="SP">São Paulo</option>
        <option value="SE">Sergipe</option>
        <option value="TO">Tocantins</option>
      </select>
      @error('estado')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
  </div>
  
  <div class="col-md-2">
      <label for="cep" class="form-label">Cep</label>
      <input type="text" class="form-control @error('cep') is-invalid @enderror" id="cep" name="cep" value="{{ old('cep', $medico->cep) }}">
      @error('cep')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
  </div>
  <div class="row mt-2">
      <div class="col-6">
        <button type="submit" class="btn btn-success w-100 mt-2">Aprovar</button>
      </div>
    </form>
      <div class="col-6">
        <form method="POST" action="{{ route('medico.negar', ['id' => $medico->id]) }}">
          @csrf
          <button type="submit" class="btn btn-danger w-100 mt-2">Negar</button>
         </form>
      </div>
  </div>
