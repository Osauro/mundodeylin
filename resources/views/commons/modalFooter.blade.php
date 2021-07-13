            </div>
            <div class="modal-footer">
                <button wire:click.prevent="resetUI()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @if ($selected_id < 1)
                    <button wire:click.prevent="store()" type="button" class="btn btn-default">Guardar</button>
                @else
                    <button wire:click.prevent="update()" type="button" class="btn btn-default">Actualizar</button>
                @endif
            </div>
        </div>
    </div>
</div>
