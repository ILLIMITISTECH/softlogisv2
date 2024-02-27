@extends('admin.layouts.admin')
@section('section')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3 text-uppercase">Odre de transit</div>
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
                <button type="button" class="btn btn-primary">Settings</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('files/' . $expTransit->transitaire->logo) }}" alt="Logo Transitaire" class="rounded-circle p-1 bg-primary" width="110">

                        <div class="mt-3">
                            <h4>{{ $expTransit->transitaire->raison_sociale ?? "N/A" }}</h4>
                            <p class="text-secondary mb-1 text-uppercase font-size-sm">{{ $expTransit->transitaire->type ?? "N/A" }}</p>
                            <p class="text-muted font-size-sm ">{{ $expTransit->transitaire->localisation ?? "N/A" }}</p>
                            <button class="btn btn-primary mt-lg-4 text-light">
                                <a class="text-light" href="{{ route('admin.company.show', $expTransit->transitaire->uuid) }}">Plus d'info</a>
                            </button>
                        </div>
                    </div>
                    <hr class="my-4" />
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><i class="lni lni-website"></i> Website</h6>
                            <span class="text-secondary">N/A</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><i class="lni lni-inbox"></i> Email</h6>
                            <span class="text-secondary">{{ $expTransit->transitaire->email ?? 'N/a' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><i class="lni lni-phone"></i> Phone</h6>
                            <span class="text-secondary">{{ $expTransit->transitaire->phone ?? 'N/a' }}</span>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-9">
            <div class="card">
                <div class="card-body">
                    <!--end row-->
                    <h5 class="text-decoration-underline">Information sur l'ordre de transit</h5>
                    <div class="my-3 d-flex justify-content-between">
                        <div class="text-start bold">Code#
                            <p class="text-muted">
                                {{ $expTransit->code }}
                            </p>
                        </div>
                        <div class="text-end bold">Creer par:
                            <p class="text-muted">{{ $expTransit->user_uuid }}</p>
                        </div>
                    </div>
                    <div class="note my-4">
                        <span>Note</span>
                        <p class="w-100 bg-light p-2">{{ $expTransit->note }}</p>
                    </div>
                    <!--end row-->
                    <div class="d-flex align-items-center mt-4">
                        <div>
                            <h5 class="mb-0 text-decoration-underline">Documents de Transit</h5>
                        </div>
                        <div class="ms-auto">
                            <button class="btn btn-sm btn-secondary text-secondary-ligth" data-bs-toggle="modal" data-bs-target="#addDocTransit" title="Lecture">
                                <i class='bx bxs-file-doc me-2 font-24 text-secondary-light'></i>Ajouter
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-hover table-sm mb-0">
                            <thead>
                                <tr>
                                    <th>Libelle <i class='bx bx-up-arrow-alt ms-2'></i>
                                    </th>
                                    <th>Ajouter par</th>
                                    <th>Date d'ajout</th>
                                    <th class="text-end"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($expTransit->files as $file)
                                    @if ($file->etat === 'actif')
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div><i class='bx bxs-file-pdf me-2 font-24 text-primary'></i>
                                                    </div>
                                                    <div class="font-weight-bold text-primary">{{ $file->name }}</div>
                                                </div>
                                            </td>
                                            <td>{{ $file->user_uuid }}</td>
                                            <td>{{ $file->created_at->diffForHumans() }}</td>
                                            <td class="text-end">
                                                <div class="content py-0 m-0">
                                                    <button class="btn col mx-0 px-0" data-bs-toggle="modal" data-bs-target="#docModal{{$file->uuid}}" title="Lecture">
                                                        <i class="lni lni-eye size_16"></i>
                                                    </button>

                                                    <a class="deleteConfirmation cursor-pointer text-secondary col my-0 mx-2 p-0 col my-auto size_16" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-uuid="{{ $file->uuid }}"
                                                        data-type="confirmation_redirect" data-placement="top"
                                                        data-token="{{ csrf_token() }}"
                                                        data-url="{{ route('admin.transit.delette_doc',$file->uuid) }}"
                                                        data-title="Vous êtes sur le point de supprimer {{ $file->name }} "
                                                        data-id="{{ $file->uuid }}" data-param="0"
                                                        data-route="{{ route('admin.transit.delette_doc',$file->uuid) }}">
                                                        <i class='bx bxs-trash my-auto'></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @include('admin.expTransit.files.viewDocModal')
                                @empty
                                <tr>Aucun Document enregistré</tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.expTransit.files.addModal')
    <!--end row-->
</div>
@endsection
