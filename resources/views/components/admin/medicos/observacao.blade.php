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
