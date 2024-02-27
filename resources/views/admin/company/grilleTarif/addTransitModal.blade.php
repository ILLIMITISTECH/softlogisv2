<div class="modal fade" id="addTransitGrille" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter Une Grille Tarifaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

           <div class="modal-body">
                <form action="{{ route('admin.offre.storeTransit') }}" method="post" class="submitForm">
                    @csrf

                    <input type="hidden" name="transitaire_uuid" value="{{ $company->uuid }}">

                    <div class="mb-3 col-12">
                        <label for="had_uuid" class="form-label">HAD</label>
                        <select name="had_uuid" id="had_uuid" class="form-select">
                            @foreach ($hads as $item)
                                <option value="{{ $item->uuid }}" class="form-control">{{ $item->libelle ?? "" }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-12">
                        <label for="cout" class="form-label">Cout</label>
                        <input type="text" class="form-control" id="cout" name="cout">
                    </div>

                    <hr>

                    <div class="mb-3 col-12 text-end">
                        <button type="submit" class="btn btn-primary col-4">Ajouter</button>
                    </div>
                </form>
           </div>

        </div>
    </div>
</div>
