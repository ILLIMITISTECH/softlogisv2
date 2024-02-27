@extends('admin.layouts.admin')
@section('section')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Marchandise</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Toute La Ligne de Production </li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">

            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!--end row-->

                    <div class="row mt-3">
                        <div class="col-12 col-md-6 col-lg-3 cursor-pointer" id="btnForBlockFilterCat" onclick="tggleFilterBlock('blockCategory')">
                            <div class="card shadow-none border radius-15">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="font-30 text-primary"><i class='bx bxs-folder'></i></div>
                                    </div>
                                    <h6 class="mb-0 text-primary text-uppercase">Categories</h6>
                                    <small>{{ $categories->count() }}
                                        @if ($categories->count() > 1)
                                            Categories
                                        @else
                                            Categorie
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-3 cursor-pointer" id="blockfilteredByMarque" onclick="toggleFilterBoc('blockMarque')">
                            <div class="card shadow-none border radius-15">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="font-30 text-primary"><i class='bx bxs-folder'></i></div>
                                    </div>
                                    <h6 class="mb-0 text-primary text-uppercase">Marques</h6>
                                    <small>{{ $brands->count() }}
                                        @if ($brands->count() > 1)
                                            Marques
                                        @else
                                            Marque
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-3 cursor-pointer" id="blockfilteredByFamille" onclick="toggleFilteBloc('blockFamille')">
                            <div class="card shadow-none border radius-15">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="font-30 text-primary"><i class='bx bxs-folder'></i></div>
                                    </div>
                                    <h6 class="mb-0 text-primary text-uppercase">Familles</h6>
                                    <small>{{ $families->count() }}
                                        @if ($families->count() > 1)
                                            Familles
                                        @else
                                            Famille
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-3 cursor-pointer" id="blockfilteredByStatus" onclick="toggleFilteBlocStatus('blockStatus')">
                            <div class="card shadow-none border radius-15">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="font-30 text-primary"><i class='bx bxs-folder'></i></div>
                                    </div>
                                    <h6 class="mb-0 text-primary text-uppercase">Status</h6>
                                    <small>{{ $statuses->count() }}</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-slider">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 row-cols-xxl-4 content_scrool">

                            @foreach ($allCats as $item)
                            @php
                                $categoryProductsCount = $item->articles->count();
                                $percentage = ($categoryProductsCount / $totalProducts) * 100;
                            @endphp
                            <div class="col">
                                <div class="card radius-10 bg-gradient-cosmic">
                                   <div class="card-body">
                                       <div class="d-flex align-items-center">
                                           <div class="me-auto">
                                               <p class="mb-0 text-white">{{ $item->libelle ?? '--' }}</p>
                                               <h4 class="my-1 text-white">{{ $item->articles->count() }} produits</h4>
                                               <p class="mb-0 font-13 text-white">{{ number_format($item->articles->sum('price_unitaire'), 2, ',', ' ') }} Fcfa</p>
                                           </div>
                                           <div>
                                                <span class="text-white">{{ number_format($percentage, 2, ',', ' ') }}%</span>
                                            </div>
                                           {{-- <div id="chart1"></div> --}}
                                       </div>
                                   </div>
                                </div>
                              </div>
                            @endforeach

                        </div><!--end row-->
                    </div>

                    <div class="container-blockMarque" style="display: none">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 row-cols-xxl-4 content_scrool">

                            @foreach ($allBrands as $item)
                            @php
                                $marqueProductsCount = $item->articles->count();
                                $percentage = ($marqueProductsCount / $totalProductsBybrand) * 100;
                            @endphp
                            <div class="col">
                                <div class="card radius-10 bg-gradient-cosmic">
                                   <div class="card-body">
                                       <div class="d-flex align-items-center">
                                           <div class="me-auto">
                                               <p class="mb-0 text-white">{{ $item->libelle ?? '--' }}</p>
                                               <h4 class="my-1 text-white">{{ $item->articles->count() }} produits</h4>
                                               <p class="mb-0 font-13 text-white">{{ number_format($item->articles->sum('price_unitaire'), 2, ',', ' ') }} Fcfa</p>
                                           </div>
                                           <div>
                                                <span class="text-white">{{ number_format($percentage, 2, ',', ' ') }}%</span>
                                            </div>
                                           {{-- <div id="chart1"></div> --}}
                                       </div>
                                   </div>
                                </div>
                              </div>
                            @endforeach

                        </div><!--end row-->
                    </div>
                    <div class="container-blockFamille" style="display: none">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 row-cols-xxl-4 content_scrool">

                            @foreach ($allFamilies as $item)
                            @php
                                $familyProductsCount = $item->articles->count();
                                $percentage = ($familyProductsCount / $totalProductsByfamily) * 100;
                            @endphp
                            <div class="col">
                                <div class="card radius-10 bg-gradient-cosmic">
                                   <div class="card-body">
                                       <div class="d-flex align-items-center">
                                           <div class="me-auto">
                                               <p class="mb-0 text-white">{{ Str::limit($item->libelle, 25, '...') ?? '--' }}</p>
                                               <h4 class="my-1 text-white">{{ $item->articles->count() }} produits</h4>
                                               <p class="mb-0 font-13 text-white">{{ number_format($item->articles->sum('price_unitaire'), 2, ',', ' ') }} Fcfa</p>
                                           </div>
                                           <div>
                                                <span class="text-white">{{ number_format($percentage, 2, ',', ' ') }}%</span>
                                            </div>
                                           {{-- <div id="chart1"></div> --}}
                                       </div>
                                   </div>
                                </div>
                              </div>
                            @endforeach

                        </div><!--end row-->
                    </div>
                    <div class="container-blockStatus" style="display: none">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 row-cols-xxl-4 content_scrool">

                            @foreach ($groupByStatuses as $item)
                            @php
                                $count = App\Models\Article::where('status', $item)->count();
                                $value = App\Models\Article::where('status', $item)->sum('price_unitaire');
                                $percentage = ($count / App\Models\Article::count()) * 100;
                            @endphp
                            <div class="col">
                                <div class="card radius-10 bg-gradient-cosmic">
                                   <div class="card-body">
                                       <div class="d-flex align-items-center">
                                           <div class="me-auto">
                                               <p class="mb-0 text-white">{{ Str::limit($item, 25, '...') ?? '--' }}</p>
                                               <h4 class="my-1 text-white">{{ $count ?? '--' }} produits</h4>
                                               <p class="mb-0 font-13 text-white">{{ number_format($value, 2, ',', ' ') }} Fcfa</p>
                                           </div>
                                           <div>
                                                <span class="text-white">{{ number_format($percentage, 2, ',', ' ') }}%</span>
                                            </div>
                                           {{-- <div id="chart1"></div> --}}
                                       </div>
                                   </div>
                                </div>
                              </div>
                            @endforeach

                        </div><!--end row-->
                    </div>

                    <!--end row-->
                    <form action="{{ route('admin.allProduction') }}" method="get" class="my-3" id="blockCategory">
                        <div class="input-group" >
                            <label class="input-group-text" for="category">Filtrer par catégorie :</label>
                            <select name="category" id="category" class="form-select">
                                <option value="">Toutes les catégories</option>
                                @foreach ($categories as $uuid => $libelle)
                                    <option value="{{ $libelle }}" {{ $selectedCategory == $libelle ? 'selected' : '' }}>
                                        {{ $libelle ?? '--' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                    <form action="{{ route('admin.allProduction') }}" method="get" class="my-3" id="blockmarque" style="display: none">
                        <div class="input-group">
                            <label class="input-group-text" for="brand">Filtrer par marque :</label>
                            <select name="brand" id="brand" class="form-select">
                                <option value="">Toutes les marques</option>
                                @foreach ($brands as $uuid => $libelle)
                                    <option value="{{ $libelle }}" {{ $selectedBrand == $libelle ? 'selected' : '' }}>
                                        {{ $libelle ?? '--' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>

                    <form action="{{ route('admin.allProduction') }}" method="get" class="my-3" id="blockFamille" style="display: none">
                        <div class="input-group">
                            <label class="input-group-text" for="family">Filtrer par famille :</label>
                            <select name="family" id="family" class="form-select">
                                <option value="">Toutes les familles</option>
                                @foreach ($families as $uuid => $libelle)
                                    <option value="{{ $libelle }}" {{ $selectedFamily == $libelle ? 'selected' : '' }}>
                                        {{ $libelle ?? '--' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                    <form action="{{ route('admin.allProduction') }}" method="get" class="my-3" id="blockStatus" style="display: none">
                        <div class="input-group">
                            <label class="input-group-text" for="status">Filtrer par statut :</label>
                            <select name="status" id="status" class="form-select">
                                <option value="">Tous les statuts</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" {{ $selectedStatus == $status ? 'selected' : '' }}>
                                        {{ $status ?? '--' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <button type="submit" class="btn btn-primary">Filtrer</button> --}}
                    </form>

                    <div class="table-responsive mt-3">
                        <table id="example2" class="table table-hover table-striped table-sm table-bordered">

                            <thead>
                                <tr>
                                    <th>Designation <i class='bx bx-up-arrow-alt ms-2'></i></th>
                                    <th>Marque</th>
                                    <th>Categorie</th>
                                    <th>N° Serie</th>
                                    <th>N° Bon Cmd</th>
                                    <th>Family Group</th>
                                    <th>Model</th>
                                    <th>Status</th>
                                    <th>Valeur (FCFA)</th>
                                    <th>Bill Of Lading</th>
                                    <th>Entrepot</th>
                                    <th>ETA</th>
                                    <th>Date Reception</th>
                                    <th>Date Stockage</th>
                                    <th>Date destockage</th>
                                    <th>Poids Tonne</th>
                                    <th>Hauteur</th>
                                    <th>Largeur</th>
                                    <th>Volume</th>
                                    <th>Longueur</th>
                                    {{-- <th></th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($delivered as $item)
                                
                                    <tr class="articleByCat" data-category_uuid="{{ strtolower($item->category_uuid) }}">
                                        <td><a href="{{ route('admin.article.show', ['uuid' => $item->uuid]) }}" style="text-decoration: none; text-transform: uppercase;">
                                            {{ $item->familly->libelle ?? '--' }}</td></a>
                                        <td>{{ $item->marque->libelle ?? '--' }}</td>
                                        <td>{{ $item->category->libelle ?? '--' }}</td>
                                        <td>{{ $item->numero_serie ?? '--' }}</td>
                                        <td>{{ $item->numero_bon_commande ?? '--' }}</td>
                                        <td>{{ $item->familyGroup ?? '--' }}</td>
                                        <td>{{ $item->model_Materiel ?? '--' }}</td>
                                        <td>{{ $item->status ?? '--' }}</td>
                                        <td>{{ number_format($item->price_unitaire, 0, ',', '.') ?? '--' }} FCFA</td>
                                        <td>{{ $item->num_billOfLading ?? '--' }}</td>
                                        <td>{{ $item->entrepot->nom ?? '--' }}</td>
                                        <td>{{ $item->date_Eta ?? '--' }}</td>
                                        <td>{{ $item->date_reception ?? '--' }}</td>
                                        <td>{{ $item->date_stockage ?? '--' }}</td>
                                        <td>{{ $item->date_outStock ?? '--' }}</td>
                                        <td>{{ $item->poid_tonne ?? '--' }}</td>
                                        <td>{{ $item->hauteur ?? '--' }}</td>
                                        <td>{{ $item->largeur ?? '--' }}</td>
                                        <td>{{ $item->volume ?? '--' }}</td>
                                        <td>{{ $item->longueur ?? '--' }}</td>
                                        {{-- <td><i class='bx bx-dots-horizontal-rounded font-24'></i></td> --}}
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let categorySelect = document.getElementById('category');
            categorySelect.addEventListener('change', function () {
                this.form.submit();
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
            let categorySelect = document.getElementById('brand');
            categorySelect.addEventListener('change', function () {
                this.form.submit();
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
            let categorySelect = document.getElementById('family');
            categorySelect.addEventListener('change', function () {
                this.form.submit();
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            let statusSelect = document.getElementById('status');
            statusSelect.addEventListener('change', function () {
                this.form.submit();
            });
        });

    </script>

</div>
@endsection
