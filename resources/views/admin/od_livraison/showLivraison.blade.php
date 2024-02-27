@extends('admin.layouts.admin')
@section('section')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 row">
            <div class="breadcrumb-title pe-3 text-uppercase size_14 col-2">Ordre de Livraison</div>
            <div class="ps-3 col-7">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:history.back();"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active size_14" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
            {{-- <div class="text-end d-flex  justify-content-end col-3">
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addReception">
                    <i class="bx bxs-plus-square"></i>Reception
                </button>
            </div>
            @include('admin.stock.reception') --}}

        </div>
        <!--end breadcrumb-->

        <div class="container">
            <div class="main-body mt-4">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-title d-flex align-items-center justify-content-between px-2 py-auto pe-0">
                                <div class="col-12">
                                    <h5 class="d-flex align-items-center text-uppercase px-2 my-2 size_16">Informations sur l'ordre de livraison</h5>
                                </div>
                            </div>
                            <hr class="mb-2">
                            <div class="card-body size_14">
                                <div class="row mb-3 mt-3">
                                    <div class="col-md-4">
                                        <h6 class="mb-0">N*:</h6>
                                    </div>
                                    <div class="col-md-8 text-secondary">
                                        <div class="text-muted">{{ ($oDLivraison->code) ? $oDLivraison->code : '--' }}</div>
                                    </div>
                                </div>

                                <p class="mb-0">Transporteur selectionné</p>
                                <div class="row my-2">
                                    <div class="col-md-4">
                                        <h6 class="mb-0 text-muted">{{ $oDLivraison->transporteur->raison_sociale ?? '--' }}</h6>
                                    </div>
                                    <div class="col-md-6 text-secondary">
                                        <div class="text-muted">{{ ($oDLivraison->transporteur->email ?? '') ? $oDLivraison->transporteur->email : '--' }}</div>
                                    </div>
                                    <div class="col-md-2">
                                        @if ($oDLivraison->transporteur !== null)
                                        <a href="{{ route('admin.company.show', $oDLivraison->transporteur->uuid) }}" class="btn btn-primary">Plus d'info</a>
                                        @endif
                                    </div>
                                </div>
                                <hr class="my-2">
                                <div class="row col-12">
                                    <div class="col-md-4">
                                        <h6 class="mb-0 size_14">Note</h6>
                                    </div>
                                    <div class="col-md-8 text-secondary">
                                        <p class="form-control disabled text-start" style="min-height: 60px">
                                            {{ $oDLivraison->note ?? '--' }}
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="content">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="d-flex align-items-center text-uppercase size_16">Marchandises Attendues</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead class="table-light">
                                                    <tr class="text-uppercase size_14">
                                                        <th>N* Serie</th>
                                                        <th>Famille du produit</th>
                                                        <th>Statut</th>
                                                        <th>Conformité</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody style="font-size: 12px !important">
                                                    @if ($oDLivraison->sourcing)
                                                        @forelse ($oDLivraison->sourcing->products as $product)
                                                            <tr>
                                                                <td>
                                                                    <h6 class="mb-0 font-14">#{{ $product->product->numero_serie }}</h6>
                                                                </td>
                                                                <td>{{ $product->product->familly->libelle }}</td>
                                                                <td>
                                                                    @if ($product->product->status == 'enFabrication')
                                                                        <span class="badge bg-info text-light text-uppercase p-2">En Fabrication</span>
                                                                    @endif
                                                                    @if ($product->product->status == 'sortiUsine')
                                                                        <span class="badge bg-warning text-uppercase text-light p-2">Sortie d'usine</span>
                                                                    @endif
                                                                    @if ($product->product->status == 'enExpedition')
                                                                    <span class="badge badge-info p-2 bg-info">
                                                                        En cours d'expedition import
                                                                    </span>
                                                                    @endif
                                                                    @if ($product->product->status == 'arriverAuPod')
                                                                    <span class="badge badge-success p-2 bg-success">
                                                                        Arrivé au POD
                                                                    </span>
                                                                    @endif
                                                                    @if ($product->product->status == 'stocked')
                                                                    <span class="badge bg-warning py-2 rounded">Reçu/Stocké</span>
                                                                    @endif
                                                                    @if ($product->product->status == 'expEnCours')
                                                                    <span class="badge bg-primary py-2 rounded">En cours d'expedition Export</span>
                                                                    @endif
                                                                    @if ($product->product->status == 'delivered')
                                                                        <span class="badge bg-success py-2 rounded">Livrer</span>
                                                                    @endif

                                                                </td>
                                                                <td>
                                                                    @php
                                                                        $productConformity = App\Models\stockUpdate::where('product_id', $product->product->id)->first();
                                                                        if ($productConformity) {
                                                                            $result = $productConformity->conformity;
                                                                        }
                                                                    @endphp

                                                                    @if ($productConformity)
                                                                        @if ($result === '')
                                                                        <span class="badge badge-warning p-2 bg-warning">
                                                                            Pas encore receptionné
                                                                        </span>
                                                                        @endif

                                                                        @if ($result === 'off')
                                                                            <span class="badge badge-danger p-2 bg-danger">
                                                                                Non conforme
                                                                            </span>
                                                                        @elseif ($result === 'on')
                                                                            <span class="badge badge-success p-2 bg-success">
                                                                                Conforme
                                                                            </span>
                                                                        @endif

                                                                    @endif
                                                                </td>


                                                                <td class="d-flex justify-content-end text-end">
                                                                    <button type="button" class="btn btn-info btn-sm radius-30 px-3 size_12">
                                                                        <a href="{{ route('admin.article.show', ['uuid' => $product->product->uuid]) }}" class="text-uppercase text-decoration-none text-light py-1">Detail</a>
                                                                    </button>
                                                                </td>

                                                            </tr>
                                                        @empty
                                                            <tr>Aucun produit pour ce sourcing</tr>
                                                        @endforelse
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header my-0 py-0 d-flex justify-content-between align-items-center row">
                                <div class="text-uppercase  col-10 size_16">Documents</div>
                                <div class="bg-transparent text-center border-0 col-2 p-1 rounded">
                                    <button type="button" class="btn btn-success text-success border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#CreateLivraisonFile">
                                        <i class="bx bxs-file-plus fs-3"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
								<div class="table-responsive mt-3">
									<table class="table table-striped table-hover table-sm mb-0">
										<thead>
											<tr>
												<th class="w-75"><i class='bx bx-up-arrow-alt ms-2'></i> Libellé
												</th>
												<th class="w-25">Action</th>

											</tr>
										</thead>
										<tbody>
                                            @forelse ($oDLivraison->files as $livraisonFile)
                                            <tr class="w-100">
												<td class="w-75">
													<div class="d-flex align-items-center row">
														<div class="col-2">
                                                            <i class='bx bxs-file-pdf text-info me-2 font-24' ></i>
														</div>
														<div class="font-weight-bold text-primary col-10">
                                                            {{ $livraisonFile->name }}
                                                            <p class="size_12 text-muted">{{ $livraisonFile->created_at->diffForHumans() }}</p>
                                                        </div>

													</div>
												</td>

                                                <td class="w-25">
                                                    <div class="d-flex row">
                                                        <button class="col-6 btn bg-transparent" data-bs-toggle="modal" data-bs-target="#pdfViewModal{{$livraisonFile->id}}" title="Voir">
                                                            <i class="lni lni-eye"></i>
                                                        </button>
                                                        @include('admin.od_livraison.files.viewDoc')

                                                        <a class="deleteConfirmation col-6 bg-transparent text-decoration-none" data-uuid="{{ $livraisonFile->uuid }}"
                                                            data-type="confirmation_redirect" data-placement="top"
                                                            data-token="{{ csrf_token() }}"
                                                            data-url="{{ route('admin.od_livraison_doc.destroy', $livraisonFile->uuid) }}"
                                                            data-title="Vous êtes sur le point de supprimer {{ $livraisonFile->code }} "
                                                            data-id="{{ $livraisonFile->uuid }}" data-param="0"
                                                            data-route="{{ route('admin.od_livraison_doc.destroy', $livraisonFile->uuid) }}">
                                                            <button class="border-0 btn bg-transparent" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Supprimer">
                                                                <i class='bx bxs-trash bg-transparent'></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </td>

											</tr>

                                            @empty
                                            <tr>Aucun document associé à ce sourcing.</tr>
                                            @endforelse

										</tbody>
									</table>
								</div>



                            </div>


                        </div>

                    </div>
                </div>


            </div>
        </div>
        {{-- Modal de creation de documents  --}}

        @include('admin.od_livraison.files.addModal')
    </div>

@endsection
