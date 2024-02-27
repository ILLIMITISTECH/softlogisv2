<div class="modal fade" id="addOrdreTransite{{ $expedition->uuid }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase size_16">Creation de l'ordre de transite</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body size_13" id="stronger">
                <form action="{{ route('admin.transit.to_expedition.store') }}" method="POST" enctype="multipart/form-data" class="submitForm row">
                    @csrf

                    <div class="row col-12">
                        <input type="hidden" name="expedition_uuid" value="{{ $expedition->uuid }}">
                        <div class="col-12">
                            <label for="transitaire_uuid" class="form-label text-uppercase">Transitaire Export</label>
                            <select name="transitaire_uuid" class="form-control" id="transitaire_uuid">
                                <option value="" disabled selected>Selectionnez un transitaire</option>
                                @foreach ($transitaires as $transitaire)
                                    <option value="{{ $transitaire->uuid }}">{{ $transitaire->raison_sociale }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 mt-4">

                            <textarea name="note" id="note" cols="30" rows="3" placeholder="Ajouter une note a l'ordre de transite" class="form-control"></textarea>
                        </div>
                        <hr class="my-2">
                        <div class="col-12">
                            <div class="my-3">
                                <strong class="text-uppercase text-primary my-auto">Documents de transite (PDF, Word, Excel)</strong>
                                <div class=" card-headerd-flex align-items-center justify-content-between">
                                    <button id="add_doc_exp" type="button" class="btn btn-outline-primary py-1 my-auto mb-3" onclick="addExpDoctransite()"><i class="bx bxs-plus-square"></i>Ajouter un document</button>
                                </div>
                                <div class="mb-2 card-body" id="doc_transite_export">
                                    <!-- Dom js pour l'ajout de nouveaux documents de transite-->
                                </div>
                            </div>
                        </div>
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
