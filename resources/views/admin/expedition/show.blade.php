@extends('admin.layouts.admin')
@section('section')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Expedition</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    @if ($expedition->statut == 'draft')
                    <form action="{{ route('admin.expedition.ToStarted', ['uuid' => $expedition->uuid]) }}" method="POST" class="submitForm">
                        @csrf
                        <button type="submit" class="text-white rounded btn btn-primary">Soumettre</button>
                    </form>
                    @endif
                    @if ($expedition->statut == 'started')
                    <form action="{{ route('admin.expedition.validate', ['uuid' => $expedition->uuid]) }}" method="POST" class="submitForm">
                        @csrf
                        <button type="submit" class="text-white rounded btn btn-primary">Demarrage Document</button>
                    </form>
                    @endif
                    @if ($expedition->statut == 'startedDoc')
                        <button class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addOrdreTransite{{ $expedition->uuid }}">Ordre de transit</button>
                    @endif

                    @if ($expedition->statut == 'odTransit')
                        <button class="btn btn-outline-primary text-primary-light" data-bs-toggle="modal" data-bs-target="#addOrdreTransport{{ $expedition->uuid }}">Ordre de transport</button>
                    @endif

                    @can(['Gerer le Stock', 'Faire Des Sorties De Stock'])
                        @if (in_array($expedition->statut, ['odTransit', 'outStock', 'odTransport']))
                        <button type="button" class="btn btn-sm btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#destockageModal">Destockage</button>
                        @endif
                    @endcan

                    @if ($expedition->statut == 'outStock')
                        <form action="{{ route('admin.expedition.wait_expedite', ['uuid' => $expedition->uuid]) }}" method="POST" class="submitForm">
                            @csrf
                            <button class="btn btn-outline-primary text-primary-light">Lancé l'expedition</button>
                        </form>
                    @endif
                    @if ($expedition->statut == 'wait_exp')
                        <form action="{{ route('admin.expedition.ready', ['uuid' => $expedition->uuid]) }}" method="POST" class="submitForm">
                            @csrf
                            <button class="btn btn-outline-primary text-primary-light">Marqué comme livré</button>
                        </form>
                    @endif
                    @if ($expedition->statut == 'livered')
                        <form action="{{ route('admin.expedition.marckToFactured', ['uuid' => $expedition->uuid]) }}" method="POST" class="submitForm">
                            @csrf
                            <button class="btn btn-outline-primary text-primary-light">Marqué comme Facturé</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div id="stepper1" class="bs-stepper">
            <div class="card">
                <div class="card-header">
                    <div class="d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between overflow-x-scroll"
                        role="tablist">

                        <div class="step" data-target="#test-l-1">
                            <div class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
                                {{-- <div class="bs-stepper-circle">1</div> --}}
                                <div class="">
                                    <h5 class="mb-0 steper-title text-center {{ $expedition->statut === 'started' ? 'text-success text-uppercase' : ' ' }}">Demarrage</h5>
                                    <p class="mb-0 steper-sub-title">Initialisation Export</p>
                                </div>
                            </div>
                        </div>

                        <div class="bs-stepper-line {{ $expedition->statut === 'startedDoc' ? 'bg-success' : ' ' }}"></div>
                        <div class="step" data-target="#test-l-2">
                            <div class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">

                                <div class="">
                                    <h5 class="mb-0 steper-title text-center {{ $expedition->statut === 'startedDoc' ? 'text-success text-uppercase' : '' }}">Demarrage Document</h5>
                                    <p class="mb-0 steper-sub-title text-center">Validation documentaire</p>
                                </div>

                            </div>
                        </div>
                        <div class="bs-stepper-line {{ $expedition->statut === 'odTransit' ? 'bg-success' : '' }}"></div>
                        <div class="step" data-target="#test-l-3">
                            <div class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3">
                                {{-- <div class="bs-stepper-circle">3</div> --}}
                                <div class="">
                                    <h5 class="mb-0 steper-title text-center {{ $expedition->statut === 'odTransit' ? 'text-success text-uppercase' : '' }}">En transit</h5>
                                    <p class="mb-0 steper-sub-title text-center">Ordre de transit</p>
                                </div>
                            </div>
                        </div>
                        <div class="bs-stepper-line {{ $expedition->statut === 'odTransport' ? 'bg-success ' : '' }}"></div>
                        <div class="step" data-target="#test-l-4">
                            <div class="step-trigger" role="tab" id="stepper1trigger4" aria-controls="test-l-4">
                                {{-- <div class="bs-stepper-circle">4</div> --}}
                                <div class="">
                                    <h5 class="mb-0 steper-title text-center {{ $expedition->statut === 'odTransport' ? 'text-success text-uppercase' : '' }}">En Transport</h5>
                                    <p class="mb-0 steper-sub-title text-center">Ordre de transport</p>
                                </div>
                            </div>
                        </div>
                        <div class="bs-stepper-line {{ $expedition->statut === 'outStock' ? 'bg-success' : '' }}"></div>
                        <div class="step" data-target="#test-l-4">
                            <div class="step-trigger" role="tab" id="stepper1trigger4" aria-controls="test-l-4">
                                {{-- <div class="bs-stepper-circle">5</div> --}}
                                <div class="">
                                    <h5 class="mb-0 steper-title text-center {{ $expedition->statut === 'outStock' ? ' text-uppercase text-success' : '' }}">Destockage</h5>
                                    <p class="mb-0 steper-sub-title text-center">Sortir du stock</p>
                                </div>
                            </div>
                        </div>
                        <div class="bs-stepper-line {{ $expedition->statut === 'wait_exp' ? 'bg-success' : '' }}"></div>
                        <div class="step" data-target="#test-l-4">
                            <div class="step-trigger" role="tab" id="stepper1trigger4" aria-controls="test-l-4">
                                {{-- <div class="bs-stepper-circle">6</div> --}}
                                <div class="">
                                    <h5 class="mb-0 steper-title text-center {{ $expedition->statut === 'wait_exp' ? 'text-success text-uppercase' : '' }}">En expedition</h5>
                                    <p class="mb-0 steper-sub-title text-center">En cours d'expedition</p>
                                </div>
                            </div>
                        </div>
                        <div class="bs-stepper-line  {{ $expedition->statut === 'livered' ? 'bg-success' : '' }}"></div>
                        <div class="step" data-target="#test-l-4">
                            <div class="step-trigger" role="tab" id="stepper1trigger4" aria-controls="test-l-4">
                                {{-- <div class="bs-stepper-circle">7</div> --}}
                                <div class="">
                                    <h5 class="mb-0 steper-title text-center {{ $expedition->statut === 'livered' ? 'text-success text-uppercase' : '' }}">Livré</h5>
                                    <p class="mb-0 steper-sub-title text-center">Expedié/Livré</p>
                                </div>
                            </div>
                        </div>
                        <div class="bs-stepper-line  {{ $expedition->statut === 'facturer' ? 'bg-success' : '' }}"></div>
                        <div class="step" data-target="#test-l-4">
                            <div class="step-trigger" role="tab" id="stepper1trigger4" aria-controls="test-l-4">
                                {{-- <div class="bs-stepper-circle">7</div> --}}
                                <div class="">
                                    <h5 class="mb-0 steper-title text-center {{ $expedition->statut === 'facturer' ? 'text-success text-uppercase' : '' }}">Facturer</h5>
                                    <p class="mb-0 steper-sub-title text-center">Refacturation cloturé</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">

                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    @if (!empty($expedition->client))
                                    <img src="{{ asset('files/' . $expedition->client->logo) }}" class="rounded-circle') }}" alt="logo" class="rounded-circle p-1 bg-primary" width="110">
                                    @else
                                        <img src="https://www.adaptivewfs.com/wp-content/uploads/2020/07/logo-placeholder-image.png" alt="logo" class="rounded-circle p-1 bg-primary" width="110">
                                    @endif
                                    <div class="mt-3 gy-3">
                                        <h4>{{ $expedition->client->raison_sociale ?? 'N/A' }}</h4>
                                        <p class="text-secondary mt-2">{{ $expedition->client->type ?? 'N/A' }}</p>
                                        <p class="text-muted font-size-sm my-2">{{ $expedition->client->email ?? 'N/A' }}</p>
                                        @if (!empty($expedition->client))
                                            <button class="btn btn-primary text-light">
                                                <a href="{{ route('admin.company.show', $expedition->client->uuid) }}" class="text-white rounded">Detail du client</a>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <hr class="my-4" />

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header my-0 py-0 d-flex justify-content-between align-items-center row">
                                <div class="text-uppercase  col-10 size_16">Documents d'expedition</div>
                                <div class="bg-transparent text-center border-0 col-2 p-1 rounded">
                                    <button type="button" class="btn btn-success text-success border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#addExpFile{{ $expedition->id }}">
                                        <i class="bx bxs-file-plus fs-3"></i>
                                    </button>
                                    @include('admin.expedition.file.addModal')
                                </div>
                            </div>
                            <div class="card-body">
								<div class="table-responsive mt-3">
									<table class="table table-striped table-hover table-sm mb-0">
										<thead>
											<tr>
												<th><i class='bx bx-up-arrow-alt ms-2'></i> Libellé
												</th>
												<th></th>

											</tr>
										</thead>
										<tbody>

                                            @forelse ($expedition->files->where('etat', 'actif') as $ExpFile)
                                            <tr>
												<td>
													<div class="d-flex align-items-center row">
														<div class="col-auto">
                                                            @if ($ExpFile->statut === 'validate')
                                                                <i class='bx bxs-file-pdf text-success me-2 font-24' ></i>
                                                            @elseif ($ExpFile->statut === 'refused')
                                                                <i class='bx bxs-file-pdf text-danger me-2 font-24' ></i>
                                                            @else ()
                                                                <i class='bx bxs-file-pdf text-info me-2 font-24' ></i>
                                                            @endif
														</div>
														<div class="font-weight-bold text-primary col-7">
                                                            {{ $ExpFile->name ?? 'N/A' }}
                                                            <p class="size_12 text-muted">{{ $ExpFile->created_at->diffForHumans() ?? 'N/A' }}</p>
                                                        </div>

													</div>
												</td>
												<td class="text-center col-3 my-auto">
                                                    <a class="col-6 size_12 text-secondary btn bg-transparent" data-bs-toggle="modal" data-bs-target="#docModal{{$ExpFile->id}}" title="Lecture">
                                                        <i class="lni lni-eye"></i>
                                                    </a>

                                                    <a class="deleteConfirmation size_14 col-6 my-auto bg-transparent" data-uuid="{{ $ExpFile->uuid }}"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        data-type="confirmation_redirect" data-placement="top"
                                                        data-token="{{ csrf_token() }}"
                                                        data-url="{{ route('admin.expedition.fil.destroy', $ExpFile->uuid) }}"
                                                        data-title="Vous êtes sur le point de supprimer"
                                                        data-id="{{ $ExpFile->uuid }}" data-param="0"
                                                        data-route="{{ route('admin.expedition.fil.destroy', $ExpFile->uuid) }}"><i class='bx size_14 cursor-pointer bxs-trash text-secondary bg-transparent'></i>
                                                    </a>
												</td>
                                                @include('admin.expedition.file.viewDoc')
											</tr>

                                            @empty
                                            <tr>Aucun document associé à ce ordre d'expedition.</tr>
                                            @endforelse

										</tbody>
									</table>
								</div>
                            </div>
                        </div>

                        <div class="card">
                            @if ($transit != null)
                            <div class="row col-12 p-3">
                                <div class="col-10 size_14 text-uppercase">Ordre de transit</div>
                                <div class="col-2 text-end"><span> <a href="{{ route('admin.transit.to_expedition.show', ['uuid' => $transit->uuid]) }}"><i class="bx bxs-right-arrow-circle size_16"></i></a> </span></div>
                            </div>
                            @endif
                            <hr class="my-2">
                            @if ($transport != null)
                            <div class="row col-12 p-3">
                                <div class="col-10 size_14 text-uppercase">Ordre de transport</div>
                                <div class="col-2 text-end"><span> <a href="{{ route('admin.expTransport.show', ['uuid' => $transport->uuid]) }}"><i class="bx bxs-right-arrow-circle size_16"></i></a> </span></div>
                            </div>

                            @endif
                        </div>
                    </div>
                    <div class="col-lg-8">

                        <div class="col-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <p class="bold">Numero d'expedition :</p>
                                                        <div class="text-muted text-start">
                                                            {{ $expedition->num_exp ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="bold me-2">Date de livraison :</p>
                                                        <div class="text-muted text-start">
                                                            {{ Carbon\Carbon::parse($expedition->date_liv)->format('d/m/y') ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <p class="bold me-2">Date d'initialisation :</p>
                                                        <div class="text-muted text-start">
                                                            {{ $expedition->created_at->diffForHumans() ?? 'N/A' }}
                                                        </div>

                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="bold me-2">Publié par :</p>
                                                        <div class="text-muted text-start">
                                                        {{ $expedition->created_by ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 my-3">
                                                <p class="bold">Incoterm</p>
                                                <div class="mt-3 p-4 bg-light">
                                                    <p>
                                                        {{ $expedition->incoterm ?? 'N/A' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mt-4">
                                        <div>
                                            <h5 class="mb-0">Marchandise a expedié</h5>
                                        </div>
                                        <div class="ms-auto">
                                            <div class=" col ms-auto float-end d-flex justify-content-end text-align-end align-items-center align-self-center">
                                                <a href="" data-bs-toggle="modal" data-bs-target="#productListModal{{ $expedition->uuid }}">
                                                    <img src="{{ asset('icone/choix.gif') }}" alt="Modifier" class="img-fluid" style="width: 40px; height: 30px">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive mt-3">
                                        <table class="table table-striped table-hover table-sm mb-0">
                                            <thead>
                                                <tr>
                                                    <th>N* Serie <i class='bx bx-up-arrow-alt ms-2'></th>
                                                    <th>Famille</th>
                                                    <th>Image</th>
                                                    <th>Conformité de sortie</th>
                                                    <th>Statut</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($expedition->products as $ExpProduct)
                                                    @if (!empty($ExpProduct->product))
                                                    <tr>
                                                        <td>{{ $ExpProduct->product->numero_serie ?? '--' }}</td>
                                                        <td>{{ $ExpProduct->product->familly->libelle ?? '--' }}</td>
                                                        @if (!empty($ExpProduct->product))
                                                        <td>
                                                            <img src="{{ asset('files/' . $ExpProduct->product->image) }}" alt="image du produit" style="max-width: 80px; max-height: 50px">
                                                        </td>
                                                        @else
                                                        <td><img src="" alt="img-not-found" height="50" width="50"></td>
                                                        @endif
                                                        <td>
                                                            @php
                                                                $productConformityout = App\Models\stockUpdate::where(['mouvement' => 'Out', 'product_id' => $ExpProduct->product->id])->first();
                                                                if ($productConformityout) {
                                                                    $result = $productConformityout->conformityOut;
                                                                }
                                                            @endphp

                                                            @if ($productConformityout !== null)
                                                                @if ($result === 'on')
                                                                <span class="badge badge-success text-white bg-success">
                                                                    Conforme
                                                                </span>
                                                                @endif
                                                                @if ($result === 'off')
                                                                    <span class="badge badge-danger p-2 bg-danger">
                                                                        Non conforme
                                                                    </span>
                                                                @endif

                                                            @else
                                                                {{-- @if ($result === 'null') --}}
                                                                <span class="badge badge-warning p-2 bg-warning">
                                                                    Pas encore destocké
                                                                </span>
                                                                {{-- @endif --}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($ExpProduct->product->status == 'stocked')
                                                                <span class="badge bg-primary py-2 rounded">En Stock</span>
                                                            @endif
                                                            @if ($ExpProduct->product->status == 'expEnCours')
                                                                <span class="badge bg-warning py-2 rounded">En cours d'expedition</span>
                                                            @endif
                                                            @if ($ExpProduct->product->status == 'delivered')
                                                                <span class="badge bg-info py-2 rounded">Livrer</span>
                                                            @endif

                                                        </td>
                                                        <td> <button class="btn btn-primary py-1"><a href="{{ route('admin.article.show', $ExpProduct->product->uuid) }}" class="text-white">Detail</a></button></td>
                                                    </tr>
                                                    @endif
                                                @empty
                                                    <tr>Aucune marchandise</tr>
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
        </div>
        @include('admin.expTransit.addModal')
        @include('admin.expTransport.addModal')
        @include('admin.expTransport.destockageModal')
        @include('admin.expedition.updateProduct')

    </div>


@endsection
