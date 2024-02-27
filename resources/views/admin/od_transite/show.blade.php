@extends('admin.layouts.admin')
@section('section')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Ordre de Transite</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:history.back();"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <form action="{{ route('admin.od_transite_doc.receive') }}" method="post" class="submitForm d-none">
                    @csrf
                    <input type="hidden" value="{{ $odretransite->uuid }}" name="transite_uuid">
                    <input type="hidden" value="On" name="receive_doc">
                    <button type="submit" class="btn btn-outline-primary">Confirmer reception des documents</button>
                </form>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="container">
            <div class="main-body mt-4">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-title d-flex align-items-center justify-content-between px-2 py-auto pe-0">
                                <div class="col-12">
                                    <h5 class="d-flex align-items-center text-uppercase px-2 my-2">Informations sur l'ordre de transite</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="row mb-3 mt-3">
                                    <div class="col-md-4">
                                        <h6 class="mb-0">N* de l'odre de transite</h6>
                                    </div>
                                    <div class="col-md-8 text-secondary">
                                        <div class="text-muted">{{ ($odretransite->code) ? $odretransite->code : '--' }}</div>
                                    </div>
                                </div>
                                <hr class="my-2">
                                <p class="text-decoration-underline">Transitaire selectionné</p>
                                <div class="row my-3">
                                    <div class="col-md-4">
                                        <h6 class="mb-0 text-muted">{{ $odretransite->transitaire->raison_sociale ?? '--' }}</h6>
                                    </div>
                                    <div class="col-md-6 text-secondary">
                                        <div class="text-muted">{{ $odretransite->transitaire->email ?? '--' }}</div>
                                    </div>
                                    <div class="col-md-2">
                                        @if ($odretransite->transitaire !== null)
                                        <a href="{{ route('admin.company.show', $odretransite->transitaire->uuid) }}" class="btn btn-primary">Plus d'info</a>
                                        @endif
                                    </div>
                                </div>
                                <hr class="my-2">
                                <div class="row col-12">
                                    <div class="col-md-4">
                                        <h6 class="mb-0">Note</h6>
                                    </div>
                                    <div class="col-md-8 text-secondary">
                                        <textarea class="form-control disabled text-start" disabled cols="30" rows="3">
                                            {{ $odretransite->note ?? '--' }}
                                        </textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="d-flex align-items-center mb-3 text-uppercase">Documents</h5>
                                <hr class="my-2">
                                <div class="ms-auto">
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#CreateTransiteFile">
                                        <i class="bx bxs-plus-square"></i> Ajouter
                                    </button>
                                    @include('admin.od_transite.files.addModal')
                                </div>
                                <hr class="my-2">
                                <div class="content mx-0 px-0">
                                    @if(count($transite_files) > 0)
                                    <ul class="list-group px-0 mx-0">
                                        @foreach ($odretransite->files as $transiteFile)
                                            @if($transiteFile->etat == 'actif')
                                                <li class="list-group-item d-flex align-items-center align-self-center row col-12 px-0 mx-0 my-2 w-100 mb-2" style="font-size: 12px;">
                                                    <div class="row col-12 w-100" style="font-size: 12px;">
                                                        <div class="col-8 overflow-x-scroll text-start align-self-center">
                                                            <span class="text-uppercase">{{ $transiteFile->name }}</span>
                                                        </div>
                                                        <div class="col-3 d-flex row">
                                                            <button class="col-6 text-primary btn bg-transparent" data-bs-toggle="modal" data-bs-target="#pdfViewModal{{$transiteFile->id}}" title="Voir">
                                                                <i class="lni lni-eye"></i>
                                                            </button>
                                                            @include('admin.od_transite.files.viewDoc')

                                                            <a class="deleteConfirmation col-6 bg-transparent text-decoration-none" data-uuid="{{ $transiteFile->uuid }}"
                                                                data-type="confirmation_redirect" data-placement="top"
                                                                data-token="{{ csrf_token() }}"
                                                                data-url="{{ route('admin.od_transite.delette_doc',$transiteFile->uuid) }}"
                                                                data-title="Vous êtes sur le point de supprimer"
                                                                data-id="{{ $transiteFile->uuid }}" data-param="0"
                                                                data-route="{{ route('admin.od_transite.delette_doc',$transiteFile->uuid) }}">
                                                                <button class="border-0 col-6 text-primary btn bg-transparent" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top" title="Supprimer">
                                                                    <i class='bx bxs-trash bg-transparent'></i>
                                                                </button>
                                                            </a>

                                                        </div>
                                                    </div>
                                                </li>
                                            @endif

                                        @endforeach
                                    </ul>
                                    @else
                                    <p>Aucun document associé à ce odre de transite.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        {{-- Modal de creation de documents  --}}
    </div>

@endsection
