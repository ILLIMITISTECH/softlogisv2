<div class="modal fade" id="CreateOdrelivraison" tabindex="-1" aria-hidden="true" style="min-width: 750px">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase size_16">Creer l'ordre de livraison</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body size_13" id="stronger">
                <form action="{{ route('admin.od_livraisons.store', $sourcing->uuid) }}" method="POST" enctype="multipart/form-data" class="submitForm row">
                    @csrf
                    <div class="row col-12">

                        <div class="col-12">
                            <label for="transporteur_uuid" class="form-label border-0 text-uppercase">Transporteur</label>
                            <select name="transporteur_uuid" class="form-control" id="transporteur_uuid">
                                <option value="" disabled selected>Selectionnez un transporteur</option>
                                @foreach ($transporteurs as $transporteur)
                                    <option value="{{ $transporteur->uuid }}">{{ $transporteur->raison_sociale }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row col-12 my-3 d-flex justify-content-between">
                            <div class="col">
                                <label for="date_livraison" class="form-label border-0 text-uppercase">Date de livraison</label>
                                <input type="date" name="date_livraison" class="form-control" autocomplete="off">
                            </div>
                            <div class="col">
                                <label for="lieu_livraison" class="form-label border-0 text-uppercase">Lieu de livraison <span class="text-danger">*</span></label>
                                <input type="text" name="lieu_livraison" class="form-control" autocomplete="off" required>
                                @error('lieu_livraison')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 my-4">
                            {{-- <label for="note" class="form-label text-uppercase">Note</label> --}}
                            <textarea name="note" id="note" cols="30" rows="3" placeholder="Ajouter une note a l'ordre de livraison" class="form-control"></textarea>
                        </div>

                        <div class="col-12 mb-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <button id="add_doc" type="button" class="btn btn-outline-primary py-1 my-auto mb-3" onclick="addNewDocLivraison()"><i class="bx bxs-plus-square"></i>Ajouter un document</button>
                            </div>
                            <div class="mb-2" id="doc_livraison_container">
                                <!-- Dom js pour l'ajout de nouveaux documents -->
                            </div>
                        </div>

                        <input type="hidden" name="sourcing_id" value="{{ $sourcing->uuid }}">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

