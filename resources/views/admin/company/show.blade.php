@extends('admin.layouts.admin')
@section('section')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Compagnie</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Plus d'info</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

            @if($company->isActive === 'true')
            <form action="{{ route('admin.company.block', $company->id) }}" method="post" class="submitForm">
                @csrf

                <input type="hidden" name="company_uuid" value="{{ $company->uuid }}">
                <button type="submit" class="btn btn-primary">BLOQUER</button>
            </form>
            @elseif ($company->isActive === 'false')
            <form action="{{ route('admin.company.active', $company->uuid) }}" method="post" class="submitForm">
                @csrf

                <input type="hidden" name="company_uuid" value="{{ $company->uuid }}">
                <button type="submit" class="btn btn-primary text-uppercase">Debloquer</button>
            </form>
            @endif

        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            {{-- <div class="d-flex flex-column align-items-center text-center gy-2">
                                <img src="{{ asset('files/' . $company->logo) }}" class="rounded-circle') }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                                <div class="mt-3">
                                    <h4 class="text-uppercase">{{ $company->raison_sociale }}</h4>
                                    <p class="text-secondary mb-2 text-capitalize">{{ $company->type }}</p>
                                </div>

                            </div> --}}

                            <div class="d-flex flex-column align-items-center text-center gy-2 position-relative">
                                @if ($company->isActive == 'false')
                                  <div class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger text-uppercase" style="transform: skew(-20deg);">Inactive</div>
                                @else
                                  <div class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-success text-uppercase" style="transform: skew(-20deg);">Active</div>
                                @endif
                                <img src="{{ asset('files/' . $company->logo) }}" class="rounded-circle" alt="Admin" width="110">
                                <div class="mt-3">
                                  <h4 class="text-uppercase">{{ $company->raison_sociale }}</h4>
                                  <p class="text-secondary mb-2 text-capitalize">{{ $company->type }}</p>
                                </div>
                              </div>


                            <hr class="my-4" />
                            <ul class="list-group list-group-flush">
                                @if ($company->type === 'transporteur')
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Voie d'expedition :</h6>
                                    <span class="text-uppercase">{{ $company->voie_transport }}</span>
                                </li>
                                @endif
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Email :</h6>
                                    <span>{{ $company->email }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Télephone :</h6>
                                    <span class="text-secondary">{{ $company->phone }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Localisation :</h6>
                                    <span class="text-secondary">{{ $company->localisation }}</span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Regis de commerce</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control disabled" disabled placeholder="{{ $company->identification }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" disabled placeholder="{{ $company->email }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Télephone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" disabled placeholder="{{ $company->phone }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Localisation</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" disabled placeholder="{{ $company->localisation }}" />
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-title p-2">
                                    <h6>Contact</h6>
                                </div>
                                <hr class="my-1">
                                <div class="card-body">
                                    <div class="content">
                                        <input type="text" disabled placeholder="Contact 1" class="form-control">
                                        <p class="text-capitalize">{{ $company->contact_one_name. ' ' .$company->contact_one_lastName }}</p>
                                        <div class=" my-3">
                                            {{ $company->contact_one_email }}
                                        </div>

                                    </div>
                                    <hr class="my-2">
                                    <div class="contant">
                                        <input type="text" disabled placeholder="Contact 2" class="form-control">

                                        <p class="text-capitalize">{{ $company->contact_two_name. ' ' .$company->contact_two_lastName }}</p>
                                        <div class=" my-3">
                                            {{ $company->contact_two_email }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                @if ($company->type === 'transporteur')
                <div class="card-body">
                    <div class="row">
                        <div class="col-10">
                            <h5 class="card-title">GRILLE TARIFAIRE <span class="text-uppercase">{{   $company->raison_sociale }}</span></h5>
                        </div>
                        <div class="ms-auto col-2 text-end">
                            <button class="btn btn-primary p-1 text-center" data-bs-toggle="modal" data-bs-target="#addTransportGrille">
                                <i class="bx bxs-plus-square mx-auto"></i>
                            </button>
                        </div>
                    </div>
                    <hr />
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    Grille Tarifaire
                                </button>

                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="example2" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Destination</th>
                                                            <th>PorteChar</th>
                                                            <th>Montant</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($grilleTarifaires->groupBy('destination.libelle') as $libelle => $items)
                                                            <tr>
                                                                <td rowspan="{{ count($items) }}">{{ $libelle }}</td>
                                                                <td>{{ $items[0]->porteChar->libelle }}</td>
                                                                <td>{{ $items[0]->cout }}</td>
                                                            </tr>
                                                            @for ($i = 1; $i < count($items); $i++)
                                                                <tr>
                                                                    <td>{{ $items[$i]->porteChar->libelle }}</td>
                                                                    <td>{{ $items[$i]->cout }}</td>
                                                                </tr>
                                                            @endfor
                                                        @endforeach
                                                    </tbody>

                                                    <tfoot>
                                                        <tr>
                                                            <th>Destination</th>
                                                            <th>PorteChar</th>
                                                            <th>Montant</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                @endif

                @if ($company->type === 'transitaire')
                <div class="card-body">
                    <div class="row">
                        <div class="col-10">
                            <h5 class="card-title">GRILLE TARIFAIRE <span class="text-uppercase">{{   $company->raison_sociale }}</span></h5>
                        </div>
                        <div class="ms-auto col-2 text-end">
                            <button class="btn btn-primary p-1 text-center" data-bs-toggle="modal" data-bs-target="#addTransitGrille">
                                <i class="bx bxs-plus-square mx-auto"></i>
                            </button>
                        </div>
                    </div>
                    <hr />
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    Grille Tarifaire
                                </button>

                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="example2" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>HAD</th>
                                                            <th>Montant</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($grilleTariftransits->groupBy('had.libelle') as $libelle => $items)
                                                            <tr>
                                                                <td rowspan="{{ count($items) }}">{{ $libelle }}</td>

                                                                <td>{{ $items[0]->cout }}</td>
                                                            </tr>
                                                            @for ($i = 1; $i < count($items); $i++)
                                                                <tr>

                                                                    <td>{{ $items[$i]->cout }}</td>
                                                                </tr>
                                                            @endfor
                                                        @endforeach
                                                    </tbody>

                                                    <tfoot>
                                                        <tr>
                                                            <th>HAD</th>
                                                            <th>Montant</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @include('admin.company.grilleTarif.addTransportModal')
    @include('admin.company.grilleTarif.addTransitModal')
</div>
@endsection()
