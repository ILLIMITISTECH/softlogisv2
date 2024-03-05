<div class="modal fade" id="CreateOdrelivraison" tabindex="-1" aria-hidden="true" style="min-width: 750px">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase size_16">Creer l'ordre de Transport</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body size_13" id="stronger">
                <form action="{{ route('admin.od_livraisons.store', $sourcing->uuid) }}" method="POST" enctype="multipart/form-data" class="submitForm row">
                    @csrf
                    <div class="row col-12">

                        <div class="col-12">
                            <label for="transporteur_uuid" class="form-label border-0 text-uppercase">Transporteur</label>
                            <select name="transporteur_uuid" class="form-control" id="transporteur_uuid">
                                <option class="text-muted" value="" disabled selected>Selectionnez un transporteur</option>
                                @foreach ($transporteurs as $transporteur)
                                    <option value="{{ $transporteur->uuid }}">{{ $transporteur->raison_sociale ?? '--'}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row col-12 my-3 d-flex justify-content-between">
                            <div class="col form-group">
                                <label for="trajetStart_uuid" class="form-label border-0 text-uppercase">Point de Depart</label>
                                <select name="trajetStart_uuid" class="form-select" id="">
                                    <option class="text-muted" value="" disabled selected>Selectionnez un point de depart</option>
                                    @foreach ($destinations as $item)
                                        <option class="form-control" value="{{ $item->uuid }}">{{ $item->libelle ?? '--' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col form-group">
                                <label for="trajetEnd_uuid" class="form-label border-0 text-uppercase">Point d'arriver </label>
                                <select name="trajetEnd_uuid" class="form-select" id="">
                                    <option value="" disabled selected>Selectionnez un point d'arriver</option>
                                    @foreach ($destinations as $item)
                                        <option class="form-control" value="{{ $item->uuid }}">{{ $item->libelle ?? '--' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row col-12 my-3 d-flex justify-content-between">
                            <div class="col form-group">
                                <label for="numOt" class="form-label border-0 text-uppercase">N°OT</label>
                                <input type="text" name="numOt" class="form-control" autocomplete="off">
                            </div>
                            <div class="col">
                                <label for="numFolder" class="form-label border-0 text-uppercase">N°Dossier</label>
                                <input type="text" name="numFolder" class="form-control" autocomplete="off">
                            </div>
                            <div class="col form-group">
                                <label for="numBl" class="form-label border-0 text-uppercase">N°BL</label>
                                <input type="text" value="{{ $sourcing->num_bl }}" name="numBl" class="form-control" autocomplete="off" placeholder="{{ $sourcing->num_bl }}">
                            </div>
                        </div>
                        <div class="row col-12 my-3 d-flex justify-content-between">
                            
                            <div class="col">
                                <label for="refCotation" class="form-label border-0 text-uppercase">Ref Cotation</label>
                                <input type="text" name="refCotation" class="form-control" autocomplete="off">
                            </div>
                            <div class="col">
                                <label for="date_livraison" class="form-label border-0 text-uppercase">Date de livraison</label>
                                <input type="date" name="date_livraison" class="form-control" autocomplete="off">
                            </div>
                        </div>

                        <div>
                            <div class="my-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <button id="add_doc" type="button"
                                        class=" add_new_box_product btn btn-outline-primary py-1 my-auto mb-3"><i
                                            class="bx bxs-plus-square"></i>Ajouter une marchandise</button>
                                </div>
                                <div class="add_new_product">
                                    <div class="row add_new_prod gx-1 px-0 mb-3" id="0">
                                        <div class="col-1">
                                            <input type="number" name="qty[]" class="form-control" placeholder="0">
                                        </div>
                                        <div class="col-3">
                                            <input type="text" name="product_ids[]" class="form-control" placeholder="N°serie">
                                        </div>
                                        <div class="col-3">
                                            <input type="text" class="form-control" placeholder="CAT PELLE HYDRAULIQUE" disabled>
                                        </div>
                                        <div class="col-1">
                                            <input type="text" class="form-control" placeholder="1500 m" disabled>
                                        </div>
                                        <div class="col-1">
                                            <input type="text" class="form-control" placeholder="1500 m" disabled>
                                        </div>
                                        <div class="col-1">
                                            <input type="text" class="form-control" placeholder="1500 m" disabled>
                                        </div>
                                        <div class="col-1">
                                            <input type="text" class="form-control" placeholder="1500 m" disabled>
                                        </div>
                                        <div class="col-1 ">
                                            <button type="button"
                                                class="btn btn-outline-danger border border-1 border-danger  sup_new_box_doc" id=""><i
                                                    class="bx bx-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
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

