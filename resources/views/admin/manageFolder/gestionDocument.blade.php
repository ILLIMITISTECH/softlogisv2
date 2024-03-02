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
        {{-- <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-grid mb-4"> <a href="javascript:;" class="btn btn-primary">Agent en charge de dossier</a>
                    </div>
                    <div class="fm-menu ">
                        <div class="list-group list-group-flush "> 
                            @forelse ($allAgents as $agent)
                                @php
                                    $folderByAgentCount = App\Models\DocAssigned::where('etat', 'actif')
                                    ->where('userUuid', $agent->uuid)->groupBy('userUuid')->count();
                                @endphp

                                @if ($folderByAgentCount > 0)
                                <a href="javascript:;" class="list-group-item py-1 ">
                                    <img src="{{ asset('avatars/'.$agent->avatar)}}" width="25" height="25" class="rounded-circle me-2" alt="" />
                                    <span class="size_12 me-2">
                                        {{ $agent->name .' '.$agent->lastname }}
                                    </span>
                                    
                                    <span class="float-end badge badge-info badge-rounded bg-info p-1" style="font-size: 8px">
                                        {{$folderByAgentCount}}
                                    </span>
                                </a>
                                @endif
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
        </div> --}}
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    
                    <div class="row mt-3">
                        <div class="row">
                            <div class="card col-3">
                                <div class="d-grid">
                                    <a href="javascript:;" class="btn btn-primary">Agent en charge de dossier</a>
                                </div>
                                <div class="card-body overflow-scroll" style="max-height: 520px; overflow-y: auto;">
                                    
                                    <div class="fm-menu">
                                        <div class="list-group list-group-flush">
                                            @forelse ($allAgents as $agent)
                                            @php
                                            // $folderByAgentCount = App\Models\DocAssigned::where('etat', 'actif')->where('userUuid', $agent->uuid)->groupBy('userUuid')->count();

                                            $folderByAgentCount = countFolderByAgent($agent->uuid);
                                            @endphp
                            
                                            @if ($folderByAgentCount > 0)
                                            <a href="javascript:;" class="list-group-item py-1">
                                                <img src="{{ asset('avatars/'.$agent->avatar)}}" width="25" height="25" class="rounded-circle me-2" alt="" />
                                                <span class="size_12 me-2">
                                                    {{ $agent->name .' '.$agent->lastname }}
                                                </span>
                            
                                                <span class="float-end badge badge-info badge-rounded bg-info p-1" style="font-size: 8px">
                                                    {{$folderByAgentCount}}
                                                </span>
                                            </a>
                                            @endif
                                            @empty
                                            <span>Aucun agent</span>
                                            @endforelse
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card radius-10">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <p class="mb-0 text-secondary ">Nombre Total Agent</p>
                                                    <h4 class="my-1">{{ $allAgents->count() }}</h4>
                                                </div>
                                                <div class="text-primary ms-auto font-35"><i class="bx bxs-group"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card radius-10">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <p class="mb-0 text-secondary">Nombre Total agent Assigné</p>
                                                    <h4 class="my-1">{{$countUserAssignFolder}}</h4>
                                                </div>
                                                <div class="text-primary ms-auto font-35"><i class='bx bxl-chrome'></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-9 row">
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
                                            <p class="mb-1 mt-4">
                                                <span>{{$nombreDossiersAssignes}} 
                                                    @if ($nombreDossiersAssignes > 0)
                                                        dossiers
                                                    @else
                                                        dossier
                                                    @endif
                                                </span> 
                                            </p>
                                            <div class="progress" style="height: 7px;">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $perCentdocAssign}}%;" aria-valuenow="{{ $perCentdocAssign}}" aria-valuemin="0" aria-valuemax="100"></div>
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
                                            <p class="mb-1 mt-4">
                                                <span>{{$nombreDossiersEnAttente}} 
                                                    @if ($nombreDossiersEnAttente > 0)
                                                        dossiers
                                                    @else
                                                        dossier
                                                    @endif
                                                </span> 
                                            </p>
                                            <div class="progress" style="height: 7px;">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{$perCentdocNotAssign}}%;" aria-valuenow="{{$perCentdocNotAssign}}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="chart4"></div>
                                        </div>
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
                                    <th>ARTICLES</th>
                                    @foreach ($docs as $doc )
                                    <th>{{$doc->libelle}}</th>
                                    @endforeach
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
                                    @foreach ($docs as $doc )
                                    <td>
                                        <div class="form-check form-switch  form-check-success" clickedUrl="{{ route('admin.updateStatusFolder') }}" value="{{$doc->uuid}}" name="folderCheck" sourcing="{{$item->uuid}}">
                                            <input class="form-check-input folderCheck" unchecked clickedUrl="{{ route('admin.updateStatusFolder') }}" value="{{$doc->uuid}}" name="folderCheck" sourcing="{{$item->uuid}}" type="checkbox"
                                            @if (isfolderCheck($item->uuid,$doc->uuid))
                                                {{"checked disabled"}} 
                                            @endif
                                            role="switch" id="flexSwitchCheckSuccess" >
                                            {{-- {{isfolderCheck($item->uuid,$doc->uuid)}} --}}
                                        </div>
                                    </td>
                                    @endforeach
                                    
                                    <td>
                                        @if ($item->folderAssign)
                                        
                                            <span class="text-primary size_12">
                                                @if($item->folderAssign->user)
                                                    {{$item->folderAssign->user->name.' '.$item->folderAssign->user->lastname}}
                                                @else
                                                    Non Assigné
                                                @endif
                                            </span>
                                            <br>
                                            <hr>
                                            <span class="text-info size_12">
                                                @if($item->folderAssign->backup)
                                                    {{$item->folderAssign->backup->name.' '.$item->folderAssign->backup->lastname}}
                                                @else
                                                    N/A
                                                @endif
                                            </span>
                                        
                                        @endif
                                    </td>
                                    
                                    <td class="text-center align-self-center">
                                        
                                        <a data-bs-toggle="modal" data-bs-target="#assignModal{{ $item->uuid }}" class="text-success" style="cursor:pointer;"><i class="lni lni-network"></i></a>

                                        <a data-bs-toggle="modal" data-bs-target="#editModal{{ $item->uuid }}" class="mx-2" style="cursor:pointer;"><i class='bx bxs-edit'></i></a>

                                        <a class="" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#commentModal{{ $item->uuid }}">
                                            <i class="lni lni-comments-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                {{-- include --}}
                                @include('admin.manageFolder.assignModal')
                                @include('admin.manageFolder.editModal')
                                @include('admin.manageFolder.commentModal')
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