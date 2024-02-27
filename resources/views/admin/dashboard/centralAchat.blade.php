<div class="page-content px-0">
    <div class="row">
        <div class="col-12 col-lg-8 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Suivie des Commandes  /mois en cours</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table table-striped table-bordered mb-0">
                            <thead class="table-light text-uppercase">
                                <tr>
                                    <th>N* Bl</th>
                                    <th>Produits</th>
                                    <th>Date de Depart</th>
                                    <th>Date estimative d'arrivée</th>
                                    <th>Navire</th>
                                    <th>Statut</th>
                                    <th>Publier le</th>
                                    <th>Publier Par</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 12px !important">
                                    @forelse($sourcingsForCentral as $item)
                                        <tr>
                                            <td>
                                                {{ $item->num_bl ?? '--' }}
                                            </td>
                                            <td class="">
                                                <span>{{ $item->products->count() }}</span>
                                            </td>
                                            <td>{{  Carbon\Carbon::parse($item->date_depart)->format('d/m/y') ?? '--' }}</td>
                                            <td>{{ Carbon\Carbon::parse($item->date_arriver)->format('d/m/y') ?? '--' }}</td>
                                            <td>{{ $item->id_navire ?? '--' }}</td>
                                            <td>
                                                @if ($item->statut == "draft")
                                                <div class="badge rounded-pill text-light bg-secondary p-2 text-uppercase px-3 border-0">
                                                    <i class='bx bxs-circle me-1'></i>Brouillon
                                                </div>
                                                @endif
                                                @if ($item->statut == "started")
                                                <div class="badge rounded-pill text-light bg-secondary p-2 text-uppercase px-3 border-0">
                                                    <i class='bx bxs-circle me-1'></i>Demarrage
                                                </div>
                                                @endif
                                                @if ($item->statut == "validateDoc")
                                                <div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3 border-0">
                                                    <i class='bx bxs-circle me-1'></i>Demarrage document
                                                </div>
                                                @endif
                                                @if ($item->statut == "odTransit")
                                                <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3 border-0">
                                                    <i class='bx bxs-circle me-1'></i>En cour de transit import
                                                </div>
                                                @endif
                                                @if ($item->statut == "odlivraison")
                                                <div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3 border-0">
                                                    <i class='bx bxs-circle me-1'></i>en cours de livraison
                                                </div>
                                                @endif
                                                @if ($item->statut == "received")
                                                <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3 border-0">
                                                    <i class='bx bxs-circle me-1'></i>Reçu ||
                                                    <span>{{   $item->products->where('is_received', true)->count()  }}</span> /
                                                    <span>{{ $item->products->count() }}</span>
                                                </div>
                                                @endif
                                                @if ($item->statut == "stocked")
                                                <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3 border-0">
                                                    <i class='bx bxs-circle me-1'></i>Stocké
                                                </div>
                                                @endif
                                            </td>
                                            <td>{{ $item->created_at->format('d/m/y') ?? '--' }}</td>
                                            <td>{{ $item->created_by ?? '--' }}</td>
                                            <td style="max-width: 100px">
                                                <div class="d-flex order-actions text-end justify-content-between">
        
                                                    <a href="{{ route('admin.sourcing.show', $item->uuid) }}" class="bg-transparent col" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Voir"><i class="lni lni-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Aucun sourcing</td>
                                    </tr>
                                    @endforelse
        
                            </tbody>
                        </table>
                    </div>
                </div>
                <div
                    class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
                    {{-- @dd($sourcings) --}}
                    <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">{{ $sourcings->count() }}</h5>
                            <small class="mb-0">Total Sourcings</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">{{ $sourcingsForCentral->count() }}</h5>
                            <small class="mb-0">Sourcing /Mois <span> <i
                                        class="bx bx-up-arrow-alt align-middle"></i> {{ round($percentageSourcingsPerMonth) }}%</span></small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">639.82</h5>
                            <small class="mb-0">Pages/Visit <span> <i
                                        class="bx bx-up-arrow-alt align-middle"></i> 5.62%</span></small>
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
                            <h6 class="mb-0">Etat des commandes</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <div class="">
                            <div id="chartDonut" style="height:250px;"></div>
                        </div>
                     </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li
                        class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                        Demarrer <span class="badge bg-secondary rounded-pill">{{ $sourcings->where('statut', 'started')->count() }}</span>
                    </li>
                    <li
                        class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        Gestion Documentaire <span class="badge bg-info rounded-pill">{{ $sourcings->where('statut', 'validateDoc')->count() }}</span>
                    </li>
                    <li
                        class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        En transit <span class="badge bg-warning rounded-pill">{{ $sourcings->where('statut', 'odTransit')->count() }}</span>
                    </li>
                    <li
                        class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        En Livraison 
                        <span class="badge bg-danger text-white rounded-pill">
                            {{ $sourcings->where('statut', 'odlivraison')->count() }}
                        </span>
                    </li>
                    <li
                        class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        Stocké <span class="badge bg-success text-white rounded-pill">{{ $sourcings->whereIn('statut', ['stocked', 'received'])->count() }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--end row-->
</div>