<div class="modal fade" id="modal-action-delete" tabindex="-1" role="dialog" aria-labelledby="modal-action-delete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal-action-delete">Borrar registro</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            ¿Está seguro de borrar este registro?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <form method="POST" id="form-delete" class="inline" action="">
                @method('DELETE')
                @csrf
                <input type="submit" class="btn btn-primary" value="Borrar">
            </form>
        </div>
        </div>
    </div>
</div>
