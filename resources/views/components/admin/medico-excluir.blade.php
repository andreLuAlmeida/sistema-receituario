<div class="modal fade" id="confirmDelete{{ $medico->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel{{ $medico->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title text-white" id="confirmDeleteLabel{{ $medico->id }}">Confirmar deleção</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                @foreach ($medico->users as $user)
                <p>Tem certeza de que deseja deletar:</p>
                <h4 class="mb-4">{{ $user->name }}</h4>       
                <p><strong>Essa ação será permanente.</strong></p>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form method="POST" action="{{ route('medico.destroy', $medico->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Deletar</button>
                </form>
            </div>
        </div>
    </div>
</div>
