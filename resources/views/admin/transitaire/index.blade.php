@extends('admin.layouts.admin')
@section('section')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Comptes</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.transitaire') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Transitaire</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">

                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">


                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Logo</th>
                                <th>code</th>
                                <th>Identification</th>
                                <th>Raison sociale</th>
                                <th>email</th>
                                <th>Télephone</th>
                                <th>Etat</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transitaires as $transitaire)
                                <tr>
                                    <td>
                                        <img src='{{ asset('files/' . $transitaire->logo) }}' class="product-img-2"
                                            alt="logo company">
                                    </td>
                                    <td>{{ $transitaire->code }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">

                                            <div class="ms-2">
                                                <h6 class="mb-0 font-14">{{ $transitaire->identification }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $transitaire->raison_sociale }}</td>
                                    <td>{{ $transitaire->email }}</td>
                                    <td>{{ $transitaire->phone }}</td>
                                    <td>
                                        <span
                                            class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i
                                                class='bx bxs-circle me-1'></i>{{ $transitaire->etat }}</span>
                                    </td>

                                    <td>
                                        <div class="d-flex order-actions">

                                            <a href="{{ route('admin.company.show', $transitaire->uuid) }}" style="cursor: pointer" class="me-2"><i class="lni lni-eye"></i></a>

                                            <a data-bs-toggle="modal" data-bs-target="#editcompany{{ $transitaire->uuid }}"
                                                style="cursor: pointer"><i class='bx bxs-edit'></i></a>

                                            <a class="ms-3 deleteConfirmation" data-uuid="{{ $transitaire->uuid }}"
                                                data-type="confirmation_redirect" data-placement="top"
                                                data-token="{{ csrf_token() }}"
                                                data-url="{{ route('admin.transitaire.destroy') }}"
                                                data-title="Vous êtes sur le point de supprimer {{ $transitaire->raison_sociale }} "
                                                data-id="{{ $transitaire->uuid }}" data-param="0"
                                                data-route="{{ route('admin.transitaire.destroy') }}"><i class='bx bxs-trash'
                                                    style="cursor: pointer"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                {{-- Modal edit  --}}

                                <div class="modal fade" id="editcompany{{ $transitaire->uuid }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Modifier transitaire</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form method="post"
                                                action="{{ route('admin.transitaire.update', $transitaire->uuid) }}"
                                                class="submitForm" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">


                                                    <div class="form-group">
                                                        <label for="logo" class="col-form-label">logo:</label>
                                                        <input type="file" class="form-control" value="{{ $transitaire->logo }}" id="logo"
                                                            name="logo">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="identification"
                                                            class="col-form-label">Identification:</label>
                                                        <input type="text" class="form-control" id="identification"
                                                            name="identification" value="{{ $transitaire->identification }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="raison_sociale" class="col-form-label">Raison
                                                            Sociale:</label>
                                                        <input type="text" class="form-control" id="raison_sociale"
                                                            name="raison_sociale" value="{{ $transitaire->raison_sociale }}">
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col">
                                                            <label for="email" class="col-form-label">Email
                                                                Entreprise:</label>
                                                            <input type="email" class="form-control" id="email"
                                                                placeholder="exemple@example.com" name="email"
                                                                value="{{ $transitaire->email }}">
                                                        </div>
                                                        <div class="form-group col">
                                                            <label for="phone" class="col-form-label">Télephone
                                                                Entreprise:</label>
                                                            <input type="phone" class="form-control" id="phone"
                                                                placeholder="+123456789" name="phone"
                                                                value="{{ $transitaire->phone }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="localisation"
                                                            class="col-form-label">Localisation:</label>
                                                        <input type="text" class="form-control" id="localisation"
                                                            name="localisation" value="{{ $transitaire->localisation }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="description"
                                                            class="col-form-label">Description:</label>
                                                        <textarea name="description" id="description" cols="30" rows="3" class="form-control"
                                                            value="{{ $transitaire->description }}">{{ $transitaire->description }}</textarea>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Fermer</button>
                                                        <button type="submit" class="btn btn-primary">Modifier</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Aucun transitaire enregistré</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

    {{-- Modal --> --}}

    {{-- <div class="col"> --}}
    <!-- Button trigger modal -->

    <!-- Modal add Company-->
    <div class="modal fade" id="addcompany" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter transitaire</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('admin.transitaire.store') }}" class="submitForm"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" style="overflow-y: scroll; max-height: 500px">

                        <div class="form-group">
                            <label for="logo" class="col-form-label">logo:</label>
                            <input type="file" class="form-control" id="logo" name="logo" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="identification" class="col-form-label">Identification:</label>
                            <input type="text" class="form-control" id="identification" name="identification" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="raison_sociale" class="col-form-label">Raison Sociale:</label>
                            <input type="text" class="form-control" id="raison_sociale" name="raison_sociale" autocomplete="off">
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="email" class="col-form-label">Email Entreprise:</label>
                                <input type="email" class="form-control" id="email"
                                    placeholder="exemple@example.com" name="email" autocomplete="off">
                            </div>
                            <div class="form-group col">
                                <label for="phone" class="col-form-label">Télephone Entreprise:</label>
                                <input type="phone" class="form-control" id="phone" placeholder="+123456789"
                                    name="phone" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="localisation" class="col-form-label">Localisation:</label>
                            <input type="text" class="form-control" id="localisation" name="localisation" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-form-label">Description:</label>
                            <textarea name="description" id="description" cols="30" rows="3" class="form-control" autocomplete="off"></textarea>
                        </div>
                        <hr>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- </div> --}}
@endsection
