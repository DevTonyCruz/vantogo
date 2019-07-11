<!-- Danger Alert Modal -->
<div id="modal-permiso" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-filled bg-danger">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-wrong h1"></i>
                    <h4 class="mt-2">Error!</h4>
                    <p class="mt-3">{{ session('status') }}</p>
                    <button type="button" class="btn btn-light my-2" data-dismiss="modal">Continuar</button>
                </div>
            </div>
        </div>
    </div>
</div>
