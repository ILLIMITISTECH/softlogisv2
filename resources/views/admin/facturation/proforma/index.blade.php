@extends('admin.layouts.admin')
@section('section')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Facturation</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Proforma</li>
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
            <ul class="nav nav-tabs nav-success" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#successhome" role="tab" aria-selected="true">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class='bx bx-home font-18 me-1'></i>
                            </div>
                            <div class="tab-title">Transporteur</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#successprofile" role="tab" aria-selected="false">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i>
                            </div>
                            <div class="tab-title">Transitaire</div>
                        </div>
                    </a>
                </li>

            </ul>
            <div class="tab-content py-3">
                <div class="tab-pane fade show active" id="successhome" role="tabpanel">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">

                        <div class="ms-auto">
                          @can('Create Facture')
                          <a href="{{ route('admin.proforma.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0" ><i class="bx bxs-plus-square"></i>{{ __('Voir Offres') }}</a>
                          @endcan
                        </div>
                    </div>

                      <div class="table-responsive">
                          <table id="example2" class="table table-striped table-bordered">
                              <thead>
                                  <tr>
                                      <th>Transporteur</th>
                                      <th>Destination</th>
                                      <th>PorteChar</th>
                                      <th>Montant</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($grilleTarifs->groupBy('destination.libelle') as $libelle => $items)
                                      <tr>
                                          <td>{{ $items[0]->transporteur->raison_sociale ?? '--'}}</td>
                                          <td rowspan="{{ count($items) }}">{{ $libelle ?? '--' }}</td>
                                          <td>{{ $items[0]->porteChar->libelle ?? '--' }}</td>
                                          <td>{{ $items[0]->cout ?? '--' }}</td>
                                      </tr>
                                      @for ($i = 1; $i < count($items); $i++)
                                          <tr>
                                              <td>{{ $items[0]->transporteur->raison_sociale ?? '--' }}</td>
                                              <td>{{ $items[$i]->porteChar->libelle ?? '--' }}</td>
                                              <td>{{ $items[$i]->cout ?? '--' }}</td>
                                          </tr>
                                      @endfor
                                  @endforeach
                              </tbody>

                              <tfoot>
                                  <tr>
                                      <th>Transporteur</th>
                                      <th>Destination</th>
                                      <th>PorteChar</th>
                                      <th>Montant</th>
                                  </tr>
                              </tfoot>
                          </table>
                      </div>
                </div>
                <div class="tab-pane fade" id="successprofile" role="tabpanel">
                    <div class="ms-auto">
                        @can('Create Facture')
                        <a href="{{ route('admin.proforma.createEdit') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0" ><i class="bx bxs-plus-square"></i>{{ __('Voir Offres') }}</a>
                        @endcan
                      </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table id="exam2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Transitaire</th>
                                    <th>HAD</th>
                                    <th>Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grilleTransits->groupBy('had.libelle') as $libelle => $items)
                                    <tr>
                                        <td>{{ $items[0]->transitaire->raison_sociale ?? 'N/A' }}</td>
                                        <td rowspan="{{ count($items) }}">{{ $libelle }}</td>
                                        <td>{{ $items[0]->cout ?? 'N/A' }}</td>
                                    </tr>
                                    @for ($i = 1; $i < count($items); $i++)
                                        <tr>
                                            <td>{{ $items[0]->transitaire->raison_sociale ?? 'N/A' }}</td>
                                            <td>{{ $items[$i]->cout ?? 'N/A' }}</td>
                                        </tr>
                                    @endfor
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Transitaire</th>
                                    <th>Had</th>
                                    <th>Montant</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="card d-none">
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4 gap-3">

              <div class="ms-auto">
                @can('Create Facture')
                {{-- <button type="button" class="btn btn-primary radius-30 mt-2 mt-lg-0" data-bs-toggle="modal" data-bs-target="#addFactureProforma"><i class="bx bxs-plus-square"></i>Nouvelle Facture</button> --}}
                <a href="{{ route('admin.proforma.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0" ><i class="bx bxs-plus-square"></i>{{ __('Voir Offres') }}</a>
                @endcan
              </div>
            </div>

            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Transporteur</th>
                            <th>Destination</th>
                            <th>PorteChar</th>
                            <th>Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grilleTarifs->groupBy('destination.libelle') as $libelle => $items)
                            <tr>
                                <td>{{ $items[0]->transporteur->raison_sociale ?? '--'}}</td>
                                <td rowspan="{{ count($items) }}">{{ $libelle ?? '--'}}</td>
                                <td>{{ $items[0]->porteChar->libelle ?? '--'}}</td>
                                <td>{{ $items[0]->cout }}</td>
                            </tr>
                            @for ($i = 1; $i < count($items); $i++)
                                <tr>
                                    <td>{{ $items[0]->transporteur->raison_sociale ?? '--'}}</td>
                                    <td>{{ $items[$i]->porteChar->libelle ?? '--'}}</td>
                                    <td>{{ $items[$i]->cout ?? '--'}}</td>
                                </tr>
                            @endfor
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>Transporteur</th>
                            <th>Destination</th>
                            <th>PorteChar</th>
                            <th>Montant</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <hr class="my-4">
            <div class="table-responsive mt-4">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Transitaire</th>
                            <th>HAD</th>
                            <th>Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grilleTransits->groupBy('had.libelle') as $libelle => $items)
                            <tr>
                                <td>{{ $items[0]->transitaire->raison_sociale ?? 'N/A' }}</td>
                                <td rowspan="{{ count($items) }}">{{ $libelle }}</td>
                                <td>{{ $items[0]->cout ?? 'N/A' }}</td>
                            </tr>
                            @for ($i = 1; $i < count($items); $i++)
                                <tr>
                                    <td>{{ $items[0]->transitaire->raison_sociale ?? 'N/A' }}</td>
                                    <td>{{ $items[$i]->cout ?? 'N/A' }}</td>
                                </tr>
                            @endfor
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>Transitaire</th>
                            <th>Had</th>
                            <th>Montant</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    {{-- @include('admin.facturation.proforma.addModal') --}}
</div>

@endsection
