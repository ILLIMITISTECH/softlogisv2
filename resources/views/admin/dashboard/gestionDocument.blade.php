@extends('admin.layouts.admin')
@section('section')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">DOCUMENTATION</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Gestion documentaire</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-grid mb-4"> <a href="javascript:;" class="btn btn-primary">Agent en charge de dossier</a>
                    </div>
                    <div class="fm-menu ">
                        <div class="list-group list-group-flush "> 
                            @forelse ($allAgents as $agent)
                            <a href="javascript:;" class="list-group-item py-1 ">
                                <img src="{{ asset('assets/images/avatars/avatar-2.png')}}" width="25" height="25" class="rounded-circle me-2" alt="" />
                                <span class="size_12 me-2">
                                    {{ $agent->name .' '.$agent->lastname }}
                                </span>
                                <span class="float-end badge badge-info badge-rounded bg-info p-1" style="font-size: 8px">50</span>
                            </a>
                            @empty
                                <span>Aucun agent</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="card size_12">
                <div class="card-body">
                    
                    @foreach ($docs as $doc)
                        <div class="d-flex align-items-center mt-3">
                            <div class="fm-file-box bg-light-success text-success"><i class='bx bxs-file-doc'></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-0">{{ $doc->libelle ?? '--'}}</h6>
                                <p class="mb-0 text-secondary">123 / {{ $sourcingByBl->count()}} docs</p>
                            </div>
                            <h6 class="text-primary mb-0">256 MB</h6>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-9">
            <div class="card">
                <div class="card-body">
                    
                    <div class="row mt-3">
                        <div class="col-12 col-lg-4">
                            <div class="card shadow-none border radius-15">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="fm-icon-box radius-15 bg-primary text-white"><i class='lni lni-google-drive'></i>
                                        </div>
                                        <div class="ms-auto font-24"><i class='bx bx-dots-horizontal-rounded'></i>
                                        </div>
                                    </div>
                                    <h5 class="mt-3 mb-0">Total Dossier</h5>
                                    <p class="mb-1 mt-4">
                                        <span>{{ $sourcingByBl->count() }} 
                                            @if ($sourcingByBl->count() > 0)
                                                dossiers
                                            @else
                                                dossier
                                            @endif
                                        </span> 
                                    </p>
                                    <div class="progress" style="height: 7px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card shadow-none border radius-15">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="fm-icon-box radius-15 bg-danger text-white"><i class='lni lni-dropbox-original'></i>
                                        </div>
                                        <div class="ms-auto font-24"><i class='bx bx-dots-horizontal-rounded'></i>
                                        </div>
                                    </div>
                                    <h5 class="mt-3 mb-0">Dossier Assigné</h5>
                                    <p class="mb-1 mt-4"><span>0 dossier</span>
                                    </p>
                                    <div class="progress" style="height: 7px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card shadow-none border radius-15">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="fm-icon-box radius-15 bg-warning text-dark"><i class='bx bxs-door-open'></i>
                                        </div>
                                        <div class="ms-auto font-24"><i class='bx bx-dots-horizontal-rounded'></i>
                                        </div>
                                    </div>
                                    <h5 class="mt-3 mb-0">Dossier Non Assigné</h5>
                                    <p class="mb-1 mt-4"><span>118  dossiers</span>
                                    </p>
                                    <div class="progress" style="height: 7px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Recent Dossier</h5>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table id="example2" class="table table-striped table-hover table-sm mb-0 table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>N° BL <i class='bx bx-up-arrow-alt ms-2'></i>
                                    </th>
                                    <th>ALERTE</th>
                                    <th>ETA</th>
                                    <th>ETD</th>
                                    <th>NBR ARTICLES</th>
                                    <th>CA</th>
                                    
                                    <th>RFCV</th>
                                    <th>COC</th>
                                    <th>FDI</th>
                                    <th>BC</th>
                                    <th>CO</th>
                                    <th>AGENT</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($sourcingByBl as $item)
                                @php
                                    $date_eta = Carbon\Carbon::parse($item->date_arriver);
                                    $date_alerte = $date_eta->subDays(10)->format('d/m/y');
                                @endphp
                                    <tr>
                                    <td>
                                        <div class="font-weight-bold text-primary">
                                            <a href="{{ route('admin.sourcing.show', $item->uuid)}} ">{{ $item->num_bl ?? '--'}}</a>
                                        </div>
                                    </td>
                                    <td class="text-danger"> {{ $date_alerte ?? '--'}} </td>
                                    <td>{{ Carbon\Carbon::parse($item->date_arriver)->format('d/m/y') ?? '--'}}</td>
                                    <td>{{ Carbon\Carbon::parse($item->date_depart)->format('d/m/y') ?? '--'}}</td>
                                    <td>{{ $item->products->count() ?? '--'}}</td>
                                    <td>
                                        <div class="form-check form-switch form-check-success">
                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckSuccess" checked>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch form-check-success">
                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckSuccess" checked>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch form-check-success">
                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckSuccess" checked>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch form-check-danger">
                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckSuccess">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch form-check-danger">
                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckSuccess">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch form-check-success">
                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckSuccess" checked>
                                        </div>
                                    </td>
                                    <td>Jhon Doe</td>
                                    <td>
                                        <a href="javascript:;" class="mx-auto"><i class='bx bxs-edit'></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
</div>
@endsection