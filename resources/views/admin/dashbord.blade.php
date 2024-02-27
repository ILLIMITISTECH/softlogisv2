@extends('admin.layouts.admin')

@section('section')
<!--start page wrapper -->

<div class="page-content">

    @include('admin.dashboard.centralAchat')

    <div class="row">
        <div class="col-12 col-lg-8 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0"><span class="text-uppercase">Niveau de stock</span> /Unité</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
                                    class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Stock previsionelle</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Stock disponible</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-0 mb-0">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
                        <div class="col">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="d-flex align-items-center cursor-pointer justify-content-between"
                                        onclick="redirectToInFabrication()">
                                        <div>
                                            <p class="mb-0 text-secondary text-uppercase size_12">En Fabrications</p>
                                            <h4 class="my-1">{{ $inFabrication->count() }}</h4>
                                            <p class="mb-0 font-13 text-success"><i
                                                    class='bx bxs-up-arrow align-middle'></i>{{ number_format($inFabrication->sum('price_unitaire')), 0, ',', ' ' }}
                                                <span>Fcfa</span></p>
                                        </div>
                                        <div class="widgets-icons bg-light-info text-info text-end float-end">
                                            <i class='bx bxs-group'></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card radius-10">
                                {{-- <a href="{{ route('admin.insortiUsine') }}"> --}}
                                <div class="card-body">
                                    <div class="d-flex align-items-center cursor-pointer"
                                        onclick="redirectToInsortiUsine()">
                                        <div>
                                            <p class="mb-0 text-secondary text-uppercase size_12">Sortie d'usine</p>
                                            <h4 class="my-1">{{ $inUsineOut->count() }}</h4>
                                            <p class="mb-0 font-13 text-danger"><i
                                                    class='bx bxs-down-arrow align-middle'></i>{{ number_format($inUsineOut->sum('price_unitaire')), 0, ',', ' ' }}
                                                <span>Fcfa</span></p>
                                        </div>
                                        <div class="widgets-icons bg-light-danger text-danger ms-auto"><i
                                                class='bx bxs-binoculars'></i>
                                        </div>
                                    </div>
                                </div>
                                {{-- </a> --}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="card radius-10">
                                {{-- <a href="{{ route('admin.enExpedition') }}"> --}}
                                <div class="card-body">
                                    <div class="d-flex align-items-center cursor-pointer"
                                        onclick="redirectToEnExpedition()">
                                        <div>
                                            <p class="mb-0 text-secondary text-uppercase size_12">Cours de route
                                                import</p>
                                            <h4 class="my-1">{{ $inWaitExpediteImport->count() }} </h4>
                                            <p class="mb-0 font-13 text-danger"><i
                                                    class='bx bxs-down-arrow align-middle'></i>{{ number_format($inWaitExpediteImport->sum('price_unitaire')), 0, ',', ' ' }}
                                                <span>Fcfa</span></p>
                                        </div>
                                        <div class="widgets-icons bg-light-warning text-warning ms-auto"><i
                                                class='bx bx-line-chart-down'></i>
                                        </div>
                                    </div>
                                </div>
                                {{-- </a> --}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="card radius-10">
                                {{-- <a href="{{ route('admin.arriverAuPod') }}"> --}}
                                <div class="card-body">
                                    <div class="d-flex align-items-center cursor-pointer"
                                        onclick="redirectToArriverAuPod()">
                                        <div>
                                            <p class="mb-0 text-secondary text-uppercase size_12">Arrivé au pod</p>
                                            <h4 class="my-1">{{ $arrivagePod->count() }} </h4>
                                            <p class="mb-0 font-13 text-danger"><i
                                                    class='bx bxs-down-arrow align-middle'></i>{{ number_format($arrivagePod->sum('price_unitaire')), 0, ',', ' ' }}
                                                <span>Fcfa</span></p>
                                        </div>
                                        <div class="widgets-icons bg-light-warning text-warning ms-auto"><i
                                                class='bx bx-line-chart-down'></i>
                                        </div>
                                    </div>
                                </div>
                                {{-- </a> --}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="d-flex align-items-center cursor-pointer" onclick="redirectToStocked()">
                                        <div>
                                            <p class="mb-0 text-secondary text-uppercase size_12">Reçu/Stocké</p>
                                            <h4 class="my-1">{{ $receivStock->count() }} </h4>
                                            <p class="mb-0 font-13 text-danger"><i
                                                    class='bx bxs-down-arrow align-middle'></i>{{ number_format($receivStock->sum('price_unitaire')), 0, ',', ' ' }}
                                                <span>Fcfa</span></p>
                                        </div>
                                        <div class="widgets-icons bg-light-warning text-warning ms-auto"><i
                                                class='bx bx-line-chart-down'></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="d-flex align-items-center cursor-pointer"
                                        onclick="redirectToExpEnCours()">
                                        <div>
                                            <p class="mb-0 text-secondary text-uppercase size_12">Cours de Route export
                                            </p>
                                            <h4 class="my-1">{{ $inWaitExpediteExport->count() }} </h4>
                                            <p class="mb-0 font-13 text-danger"><i
                                                    class='bx bxs-down-arrow align-middle'></i>{{ number_format($inWaitExpediteExport->sum('price_unitaire')), 0, ',', ' ' }}
                                                <span>Fcfa</span></p>
                                        </div>
                                        <div class="widgets-icons bg-light-warning text-warning ms-auto"><i
                                                class='bx bx-line-chart-down'></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2" style="min-height: 150px">
                        <div class="col">
                            <div class="card radius-10 ">
                                <div class="card-body">
                                    <div class="d-flex align-items-center cursor-pointer"
                                        onclick="redirectTodelivered()">
                                        <div>
                                            <p class="mb-0 text-secondary text-uppercase size_12">Livré</p>
                                            <h4 class="my-1">{{ $liverExpedite->count() }} </h4>
                                            <p class="mb-0 font-13 text-success"><i
                                                    class="bx bxs-up-arrow align-middle"></i>{{ number_format($liverExpedite->sum('price_unitaire')), 0, ',', ' ' }}
                                                <span>Fcfa</span></p>
                                        </div>
                                        <div class="widgets-icons bg-light-success text-success ms-auto"><i
                                                class="bx bxs-wallet"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-4">
                                <p class="mb-2 size_12">NEEMBA CI || <span class="text-primary">{{ $familyNemba->count() }}</span><span
                                        class="float-end">{{ round($percenfamilyNembaCount) }}%</span></p>
                                <div class="progress" style="height: 7px;">
                                    <div class="progress-bar bg-primary progress-bar-striped"
                                        role="progressbar" style="width: {{ $percenfamilyNembaCount }}%"></div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <p class="mb-2 size_12">NEEMBA INTERNATIONAL || <span class="text-danger">{{ $familyNembaInter->count() }}</span><span
                                        class="float-end">{{ round($percenfamilyNembaInter) }}%</span></p>
                                <div class="progress" style="height: 7px;">
                                    <div class="progress-bar bg-danger progress-bar-striped"
                                        role="progressbar" style="width: {{ $percenfamilyNembaInter}}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col row mt-0">
                    <div class="d-flex flex-column align-items-center col px-0" style="height: 100%">
                        <div class="flex-grow-1">
                            <span class="size_12">{{ $percentageInFabrication }} %</span>
                            <div class="progress vertical-progress text-center">
                                <div class="progress-bar bg-info d-flex text-primary bold text-center justify-content-center align-items-center align-self-center" role="progressbar" style="height: {{ $percentageInFabrication }}%; width: 20px;">{{ $percentageInFabrication }}</div>
                            </div>
                        </div>
                        <p class="size_9 mt-4">Fabrication</p>
                    </div>
                    <div class="d-flex flex-column align-items-center col px-0" style="height: 100%">
                        <div class="flex-grow-1">
                            <span class="size_12">{{ $percentageinUsineOut }} %</span>
                            <div class="progress vertical-progress text-center">
                                <div class="progress-bar bg-info d-flex text-primary bold text-center justify-content-center align-items-center align-self-center" role="progressbar" style="height: {{ $percentageinUsineOut }}%; width: 20px;">{{ $percentageinUsineOut }}</div>
                            </div>
                        </div>
                        <p class="size_9 mt-4">Sortie Usine</p>
                    </div>
                    <div class="d-flex flex-column align-items-center col px-0" style="height: 100%">
                        <div class="flex-grow-1">
                            <span class="size_12">{{ $percentageinWaitExpediteImport }} %</span>
                            <div class="progress vertical-progress text-center">
                                <div class="progress-bar bg-info d-flex text-primary bold text-center justify-content-center align-items-center align-self-center" role="progressbar" style="height: {{ $percentageinWaitExpediteImport }}%; width: 20px;">{{ $percentageinWaitExpediteImport }}</div>
                            </div>
                        </div>
                        <p class="size_9 mt-4">Cours d'import</p>
                    </div>
                    <div class="d-flex flex-column align-items-center col px-0" style="height: 100%">
                        <div class="flex-grow-1">
                            <span class="size_12">{{ $percentagearrivagePod }} %</span>
                            <div class="progress vertical-progress text-center">
                                <div class="progress-bar bg-info d-flex text-primary bold text-center justify-content-center align-items-center align-self-center" role="progressbar" style="height: {{ $percentagearrivagePod }}%; width: 20px;">{{ $percentagearrivagePod }}</div>
                            </div>
                        </div>
                        <p class="size_9 mt-4">POD</p>
                    </div>
                    <div class="d-flex flex-column align-items-center col px-0" style="height: 100%">
                        <div class="flex-grow-1">
                            <span class="size_12">{{ $percentagereceivStock }} %</span>
                            <div class="progress vertical-progress text-center">
                                <div class="progress-bar bg-info d-flex text-primary bold text-center justify-content-center align-items-center align-self-center" role="progressbar" style="height: {{ $percentagereceivStock }}%; width: 20px;">{{ $percentagereceivStock }}</div>
                            </div>
                        </div>
                        <p class="size_9 mt-4">Stocké</p>
                    </div>
                    <div class="d-flex flex-column align-items-center col px-0" style="height: 100%">
                        <div class="flex-grow-1">
                            <span class="size_12">{{ $percentageinWaitExpediteExport }} %</span>
                            <div class="progress vertical-progress text-center">
                                <div class="progress-bar bg-info d-flex text-primary bold text-center justify-content-center align-items-center align-self-center" role="progressbar" style="height: {{ $percentageinWaitExpediteExport }}%; width: 20px;">{{ $percentageinWaitExpediteExport }}</div>
                            </div>
                        </div>
                        <p class="size_9 mt-4">cours d'export</p>
                    </div>
                    <div class="d-flex flex-column align-items-center col px-0" style="height: 100%">
                        <div class="flex-grow-1">
                            <span class="size_12">{{ $percentageliverExpedite }} %</span>
                            <div class="progress vertical-progress text-center">
                                <div class="progress-bar bg-info d-flex text-primary bold text-center justify-content-center align-items-center align-self-center" role="progressbar" style="height: {{ $percentageliverExpedite }}%; width: 20px;">{{ $percentageliverExpedite }}</div>
                            </div>
                        </div>
                        <p class="size_9 mt-4">Livré</p>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
                    <div class="col">
                        <div class="p-3 " style="position: relative;">
                            <div class="col-12 row">
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <h6 class="mb-0 size_14">{{ $stockGlobals->count() }}</h5>
                                </div>
                                <div class="col-4 text-end mt-0 m-0 px-0">
                                    <a href="{{ route('admin.allProduction') }}">
                                        <img src="{{ asset('icone/voir.png') }}" alt="" style="max-width: 20px">
                                    </a>
                                </div>
                            </div>

                            <small class="mb-0 size_12">Quantité sur chaine de production</small>
                            <p>
                                <i class="bx bx-up-arrow-alt align-middle"></i>
                                {{ number_format($stockGlobals->sum('price_unitaire')) }} <span>Fcfa</span>
                            </p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">{{ $stockPreview }}</h5>
                            <small class="mb-0">Stock Prévisionnel</small>
                            <p> <i class="bx bx-up-arrow-alt align-middle"></i>
                                {{ number_format($stockPreviewValue), 0, ',', ' ' }} <span>Fcfa</span></p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3">
                            <small>Prochaine arrivée de marchandise</small>
                            @if ($firstNextArrivage !== null)
                            <h6
                                class="mb-0 {{ Carbon\Carbon::parse($firstNextArrivage->date_arriver)->isPast() ? 'text-danger' : '' }}">
                                {{ Carbon\Carbon::parse($firstNextArrivage->date_arriver)->format('d/m/Y') }}
                            </h6>
                            @else
                            <h6 class="mb-0">Aucun</h6>
                            @endif
                            <small class="mb-0">
                                <button type="button" class=" btn btn-sm bg-transparent" data-bs-toggle="modal"
                                    data-bs-target="#nextArrivageModal">Lister
                                    <i class="bx bx-right-arrow-alt align-middle text-success"></i>
                                </button>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0 text-uppercase">Rotation de Stock</h6>
                        </div>
                        <div class="dropdown ms-auto my-auto py-auto" id="idRotationData">
                            <button class="btn btn-outline-success px-2 size_12 border-0 active focus-outline-none"
                                id="btnRotationStockIn" onclick="rotationDisplayIn('idRotationStockIn')"><i
                                    class="lni lni-arrow-down size_12"></i> In</button>
                            <button class=" btn btn-outline-danger px-2 size_12 border-0" id="btnRotationStockOut"
                                onclick="rotationDisplayOut('idRotationStockOut')"><i
                                    class="lni lni-arrow-up size_12"></i>Out</button>

                        </div>
                    </div>
                </div>

                <div class="card-body pb-0" id="idRotationStockIn">
                    <div class="button-container row col-12 d-flex justify-content-between mx-1" style="height: 5%">
                        <button class="rounded-button active col-6 mx-0" id="idMensuel"
                            onclick="toggleDisplay('idMensuelBlock')">Mensuel</button>
                        <button class="rounded-button col-6 mx-0" id="idHebdomadaire"
                            onclick="toggleDispla('idHebdomadaireBlock')">Hebdomadaire</button>
                    </div>

                    <div class="list-group list-group-flush mt-2 mb-0 pb-2" id="idMensuelBlock" style="height: 90%">

                        <div class="card-body h-75">
                            <div class="chart-container-2">
                                @if ( $InStock->count() != 0)
                                    <canvas id="chartInStock"></canvas>
                                @else
                                <center>Aucune entrée pour le mois en cours</center>
                                @endif
                            </div>
                        </div>

                        <div class="mb-0 bottom-0 card-footer h-25">
                            <ul class="list-group list-group-flush">
                                <li
                                    class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                                    Total Entré <span class="badge bg-info rounded-pill">{{ $InStock->count() }}</span>
                                </li>
                                <li
                                    class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                    Conforme <span
                                        class="badge bg-success rounded-pill">{{ $conformInStockPerMonth->count() }}</span>
                                </li>
                                <li
                                    class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                    Non-Conforme <span
                                        class="badge bg-danger rounded-pill">{{ $noConformInStockPerMonth->count() }}</span>
                                </li>
                            </ul>
                        </div>

                    </div>

                    <div class="list-group list-group-flush mt-2" id="idHebdomadaireBlock" style="display: none">
                        <div>
                            <ul class="list-group list-group-flush pb-2">
                                <li
                                    class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                                    Total Entré <span
                                        class="badge bg-info rounded-pill">{{ $InStockWekly->count() }}</span>
                                </li>
                                <li
                                    class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                    Conforme <span
                                        class="badge bg-success rounded-pill">{{ $conformInStockWeekly->count() }}</span>
                                </li>
                                <li
                                    class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                    Non-Conforme <span
                                        class="badge bg-danger rounded-pill">{{ $noConformInStockWeekly->count() }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body" style="max-height: 300px !important">
                            <div class="chart-container-2">
                                <canvas id="chartOutStock"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="idRotationStockOut" style="display: none">
                    <center>
                        <h6 class="my-2 text-decoration-underline">Mensuel</h6>
                    </center>
                    <div class="col d-flex justify-content-center text-center">
                        <div class="p-3">
                            <h5 class="mb-0">{{ $outStockMonth->count() }}</h5>
                            <small class="mb-0">Quantité de produit Sortie</small>
                            <p>
                                <i class="bx bx-down-arrow-alt align-middle text-danger"></i>
                                {{ number_format($totalValue) }} <span>Fcfa</span>
                            </p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <center>
                        <h6 class="my-2 text-decoration-underline">Hebdomadaire</h6>
                    </center>
                    <div class="col d-flex justify-content-center text-center">
                        <div class="p-3">
                            <h5 class="mb-0">{{ $outStockWekly->count() }}</h5>
                            <small class="mb-0">Quantité de produit Sortie</small>
                            <p>
                                <i class="bx bx-down-arrow-alt align-middle text-danger"></i>
                                {{ number_format($totalValueWeekly, 0, ',', ' ') }} <span>Fcfa</span>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--fin de la ligne-->

    <div class="row">
        <div class="col-12 col-lg-8 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">IMPORT</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
                                    class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                            <ul class="dropdown-menu">

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center ms-auto font-13 gap-2 mb-3" id="switchBtnImportGroup">
                        <span class="border px-1 rounded cursor-pointer active" id="btnswitchSourcing"
                            onclick="switchDisplaySourcing('blockSourcing')"><i class="bx bxs-circle me-1"
                                style="color: #14abef"></i>Sourcings</span>
                        <span class="border px-1 rounded cursor-pointer" id="btnswitchTransit"
                            onclick="switchDisplayTransit('blockTransit')"><i class="bx bxs-circle me-1"
                                style="color: #ffc107"></i>Ordre de transit</span>
                        <span class="border px-1 rounded cursor-pointer" id="btnswitchtransport"
                            onclick="switchDisplayTransport('blockTransport')"><i class="bx bxs-circle me-1"
                                style="color: #ff7220"></i>Marchndises Importer</span>
                    </div>
                    <div class="content" id="blockSourcing">
                        <div
                            class="row row-cols-1 mt-3 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top border-bottom">
                            <div class="col">
                                <div class="p-3">
                                    <h5 class="mb-0">{{ round($averageDelaySourcing, 2) }} /jours <i
                                            class="bx bx-up-arrow-alt align-middle"></i></h5>
                                    <small class="mb-0 text-capitalize">Temps moyen de soumission documentaire</small>
                                </div>
                            </div>
                            <div class="col">
                                <div class="py-1 px-3 ">
                                    <h5 class="mb-0">{{ $sourcingPerMonths->count() }}</h5>
                                    <small class="mb-0">Sourcing /mois</small>
                                </div>
                                <hr>
                                <div class="px-3 py-1">
                                    <h5 class="mb-0">{{ $sourcingInValidatPerMonth->count() }}</h5>
                                    <small class="mb-0">Validation Documentaire /mois</small>
                                </div>
                            </div>
                            <div class="col">
                                <div class="p-3">
                                    <small class="text-success">Sourcing Reçu/Stocké</small>
                                    <h6 class="mb-0 text-success size_14">{{ $sourcingReceive->count() }}</h6>
                                    <small class="mb-0">Moyenne de produit conforme reçu<span class="text-success"> <i
                                                class="bx bx-up-arrow-alt align-middle text-success"></i>{{ $percentageConform }}
                                            %</span></small>
                                </div>
                            </div>
                        </div>
                        <div class="chart-container-1 overflow-y-auto overflow-x-hidden">
                            <div class="table-responsive table-bordered table-hover table-scrollable">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                        <tr style="font-size: 10px">
                                            <th>Code</th>
                                            <th>produits</th>
                                            <th>Statut</th>
                                            <th>Date De depart</th>
                                            <th>Date d'arrivée</th>
                                            <th>Publier le</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($sourcings as $sourcing)
                                        <tr>
                                            <td>{{ $sourcing->code }}</td>
                                            <td>{{ $sourcing->products->count() }}</td>
                                            <td>
                                                @if ($sourcing->statut == "draft")
                                                <div
                                                    class="badge rounded-pill text-light bg-secondary p-2 text-uppercase px-3 border-0">
                                                    <i class='bx bxs-circle me-1'></i>Brouillon
                                                </div>
                                                @endif
                                                @if ($sourcing->statut == "started")
                                                <div
                                                    class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3 border-0">
                                                    <i class='bx bxs-circle me-1'></i>Demarrage sourcing
                                                </div>
                                                @endif
                                                @if ($sourcing->statut == "validateDoc")
                                                <div
                                                    class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3 border-0">
                                                    <i class='bx bxs-circle me-1'></i>Demarrage Documentaire
                                                </div>
                                                @endif
                                                @if ($sourcing->statut == "odTransit")
                                                <div
                                                    class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3 border-0">
                                                    <i class='bx bxs-circle me-1'></i>En Transit
                                                </div>
                                                @endif
                                                @if ($sourcing->statut == "odlivraison")
                                                <div
                                                    class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3 border-0">
                                                    <i class='bx bxs-circle me-1'></i>En Livraison
                                                </div>
                                                @endif
                                                @if ($sourcing->statut == "stocked")
                                                <div
                                                    class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3 border-0">
                                                    <i class='bx bxs-circle me-1'></i>Livré/Stocké
                                                </div>
                                                @endif

                                            </td>
                                            <td>{{ Carbon\Carbon::parse($sourcing->date_depart)->format('d/m/Y') }}</td>
                                            <td>{{ Carbon\Carbon::parse($sourcing->date_arriver)->format('d/m/Y') }}
                                            </td>
                                            <td>{{ $sourcing->created_at }}</td>
                                        </tr>
                                        @empty
                                        <span>Aucun sourcing</span>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="content" id="blockTransit" style="display: none">
                        <div
                            class="row row-cols-1 mt-3 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top border-bottom">
                            <div class="col">
                                <div class="p-3">
                                    <h5 class="mb-0">{{ round($averageDelayTransit, 2) }} /jours <i
                                            class="bx bx-up-arrow-alt align-middle"></i></h5>
                                    <small class="mb-0">Temps moyen de transit</small>
                                </div>
                            </div>
                            <div class="col">
                                <div class="py-1 px-3 ">
                                    <h5 class="mb-0">{{ $allTransitPerMonth->count() }}</h5>
                                    <small class="mb-0">Transit / mois</small>
                                </div>
                                <hr>
                                <div class="px-3 py-1">
                                    <h5 class="mb-0">{{ $allTransitPerWekly->count() }}</h5>
                                    <small class="mb-0">Transit / Hebdo</small>
                                </div>
                            </div>
                            <div class="col">

                                <div class="p-3">
                                    <small class="text-dark size_16">Transitaire le plus solicité :</small>
                                    <small
                                        class="mb-0 text-success text-uppercase">{{ $mostUsedTransitaire->transitaire->raison_sociale ?? 'Inconnu' }}</small>
                                    <br>
                                    <small class="mb-0">Nombre de fois<span class="text-success"> <i
                                                class="bx bx-up-arrow-alt align-middle text-success"></i>
                                            @if ($mostUsedTransitaire !== null)
                                            {{ $mostUsedTransitaire->count() }}
                                            @endif
                                        </span></small>
                                </div>

                            </div>
                        </div>
                        <div class="chart-container-1 overflow-y-auto overflow-x-hidden">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                        <tr style="font-size: 10px">
                                            <th>Code</th>
                                            <th>Sourcing Concerné</th>
                                            <th>Documents</th>
                                            <th>Transitaire</th>
                                            <th>Date De creation</th>
                                            <th>Publier par</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($allTransitPerMonth as $transit)
                                        <tr>
                                            <td>{{ $transit->code ?? ''}}</td>
                                            <td>{{ $transit->sourcing->code ?? '' }}</td>
                                            <td>{{ $transit->files->count() ?? ''}}</td>
                                            <td>{{ $transit->transitaire->raison_sociale ?? ''}}</td>
                                            <td>{{ $transit->created_at->format('d/m/Y') ?? '' }}</td>
                                            <td>{{ $transit->user_uuid ?? ''}}</td>
                                        </tr>
                                        @empty
                                        <span>Aucun ordre de transit</span>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="content" id="blockTransport" style="display: none">
                        <div
                            class="row row-cols-1 mt-3 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top border-bottom">
                            <div class="col">
                                <div class="py-1 px-3 text-success ">
                                    <h5 class="mb-0">{{ $conformInStockGlobal->count() }}</h5>
                                    <small class="mb-0">Conforme</small>
                                </div>
                                <hr>
                                <div class="px-3 py-1 text-danger">
                                    <h5 class="mb-0">{{ $noConformInStockGlobal->count() }}</h5>
                                    <small class="mb-0">Non-Conforme</small>
                                </div>
                            </div>
                            <div class="col">
                                <div class="py-1 px-3 ">
                                    <h5 class="mb-0">{{ $InStock->count() }}</h5>
                                    <small class="mb-0">Receptions / Mensuel</small>
                                </div>
                                <hr>
                                <div class="px-3 py-1">
                                    <h5 class="mb-0">{{ $InStockWekly->count() }}</h5>
                                    <small class="mb-0">Reception / Hebdomadaire</small>
                                </div>
                            </div>
                            <div class="col">
                                <div class="p-3">
                                    <small class="text-success">Marchandise Stocké</small>
                                    <h6 class="mb-0 text-success size_14">{{ $sourcingReceive->count() }}</h6>
                                    <small class="mb-0">Moyenne de produit conforme reçu<span class="text-success"> <i
                                                class="bx bx-up-arrow-alt align-middle text-success"></i>{{ $percentageConform }}
                                            %</span></small>
                                </div>
                            </div>
                        </div>
                        <div class="chart-container-1 overflow-y-auto overflow-x-hidden">
                            <div class="table-responsive table-bordered table-hover table-scrollable">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                        <tr style="font-size: 10px">
                                            <th>Famille</th>
                                            <th>Numero de serie</th>
                                            <th>Conformité</th>
                                            <th>Entrepot</th>
                                            <th>Date De reception</th>
                                            <th>Publier par</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($InStock as $InPerMonth)
                                        <tr>
                                            <td>{{ $InPerMonth->product->familly->libelle ?? '--'}}</td>
                                            <td>{{ $InPerMonth->product->numero_serie ?? '--'}}</td>
                                            <td>
                                                @if ($InPerMonth->conformity == "on")
                                                <div
                                                    class="badge rounded-pill text-light bg-success p-2 text-uppercase px-3 border-0">
                                                    <i class='bx bxs-circle me-1'></i>Conforme
                                                </div>
                                                @endif
                                                @if ($InPerMonth->conformity == "off")
                                                <div
                                                    class="badge rounded-pill text-info bg-light-danger p-2 text-uppercase px-3 border-0">
                                                    <i class='bx bxs-circle me-1'></i>Non-conforme
                                                </div>
                                                @endif
                                            </td>
                                            <td>{{ $InPerMonth->product->entrepot->nom ?? '--'}}</td>
                                            <td>{{ $InPerMonth->created_at->diffForHumans() }}</td>
                                            <td>{{ $InPerMonth->user->name.' '.$InPerMonth->user->lastname }}</td>
                                        </tr>
                                        @empty
                                        <span>Aucune reception</span>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-12 col-lg-4 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0 text-uppercase">etat des importations</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
                                    class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="button-container row col-12 d-flex justify-content-between mx-1">
                        <button class="rounded-button active col-6 mx-0" id="etatMensuelBtn"
                            onclick="toggleDisplayEtat('blockMensueletat')">Mensuel</button>
                        <button class="rounded-button col-6 mx-0" id="etatHebdoBtn"
                            onclick="toggleDisplayEtatHebdo('blockHebdoetat')">Hebdomadaire</button>
                    </div>
                    <div class="content" id="blockMensueletat">
                        <div class="col-12">
                            <div class="card radius-10 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0">Total Sourcing</p>
                                            <h5 class="mb-0">{{ $sourcingPerMonths->count() }}</h5>
                                        </div>
                                        <div class="ms-auto">
                                            <i class='bx bx-cart font-30'></i>
                                        </div>
                                    </div>
                                    <div class="progress radius-10 mt-2" style="height: 4.5px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: {{ $percentageSourcingsPerMonth }}%"></div>
                                    </div>
                                    <div class="mt-1">
                                        <p class="mb-0">Pourcentage :
                                            {{ number_format($percentageSourcingsPerMonth, 0) }}%</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-12">
                            <div class="card radius-10 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0">En Attente de livraison</p>
                                            <h5 class="mb-0">
                                                {{ $sourcingPerMonths->where('statut', 'odlivraison')->count() }}</h5>
                                        </div>
                                        <div class="ms-auto"><i class='bx bx-cart font-30'></i>
                                        </div>
                                    </div>
                                    <div class="progress radius-10 mt-2" style="height:4.5px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: {{ $percenSourcWaitLivrPerMonth }}%"></div>
                                    </div>
                                    <div class="mt-1">
                                        <p class="mb-0">Represente :
                                            {{ number_format($percenSourcWaitLivrPerMonth, 0) }}%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 py-0">
                            <div class="card radius-10 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0">Reçu/Stocké</p>
                                            <h5 class="mb-0">{{ $sourcingReceive->count() }}</h5>
                                        </div>
                                        <div class="ms-auto"> <i class='bx bx-cart font-30'></i>
                                        </div>
                                    </div>
                                    <div class="progress radius-10 mt-2" style="height:4.5px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: {{ $percenReceivMonth }}%"></div>
                                    </div>
                                    <div class="mt-1">
                                        <p class="mb-0">Represente : {{ number_format($percenReceivMonth, 0) }}%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content" id="blockHebdoetat" style="display: none">
                        <div class="col-12">
                            <div class="card radius-10 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0">Total Sourcing</p>
                                            <h5 class="mb-0">{{ $countSourcingPerWeekly }}</h5>
                                        </div>
                                        <div class="ms-auto"> <i class='bx bx-cart font-30'></i>
                                        </div>
                                    </div>
                                    <div class="progress radius-10 mt-2" style="height: 4.5px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: {{ $percentageSourcingsPerWekly }}%"></div>
                                    </div>
                                    <div class="mt-1">
                                        <p class="mb-0">Pourcentage :
                                            {{ number_format($percentageSourcingsPerWekly, 0) }}%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card radius-10 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0">En Attente de livraison</p>
                                            <h5 class="mb-0">
                                                {{ $sourcingPerWekly->where('statut', 'odlivraison')->count() }}</h5>
                                        </div>
                                        <div class="ms-auto"> <i class='bx bx-cart font-30'></i>
                                        </div>
                                    </div>
                                    <div class="progress radius-10 mt-2" style="height: 4.5px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: {{ $percWaitSourPerWekly }}%"></div>
                                    </div>
                                    <div class="mt-1">
                                        <p class="mb-0">Pourcentage : {{ number_format($percWaitSourPerWekly, 0) }}%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card radius-10 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0">Reçu/Stocké</p>
                                            <h5 class="mb-0">{{ $sourcingReceivePerWekly->count() }}</h5>
                                        </div>
                                        <div class="ms-auto"> <i class='bx bx-cart font-30'></i>
                                        </div>
                                    </div>
                                    <div class="progress radius-10 mt-2" style="height:4.5px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: {{ $percentagereceivPerWekly }}%"></div>
                                    </div>
                                    <div class="mt-1">
                                        <p class="mb-0">Represente : {{ number_format($percentagereceivPerWekly, 0) }}%
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--fin de la ligne-->


    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="fm-search">
                    <div class="mb-4">
                        <strong class="text-uppercase">export</strong>
                    </div>
                </div>
                <hr>
                <div class="">
                    <div class="col-12 col-lg-12">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3">
                                    <div class="col">
                                        <div class="card radius-10 overflow-hidden mb-0 shadow-none border">
                                            <div class="card-body cursor-pointer" data-bs-toggle="modal"
                                                data-bs-target="#showAllExportModal">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <p class="mb-0 text-secondary font-14 text-uppercase">Total
                                                            d'expedition</p>
                                                        <h5 class="my-0">{{ $nbrTotalExpedition->count() }}</h5>
                                                    </div>
                                                    <div class="text-primary ms-auto font-30"><i
                                                            class='bx bx-cart-alt'></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card radius-10 overflow-hidden mb-0 shadow-none border">
                                            <div class="card-body cursor-pointer" data-bs-toggle="modal"
                                                data-bs-target="#showActifExportModal">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <p class="mb-0 text-secondary font-14 text-uppercase">Total
                                                            d'expedition Actif</p>
                                                        <h5 class="my-0">{{ $nbrTotalExpeditionActif->count() }}</h5>
                                                    </div>
                                                    <div class="text-primary ms-auto font-30"><i
                                                            class='bx bx-cart-alt'></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card radius-10 overflow-hidden mb-0 shadow-none border">
                                            <div class="card-body cursor-pointer" data-bs-toggle="modal"
                                                data-bs-target="#showStartedDocModal">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <p class="mb-0 text-secondary font-14 text-uppercase">Demarrage
                                                            Document</p>
                                                        <h5 class="my-0">{{ $nbrExpeditionToDocValidate->count() }}</h5>
                                                    </div>
                                                    <div class="text-danger ms-auto font-30">
                                                        <i class='bx bx-file'></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card radius-10 overflow-hidden mb-0 shadow-none border">
                                            <div class="card-body cursor-pointer" data-bs-toggle="modal"
                                                data-bs-target="#inTransitExportModal">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <p class="mb-0 text-secondary font-14 text-uppercase">En transit
                                                            export</p>
                                                        <h5 class="my-0">{{ $nbrExpeditionStarted->count() }}</h5>
                                                    </div>
                                                    <div class="text-success ms-auto font-30">
                                                        <i class='bx bx-group'></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card radius-10 overflow-hidden mb-0 shadow-none border">
                                            <div class="card-body cursor-pointer" data-bs-toggle="modal"
                                                data-bs-target="#inExpeditionExportModal">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <p class="mb-0 text-secondary font-14 text-uppercase">En cours
                                                            d'expedition</p>
                                                        <h5 class="my-0">{{ $nbrExpeditionWaitExpedite->count() }}</h5>
                                                    </div>
                                                    <div class="text-warning ms-auto font-30"><i class='bx bx-beer'></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card radius-10 overflow-hidden mb-0 shadow-none border">
                                            <div class="card-body cursor-pointer" data-bs-toggle="modal"
                                                data-bs-target="#deliveredExportModal">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <p class="mb-0 text-secondary font-14 text-uppercase">
                                                            Livré/Expedié</p>
                                                        <h5 class="my-0">{{ $nbrExpeditionExpedier->count() }}</h5>
                                                    </div>
                                                    <div class="text-success ms-auto font-30">
                                                        <i class='bx bx-check-circle'></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!--end row-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-8 d-flex">
                                <div class="card radius-10 w-100">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="mb-0 text-uppercase">expedition</h6>
                                            </div>
                                            <div class="dropdown ms-auto">
                                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                                    data-bs-toggle="dropdown"><i
                                                        class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center ms-auto font-13 gap-2 mb-3"
                                            id="switchBtnExportGroup">
                                            <span class="border px-2 rounded cursor-pointer active" id="btnGlobalExp"
                                                onclick="toggleDisplayBlockExpAll('blockGlobalExp')"><i
                                                    class="bx bxs-circle me-1" style="color: #14abef"></i>Global</span>
                                            <span class="border px-2 rounded cursor-pointer" id="btnMensuelExp"
                                                onclick="toggleDisplayBlockExpMensuel('blockMensuelExp')"><i
                                                    class="bx bxs-circle me-1" style="color: #ffc107"></i>Mensuel</span>
                                        </div>
                                        <div class="mx-0 px-0" id="blockGlobalExp">
                                            <div class="mb-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">
                                                        <p class="mb-2">Attente de validation des documents<span
                                                                class="float-end">{{ $percentageExpGlobal }}%</span></p>
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar bg-gradient-ibiza"
                                                                role="progressbar"
                                                                style="width: {{ $percentageExpGlobal }}%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">
                                                        <p class="mb-2">En Transit<span
                                                                class="float-end">{{ $percentageExpTransit }}%</span>
                                                        </p>
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar bg-gradient-deepblue"
                                                                role="progressbar"
                                                                style="width: {{ $percentageExpTransit }}%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">
                                                        <p class="mb-2">En Cours d'Expedition<span
                                                                class="float-end">{{ $percentageExpWaitExp }}%</span>
                                                        </p>
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar bg-gradient-ohhappiness"
                                                                role="progressbar"
                                                                style="width: {{ $percentageExpWaitExp }}%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="d-flex align-items-center">

                                                    <div class="flex-grow-1">
                                                        <p class="mb-2">Expedié/Livré au client <span
                                                                class="float-end">{{ $percentageExpDelivered }}%</span>
                                                        </p>
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar bg-gradient-orange"
                                                                role="progressbar"
                                                                style="width: {{ $percentageExpDelivered }}%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mx-0 px-0" id="blockMensuelExp" style="display: none">
                                            <div class="mb-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">
                                                        <p class="mb-2">Attente de validation des documents <sup
                                                                class="badge rounded-pill bg-gradient-ibiza">{{ $allExpWaitValidatePerMonth->count() }}</sup>
                                                            <span
                                                                class="float-end">{{ $percentageExpWaitDocMensuel }}%</span>
                                                        </p>
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar bg-gradient-ibiza"
                                                                role="progressbar"
                                                                style="width: {{ $percentageExpWaitDocMensuel }}%">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">
                                                        <p class="mb-2">En Transit<sup
                                                                class="badge rounded-pill bg-gradient-deepblue">{{ $countExpDemarrerPerMonth }}</sup><span
                                                                class="float-end">{{ $percentageExpDemarrerMensuel }}%</span>
                                                        </p>
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar bg-gradient-deepblue"
                                                                role="progressbar"
                                                                style="width: {{ $percentageExpDemarrerMensuel }}%">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">
                                                        <p class="mb-2">En Cours d'Expedition <sup
                                                                class="badge rounded-pill bg-gradient-ohhappiness">{{ $countExpWaitingPerMonth }}</sup><span
                                                                class="float-end">{{ $percentageExpWaitingMensuel }}%</span>
                                                        </p>
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar bg-gradient-ohhappiness"
                                                                role="progressbar"
                                                                style="width: {{ $percentageExpWaitingMensuel }}%">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="d-flex align-items-center">

                                                    <div class="flex-grow-1">
                                                        <p class="mb-2">Expedié/Livré au client <sup
                                                                class="badge rounded-pill bg-gradient-orange">{{ $countExpReadyPerMonth }}</sup>
                                                            <span
                                                                class="float-end">{{ $percentageExpReadyMensuel }}%</span>
                                                        </p>
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar bg-gradient-orange"
                                                                role="progressbar"
                                                                style="width: {{ $percentageExpReadyMensuel }}%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
                                        <div class="col">
                                            <div class="p-3">
                                                <h5 class="mb-0">{{ $averageDelayExpedite }} /jour</h5>
                                                <small class="mb-0">Delais Moyen de transit </small>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="p-3">
                                                @if ($latestExpedition != null)
                                                <h5 class="mb-0">
                                                    {{ Carbon\Carbon::parse($latestExpedition->date_liv)->format('d/m/Y')}}
                                                </h5>
                                                @else
                                                <h5 class="mb-0">--</h5>
                                                @endif
                                                <small class="mb-0">Date de la prochaine Expedition</small> <br>

                                                @if ($latestExpedition != null)
                                                    @if (Carbon\Carbon::parse($firstLatestExpedition) < Carbon\Carbon::now())
                                                        <span class="text-danger">
                                                            <i class="lni lni-alarm-clock me-1 size_12"></i>
                                                            {{ Carbon\Carbon::parse($firstLatestExpedition)->diffInDays() }}
                                                            <span>jours de retard</span> <br>

                                                            {{-- affichage du status sous la date du prochain livraison --}}

                                                            @if ($latestExpedition->statut == 'draft')
                                                                <span class="badge bg-secondary text-secondary-light">Brouillon</span>
                                                            @endif
                                                            @if ($latestExpedition->statut == 'started')
                                                                <span class="badge bg-warning text-warning-light">Demarrage</span>
                                                            @endif
                                                            @if ($latestExpedition->statut == 'startedDoc')
                                                                <span class="badge bg-primary text-primary-light">Demarrage Documennt</span>
                                                            @endif
                                                            @if ($latestExpedition->statut == 'odTransit')
                                                                <span class="badge bg-info text-info-light">Ordre de transit</span>
                                                            @endif
                                                            @if ($latestExpedition->statut == 'odTransport')
                                                                <span class="badge bg-danger text-danger-light">Ordre de transport</span>
                                                            @endif
                                                            @if ($latestExpedition->statut == 'outStock')
                                                                <span class="badge bg-info text-info-light">Destockage</span>
                                                            @endif
                                                            @if ($latestExpedition->statut == 'wait_exp')
                                                                <span class="badge bg-success text-success-light">En cours d'export</span>
                                                            @endif
                                                            @if ($latestExpedition->statut == 'livered')
                                                                <span class="badge bg-success text-success-light">Livré</span>
                                                            @endif
                                                            @if ($latestExpedition->statut == 'facturer')
                                                                <span class="badge bg-success text-success-light  ">Facturer</span>
                                                            @endif
                                                        </span>
                                                    @else
                                                        <span class="text-success">
                                                            <i class="lni lni-alarm-clock me-1 size_12"></i>
                                                                {{ $resultDate }}
                                                        </span> <br>

                                                            @if ($latestExpedition->statut == 'draft')
                                                                <span class="badge bg-secondary text-secondary-light">Brouillon</span>
                                                            @endif
                                                            @if ($latestExpedition->statut == 'started')
                                                                <span class="badge bg-warning text-warning-light">Demarrage</span>
                                                            @endif
                                                            @if ($latestExpedition->statut == 'startedDoc')
                                                                <span class="badge bg-primary text-primary-light">Demarrage Documennt</span>
                                                            @endif
                                                            @if ($latestExpedition->statut == 'odTransit')
                                                                <span class="badge bg-info text-info-light">Ordre de transit</span>
                                                            @endif
                                                            @if ($latestExpedition->statut == 'odTransport')
                                                                <span class="badge bg-danger text-danger-light">Ordre de transport</span>
                                                            @endif
                                                            @if ($latestExpedition->statut == 'outStock')
                                                                <span class="badge bg-info text-info-light">Destockage</span>
                                                            @endif
                                                            @if ($latestExpedition->statut == 'wait_exp')
                                                                <span class="badge bg-success text-success-light">En cours d'export</span>
                                                            @endif
                                                            @if ($latestExpedition->statut == 'livered')
                                                                <span class="badge bg-success text-success-light">Livré</span>
                                                            @endif
                                                            @if ($latestExpedition->statut == 'facturer')
                                                                <span class="badge bg-success text-success-light  ">Facturer</span>
                                                            @endif
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="p-3">
                                                <h5 class="mb-0">{{ $averageDelayTransport }} /jour</h5>
                                                <small class="mb-0">Delais Moyen de Transporteur</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="card radius-10 w-100">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="mb-0">Rapport d'expedition</h6>
                                            </div>
                                            <div class="dropdown ms-auto">
                                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                                    data-bs-toggle="dropdown"><i
                                                        class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container-2">
                                            <canvas id="chart2"></canvas>
                                        </div>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li
                                            class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                                            En Attente de validation Documentaire<span
                                                class="badge bg-gradient-ibiza rounded-pill">{{ $nbrExpeditionToDocValidate->count() }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                            En Transit <span
                                                class="badge bg-gradient-deepblue rounded-pill">{{ $nbrExpeditionStarted->count() }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                            En Livraison <span
                                                class="badge bg-gradient-deepblue rounded-pill">{{ $nbrExpeditionLivraison->count() }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                            En cours d'Expedition <span
                                                class="badge bg-gradient-ohhappiness rounded-pill">{{ $nbrExpeditionWaitExpedite->count() }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                            Livré/Expedié <span
                                                class="badge bg-gradient-orange text-white rounded-pill">{{ $nbrExpeditionExpedier->count() }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
                <!--end row-->

                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">Les (5) plus Recents</h5>
                    </div>
                    <div class="ms-auto"><a href="{{ route('admin.odre_expedition.index') }}"
                            class="btn btn-sm btn-outline-secondary">Voir Tous</a>
                    </div>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-striped table-hover table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Numero <i class='bx bx-up-arrow-alt ms-2'></i>
                                </th>
                                <th>Clients</th>
                                <th>Lieu de livraison</th>
                                <th>Date de livraison</th>
                                <th>Statut</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentExpedition as $item)
                            <tr>
                                <td>
                                    {{ $item->num_exp }}
                                </td>
                                <td>{{ $item->client->raison_sociale ?? 'N/A' }}</td>
                                <td>{{ $item->lieu_liv }}</td>
                                <td>{{ Carbon\Carbon::parse($item->date_liv)->format('d/m/Y') }}</td>
                                <td>
                                    @if ($item->statut == 'draft')
                                            <span class="badge bg-secondary text-secondary-light px-3 py-1">Brouillon</span>
                                        @endif
                                        @if ($item->statut == 'started')
                                            <span class="badge bg-warning text-warning-light px-3 py-1">Demarrage</span>
                                        @endif
                                        @if ($item->statut == 'startedDoc')
                                            <span class="badge bg-primary text-primary-light px-3 py-1">Demarrage Documennt</span>
                                        @endif
                                        @if ($item->statut == 'odTransit')
                                            <span class="badge bg-info text-info-light px-3 py-1">Ordre de transit</span>
                                        @endif
                                        @if ($item->statut == 'odTransport')
                                            <span class="badge bg-danger text-danger-light px-3 py-1">Ordre de transport</span>
                                        @endif
                                        @if ($item->statut == 'outStock')
                                            <span class="badge bg-info text-info-light px-3 py-1">Destockage</span>
                                        @endif
                                        @if ($item->statut == 'wait_exp')
                                            <span class="badge bg-success text-success-light px-3 py-1">En cours d'export</span>
                                        @endif
                                        @if ($item->statut == 'livered')
                                            <span class="badge bg-success text-success-light px-3 py-1">Livré</span>
                                        @endif
                                        @if ($item->statut == 'facturer')
                                            <span class="badge bg-success text-success-light px-3 py-1">Facturer</span>
                                        @endif
                                </td>
                            </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-none">
        <div class="col-12 col-lg-8 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0 text-uppercase">export</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
                                    class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center ms-auto font-13 gap-2 mb-3">
                        <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                style="color: #14abef"></i>Ordre d'expédition</span>
                        <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                style="color: #ffc107"></i>Ordre de transite</span>
                        <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                style="color: #ff7220"></i>Ordre de transport</span>
                    </div>
                    <div
                        class="row row-cols-1 mt-3 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top border-bottom">
                        <div class="col">
                            <div class="p-3">
                                <h5 class="mb-0">{{ round($averageDelaySourcing, 2) }} /jours <i
                                        class="bx bx-up-arrow-alt align-middle"></i></h5>
                                <small class="mb-0">Temps moyen de validation des documents</small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="py-1 px-3 ">
                                <h5 class="mb-0">{{ $sourcingPerMonths->count() }}</h5>
                                <small class="mb-0">Sourcing / mois</small>
                            </div>
                            <hr>
                            <div class="px-3 py-1">
                                <h5 class="mb-0">{{ $sourcingInValidatPerMonth->count() }}</h5>
                                <small class="mb-0">En attente de validation / mois</small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3">
                                <small class="text-success">Sourcing Reçu/Stocké</small>
                                <h6 class="mb-0 text-success size_14">{{ $sourcingReceive->count() }}</h6>
                                <small class="mb-0">Moyenne de produit conforme reçu<span class="text-success"> <i
                                            class="bx bx-up-arrow-alt align-middle text-success"></i>{{ $percentageConform }}
                                        %</span></small>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container-1 overflow-y-auto overflow-x-hidden">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr style="font-size: 10px">
                                        <th>Code</th>
                                        <th>produits</th>
                                        <th>Statut</th>
                                        <th>Date De depart</th>
                                        <th>Date d'arrivée</th>
                                        <th>Publier par</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sourcingPerMonths as $sourcing)
                                    <tr>
                                        <td>{{ $sourcing->code }}</td>
                                        <td>{{ $sourcing->products->count() }}</td>

                                        {{-- <td>
                                                <span class="badge bg-gradient-quepal text-white shadow-sm w-100">{{ $sourcing->statut }}</span>
                                        </td> --}}
                                        <td>
                                            @if ($sourcing->statut == "draft")
                                            <div
                                                class="badge rounded-pill text-light bg-secondary p-2 text-uppercase px-3 border-0">
                                                <i class='bx bxs-circle me-1'></i>Brouillon
                                            </div>
                                            @endif
                                            @if ($sourcing->statut == "validateDoc")
                                            <div
                                                class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3 border-0">
                                                <i class='bx bxs-circle me-1'></i>Validation Doc
                                            </div>
                                            @endif
                                            @if ($sourcing->statut == "started")
                                            <div
                                                class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3 border-0">
                                                <i class='bx bxs-circle me-1'></i>Demarrer
                                            </div>
                                            @endif
                                            @if ($sourcing->statut == "waitLivraison")
                                            <div
                                                class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3 border-0">
                                                <i class='bx bxs-circle me-1'></i>Attente de livraison
                                            </div>
                                            @endif
                                            @if ($sourcing->statut == "stocked")
                                            <div
                                                class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3 border-0">
                                                <i class='bx bxs-circle me-1'></i>Reçu / Stocké
                                            </div>
                                            @endif

                                        </td>
                                        <td>{{ Carbon\Carbon::parse($sourcing->date_depart)->format('d/m/Y') }}</td>
                                        <td>{{ Carbon\Carbon::parse($sourcing->date_arriver)->format('d/m/Y') }}</td>
                                        <td>{{ $sourcing->created_by }}</td>
                                    </tr>
                                    @empty
                                    <span>Aucun sourcing</span>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-12 col-lg-4 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0 text-uppercase">etat des exportations</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
                                    class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Autre action</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Autre chose ici</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="button-container row col-12 d-flex justify-content-between mx-1">
                        <button class="rounded-button active col-6 mx-0" id="etatMensuelBtn">Mensuel</button>
                        <button class="rounded-button col-6 mx-0" id="etatHebdoBtn">Hebdomadaire</button>
                    </div>
                    <div class="content" id="blockMensueletat">
                        <div class="col-12">
                            <div class="card radius-10 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0">Total Sourcing</p>
                                            <h5 class="mb-0">{{ $sourcingPerMonths->count() }}</h5>
                                        </div>
                                        <div class="ms-auto">
                                            <i class='bx bx-cart font-30'></i>
                                        </div>
                                    </div>
                                    <div class="progress radius-10 mt-2" style="height: 4.5px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: {{ $percentageSourcingsPerMonth }}%"></div>
                                    </div>
                                    <div class="mt-1">
                                        <p class="mb-0">Pourcentage :
                                            {{ number_format($percentageSourcingsPerMonth, 0) }}%</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-12">
                            <div class="card radius-10 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0">En Attente de livraison</p>
                                            <h5 class="mb-0">
                                                {{ $sourcingPerMonths->where('statut', 'waitLivraison')->count() }}</h5>
                                        </div>
                                        <div class="ms-auto"><i class='bx bx-cart font-30'></i>
                                        </div>
                                    </div>
                                    <div class="progress radius-10 mt-2" style="height:4.5px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: {{ $percenSourcWaitLivrPerMonth }}%"></div>
                                    </div>
                                    <div class="mt-1">
                                        <p class="mb-0">Represente :
                                            {{ number_format($percenSourcWaitLivrPerMonth, 0) }}%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 py-0">
                            <div class="card radius-10 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0">Reçu/Stocké</p>
                                            <h5 class="mb-0">{{ $sourcingReceive->count() }}</h5>
                                        </div>
                                        <div class="ms-auto"> <i class='bx bx-cart font-30'></i>
                                        </div>
                                    </div>
                                    <div class="progress radius-10 mt-2" style="height:4.5px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: {{ $percenReceivMonth }}%"></div>
                                    </div>
                                    <div class="mt-1">
                                        <p class="mb-0">Represente : {{ number_format($percenReceivMonth, 0) }}%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content d-none" id="blockHebdoetat">
                        <div class="col-12">
                            <div class="card radius-10 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0">Total Sourcing</p>
                                            <h5 class="mb-0">867</h5>
                                        </div>
                                        <div class="ms-auto"> <i class='bx bx-cart font-30'></i>
                                        </div>
                                    </div>
                                    <div class="progress radius-10 mt-4" style="height:4.5px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 46%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card radius-10 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0">Total Orders</p>
                                            <h5 class="mb-0">867</h5>
                                        </div>
                                        <div class="ms-auto"> <i class='bx bx-cart font-30'></i>
                                        </div>
                                    </div>
                                    <div class="progress radius-10 mt-4" style="height:4.5px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 46%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card radius-10 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0">Total Orders</p>
                                            <h5 class="mb-0">867</h5>
                                        </div>
                                        <div class="ms-auto"> <i class='bx bx-cart font-30'></i>
                                        </div>
                                    </div>
                                    <div class="progress radius-10 mt-4" style="height:4.5px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 46%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- facture prestataire --}}
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="fm-search">
                    <div class="mb-0">
                        <strong class="text-uppercase">Facture Prestataire</strong>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 mt-4">
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-4 border-info">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total des Factures</p>
                                        <h4 class="my-1 text-info size_12">
                                            {{ number_format($valeurallFactByPrestationActif, 0, ',', ' ') }} Fcfa
                                        </h4>
                                        <p class="mb-0 font-13 size_12">
                                            {{ $totalallFactByPrestationActifCount }}
                                            @if ($totalallFactByPrestationActifCount > 0)
                                                Factures
                                            @else
                                                Facture
                                            @endif
                                        </p>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                            class='bx bxs-cart'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-4 border-danger">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Bon à Payer</p>
                                        <h4 class="my-1 text-danger size_12">
                                            {{ number_format($valeur_bon_a_payer, 0, ',', ' ') }} Fcfa
                                        </h4>
                                        <p class="mb-0 font-13 size_12">{{ $facture_bon_a_payer_count }} Facture</p>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto">
                                        <i class='bx bxs-wallet'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-4 border-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">

                                    <div>
                                        <p class="mb-0 text-secondary">Payée</p>
                                        <h4 class="my-1 text-success size_12">{{ number_format($valeur_payer, 0, ',', ' ') }}
                                            Fcfa
                                        </h4>
                                        <p class="mb-0 font-13 size_12">{{ $facture_payer_count }} Facture</p>
                                    </div>
                                    <div
                                        class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                        <i class='bx bxs-bar-chart-alt-2'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-4 border-warning">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>

                                        <p class="mb-0 text-secondary">Rejeter</p>
                                        <h4 class="my-1 text-warning size_12">{{ number_format($valeur_canceled, 0, ',', ' ') }}
                                            Fcfa
                                        </h4>
                                        <p class="mb-0 font-13 size_12">{{ $facture_canceled_count }} Facture
                                            @if($facture_canceled_count > 0)s @endif
                                        </p>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
                                            class='bx bxs-group'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-4 border-warning">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Factures Echues</p>
                                        <h4 class="my-1 text-warning size_12">{{ number_format($valeur_facturePrestataireEchu, 0, ',', ' ') }}
                                            Fcfa
                                        </h4>
                                        @if($facturePrestataireEchuCount > 1)
                                            <p class="mb-0 font-13">{{ $facturePrestataireEchuCount }} Factures</p>
                                        @else
                                        <p class="mb-0 font-13">{{ $facturePrestataireEchuCount }} Facture</p>
                                        @endif
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-danger text-white ms-auto">
                                        <i class='bx bxs-time-five'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--fin de la ligne-->
                <div class="row">
					<div class="col-12 col-lg-12 d-flex">
						<div class="card radius-10 w-100">
							<div class="card-body">
								<div class="d-flex align-items-center ms-auto font-13 gap-2 mb-3">
									<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
											style="color: #14abef"></i>Prestataire</span>
									<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
											style="color: #07ff5e"></i>Payer</span>
								</div>
								<div class="chart-container-1">
									<canvas id="chartPrestataire"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>
                <!--end row-->
                <div class="card radius-10">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Dernières Facture Prestataire</h6>
                            </div>
                            <div class="dropdown ms-auto">
                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                                    <i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Code</th>
                                        <th>Beneficiaire</th>
                                        <th>Statut</th>
                                        <th>Montant</th>
                                        <th>Date</th>
                                        <th>Creer Par</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($factures as $facture )
                                        @if (!empty ($facture->prestationLines))
                                            <tr>
                                                <td>{{ $facture->code ?? 'N/A'}}</td>
        
                                                <td>
                                                    @if ($facture->typeFacture == 'transitaire')
                                                    {{ $facture->transitaire->raison_sociale ?? 'N/A' }}
                                                    @elseif ($facture->typeFacture == 'transporteur')
                                                    {{ $facture->transporteur->raison_sociale ?? 'N/A' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($facture->statut == 'reccording')
                                                    <div
                                                        class="badge rounded-pill text-light bg-primary p-2 text-uppercase px-3">
                                                        <i class='bx bxs-circle me-1'></i> Enregistrement
                                                    </div>
                                                    @endif
                                                    @if ($facture->statut == 'good_pay')
                                                    <div
                                                        class="badge rounded-pill text-light bg-danger p-2 text-uppercase px-3">
                                                        <i class='bx bxs-circle me-1'></i> Bon à Payé
                                                    </div>
                                                    @endif
                                                    @if ($facture->statut == 'payed')
                                                    <div
                                                        class="badge rounded-pill text-light bg-gradient-quepal p-2 text-uppercase px-3">
                                                        <i class='bx bxs-circle me-1'></i> Payé
                                                    </div>
                                                    @endif
                                                    @if ($facture->statut == 'cancel')
                                                    <div
                                                        class="badge rounded-pill text-light bg-gradient-blooker p-2 text-uppercase px-3">
                                                        <i class='bx bxs-circle me-1'></i> Rejeter
                                                    </div>
                                                    @endif
                                                </td>
        
                                                <td>
                                                    {{ number_format($facture->prestationLines->sum('totalLigne'), 0, ',', ' ') }}Fcfa
                                                </td>
                                                <td>{{ $facture->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                    @if (!empty($facture->create_by->name) &&
                                                    !empty($facture->create_by->lastname))
                                                    {{ $facture->create_by->name . ' ' . $facture->create_by->lastname }}
                                                    @else
                                                    N/A
                                                    @endif
                                                </td>
                                            </tr>
                                        @else
                                            
                                        @endif
                                    
                                    @empty


                                    @endforelse


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- facture fournisseur refacturation --}}

    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="fm-search row">
                    <div class="mb-0 col-lg-10">
                        <strong class="text-uppercase">Facture Fournisseur</strong>
                    </div>
                    <div class="text-end col-lg-2">
                        <a href="{{ route('admin.refacturation') }}" class="text-outline-primary">Voir plus <i class="bx bx-right-arrow-alt"></i></a>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 mt-4">
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-4 border-info">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Valeur Total des Factures</p>
                                        <h4 class="my-1 text-info size_12">
                                            {{ number_format($valeurTotals, 0, ',', ' ') }} Fcfa
                                        </h4>
                                        <p class="mb-0 font-13 size_12">{{ $totalRefacturcount }}
                                            @if ($totalRefacturcount > 1)
                                            Factures
                                            @else
                                            Facture
                                            @endif
                                        </p>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                            class='bx bxs-cart'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-4 border-info">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Envoyé au Client</p>
                                        <h4 class="my-1 text-info size_12">
                                            {{ number_format($valeurTotalsSending, 0, ',', ' ') }} Fcfa
                                        </h4>
                                        <p class="mb-0 font-13 size_12">{{ $totalSendingCount }} Facture</p>
                                    </div>
                                    <div
                                        class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                        <i class='bx bxs-envelope'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-4 border-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Payé</p>
                                        <h4 class="my-1 text-success size_12">
                                            {{ number_format($valeurTotalsPayed, 0, ',', ' ') }} Fcfa
                                        </h4>
                                        <p class="mb-0 font-13 size_12">{{ $totalPayedCount }} Facture</p>
                                    </div>
                                    <div
                                        class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                        <i class='bx bxs-wallet'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-4 border-warning">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Rejeter</p>
                                        <h4 class="my-1 text-warning size_12">
                                            {{ number_format($valeurTotalsRejeter, 0, ',', ' ') }} Fcfa
                                        </h4>
                                        <p class="mb-0 font-13 size_12">{{ $totalRejetedCount }} Facture @if ($totalRejetedCount
                                            >
                                            1)s
                                            @endif</p>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto">
                                        <i class='bx bxs-x-circle'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary ">Factures échues non réglées</p>
                                        <h4 class="my-1 size_12">{{ number_format($valeur_factureEchu, 0, ',', ' ') }} Fcfa</h4>
                                        <p class="mb-0 font-13 text-danger size_12"><i class='bx bxs-down-arrow align-middle'></i>{{ $factureEchuCount}} factures</p>
                                    </div>
                                    <div class="widgets-icons bg-light-warning text-warning ms-auto"><i class='bx bx-line-chart-down'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary ">Total Debours</p>
                                        <h4 class="my-1 size_12">{{ number_format($valeurTotalDebou, 0, ',', ' ') }} Fcfa</h4>
                                        <p class="mb-0 font-13 text-info size_12"><i class='bx bxs-down-arrow align-middle'></i>{{ $totalFactDebou}} Debours</p>
                                        
                                    </div>
                                    <div class="widgets-icons bg-light-info text-info ms-auto"><i class='bx bx-line-chart-down'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary ">Total Prestations</p>
                                        <h4 class="my-1 size_12">{{ number_format($valeurTotalPrestation, 0, ',', ' ') }} Fcfa</h4>
                                        <p class="mb-0 font-13 text-info size_12"><i class='bx bxs-down-arrow align-middle'></i>{{ $totalFactPrestation}} Prestation</p>
                                        
                                        
                                    </div>
                                    <div class="widgets-icons bg-light-info text-info ms-auto"><i class='bx bx-line-chart-down'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
					<div class="col-12 col-lg-12 d-flex">
						<div class="card radius-10 w-100">
							<div class="card-body">
								<div class="d-flex align-items-center ms-auto font-13 gap-2 mb-3">
									<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
											style="color: #14abef"></i>Fournisseurs</span>
									<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
											style="color: #ffc107"></i>Debours</span>
									<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
											style="color: #ff4507"></i>Prestation</span>
								</div>
								<div class="chart-container-1">
									<canvas id="chart5"></canvas>
								</div>
							</div>
							<div
								class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
								<div class="col">
									<div class="p-3">
										<h5 class="mb-0" style="color: #14abef">{{ number_format($facturesFournisseurActives->sum('total'), '0', ',', ' ')}} XOF</h5>
										<small class="mb-0">Année en cours <span> <i
													class="bx bx-up-arrow-alt align-middle"></i> {{ $facturesFournisseurActives->count()}}</span></small>
									</div>
								</div>
								<div class="col">
									<div class="p-3">
										<h5 class="mb-0" style="color: #ffc107">{{ number_format($facturesFournisseurDebours->sum('total'), '0', ',', ' ')}} XOF</h5>
										<small class="mb-0">Année en cours <span> <i
													class="bx bx-up-arrow-alt align-middle"></i> {{ $facturesFournisseurDebours->count()}} </span></small>
									</div>
								</div>
								<div class="col">
									<div class="p-3">
										<h5 class="mb-0" style="color: #ff4507"> {{ number_format($facturesFournisseurPrestation->sum('total'), '0', ',', ' ')}} XOF</h5>
										<small class="mb-0">Année en cours <span> <i
                                            class="bx bx-up-arrow-alt align-middle"></i> {{ $facturesFournisseurPrestation->count()}} </span></small>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
                <!--end row-->
                <div class="card radius-10">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Dernières Factures Fournisseurs</h6>
                            </div>
                            <div class="dropdown ms-auto">
                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                                    <i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>N° Facture</th>
                                        <th>Benefinciaire</th>
                                        <th>Statut</th>
                                        <th>Montant</th>
                                        <th>Echeance</th>
                                        <th>Publier Par</th>
                                        <th>Publier Le</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($lastFacts as $item )
                                    <tr>
                                        <td>{{ $item->num_facture ?? 'N/A'}}</td>

                                        <td>
                                            {{ $item->doit ?? 'N/A' }}
                                        </td>
                                        <td>
                                            @if ($item->statut == 'draft')
                                            <div
                                                class="badge rounded-pill text-light bg-primary p-2 text-uppercase px-3">
                                                <i class='bx bxs-circle me-1'></i> Brouillon
                                            </div>
                                            @endif
                                            @if ($item->statut == 'sendToClient')
                                            <div
                                                class="badge rounded-pill text-light bg-danger p-2 text-uppercase px-3">
                                                <i class='bx bxs-circle me-1'></i>Envoyé
                                            </div>
                                            @endif
                                            @if ($item->statut == 'payed')
                                            <div
                                                class="badge rounded-pill text-light bg-gradient-quepal p-2 text-uppercase px-3">
                                                <i class='bx bxs-circle me-1'></i> Payé
                                            </div>
                                            @endif
                                            @if ($item->statut == 'canceled')
                                            <div
                                                class="badge rounded-pill text-light bg-gradient-blooker p-2 text-uppercase px-3">
                                                <i class='bx bxs-circle me-1'></i> Rejeter
                                            </div>
                                            @endif
                                        </td>
                                        <td>{{ number_format($item->prestations->where('etat', 'actif')->sum('total') ?? 0, 0, ',', ' ') }} Fcfa
                                        </td>

                                        <td @if(Carbon\Carbon::parse($item->date_echeance)->isPast()) class="text-danger" @endif>
                                            {{ Carbon\Carbon::parse($item->date_echeance)->format('d/m/Y') ?? 'N/A' }}
                                        </td>

                                        @if (!empty($item->facturier_uuid))
                                        <td>{{ $item->facturier->name ?? 'N/A' }}
                                            {{ $item->facturier->lastname ?? 'N/A'}}</td>
                                        @endif
                                        <td>{{ $item->created_at->format('d/m/Y') ?? '--'}}</td>

                                    </tr>
                                    @empty


                                    @endforelse


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @dd($totauxPrestataireParMois); --}}
    <div class="modal fade" id="nextArrivageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize">Prochaine arrivée de Marchandise</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <hr />
                    <div class="">
                        <div class="car-body">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr class="size_12">
                                        <th scope="col">#</th>
                                        <th scope="col">Date d'arrivé</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($nextArrive as $index => $item)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        {{-- <td>{{ $item->products->numero_serie }}</td> --}}
                                        <td>
                                            <a href="{{ route('admin.sourcing.show', $item->uuid) }}"
                                                class=" text-decoration-none {{ Carbon\Carbon::parse($item->date_arriver)->isPast() ? 'text-danger' : '' }}">
                                                {{ Carbon\Carbon::parse($item->date_arriver)->format('d/m/Y') }}
                                                <span>
                                                    <i class="bx bx-right-arrow-alt align-middle text-success"></i>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3">Aucune arrivée en cours</td>
                                    </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

                </div>
            </div>
        </div>
    </div>

    {{-- Include Modal status --}}
    @include('admin.status.InFabricModal')
    @include('admin.status.sortiUsineModal')
    @include('admin.status.enExpeditionModal')
    @include('admin.status.arriverAuPodModal')
    @include('admin.status.stockedModal')
    @include('admin.status.expEnCoursModal')
    @include('admin.status.deliveredModal')
    {{-- Export --}}
    @include('admin.expedition.status.allExportModal')
    @include('admin.expedition.status.actifExportModal')
    @include('admin.expedition.status.startedDocModal')
    @include('admin.expedition.status.inTransitModal')
    @include('admin.expedition.status.inExpeditionModal')
    @include('admin.expedition.status.deliveredExportModal')
</div>




{{-- <div class="page-content"> --}}

<script>

    // var nbrTotalInStock = {{ $nbrTotalIn }};
    // var nbrConformInStock = {{ $nbrTotalInConform }};
    // var nbrNoConformInStock = {{ $nbrTotalInNoConfrom }};

    var nbrTotalInStock = {{ $InStock->count() }};
    var nbrConformInStock = {{ $conformInStockPerMonth->count() }};
    var nbrNoConformInStock = {{ $noConformInStockPerMonth->count() }};

    var nbrTotalInStockWekly = {{ $nbrTotalOut }};
    var nbrConformInStockWeekly = {{ $nbrTotalOutConform }};
    var nbrNoConformInStockWeekly = {{ $nbrTotalOutNoConfrom }};

    var nbrExpeditionToDocValidate = {{ $nbrExpeditionToDocValidate->count() }};
    var nbrExpeditionStarted = {{ $nbrExpeditionStarted->count() }};
    var nbrExpeditionWaitExpedite = {{ $nbrExpeditionWaitExpedite->count() }};
    var nbrExpeditionExpedier = {{ $nbrExpeditionExpedier->count() }};
    var nbrExpeditionLivraison = {{ $nbrExpeditionLivraison->count() }};
    var inWaitExpediteExport = {{ $inWaitExpediteExport->count() }};


    // ... (Votre code existant pour créer les gradients et définir le graphique)

    var totauxFournisseurParMois = <?php echo json_encode($montantsFournisseurParMois); ?>;
    var totauxFournisseurDeboursParMois = <?php echo json_encode($montantFournisseurDeboursParMois); ?>;
    var totauxFournisseurPrestationParMois = <?php echo json_encode($montantFournisseurPrestationParMois); ?>;
    // facture prestataire graph
    var totauxPrestataireParMois = <?php echo json_encode($montantsPrestataireParMois); ?>;
    var totauxPrestatairePayedParMois = <?php echo json_encode($montantsPrestatairePayedParMois); ?>;
    // Donut interface central d'achat
    var sourcingstarted = {{ $sourcings->where('statut', 'started')->count() }};
    var sourcingWaitDoc = {{ $sourcings->where('statut', 'validateDoc')->count() }};
    var sourcingInTransit = {{ $sourcings->where('statut', 'odTransit')->count() }};
    var sourcingInLivraison = {{ $sourcings->where('statut', 'odlivraison')->count() }};
    var sourcingStocked = {{ $sourcings->whereIn('statut', ['stocked', 'received'])->count() }};

</script>

<script>
    function redirectToInFabrication() {
        window.location.href = "{{ route('admin.inFabrication') }}";
    }

    function redirectToInsortiUsine() {
        window.location.href = "{{ route('admin.insortiUsine') }}";
    }

    function redirectToEnExpedition() {
        window.location.href = "{{ route('admin.enExpedition') }}";
    }

    function redirectToArriverAuPod() {
        window.location.href = "{{ route('admin.arriverAuPod') }}";
    }

    function redirectToStocked() {
        window.location.href = "{{ route('admin.stocked') }}";
    }

    function redirectToExpEnCours() {
        window.location.href = "{{ route('admin.expEnCours') }}";
    }

    function redirectTodelivered() {
        window.location.href = "{{ route('admin.delivered') }}";
    }

</script>



@endsection
