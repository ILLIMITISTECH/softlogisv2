@extends('admin.layouts.admin')
@section('section')

<div class="page-content" id="ArticleIndex">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Articles</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="/admin/home"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Liste</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">PARAMETRES</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                    <a href="{{ route('import.index') }}" class="dropdown-item font-size_12"><i class="bx bxs-file-export"></i>Importer</a>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">

                        <div class="position-relative col-sm-12 col-md-4 col-lg-6 col-xl-5 search-bar d-md-block d-none">
                            <input class="form-control px-5" type="search" id="Articlesearch" placeholder="Recherche">
                            <span class="position-absolute top-50 search-show ms-3 translate-middle-y start-0 top-50 fs-5"><i class='bx bx-search'></i></span>
                        </div>

                        <div class="col-sm-12 col-md-5 col-lg-4 col-xl-5">
                            <form class="float-lg-start">
                                <div class="row row-cols-lg-2 row-cols-xl-auto g-2">
                                    <div class="col">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-white">Filtrer par Designation</button>
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button"
                                                        class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class='bx bxs-category'></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="btnGroupDrop1" style="min-width: 300px">
                                                    <li class="d-flex justify-content-center col-12 text-center mx-0 px-0">
                                                        <form action="{{ route('admin.article.index') }}" method="GET" class="form-inlne mx-0 px-0 ">
                                                            @csrf
                                                            <div class="form-group mx-0 px-2 w-100">
                                                                <select name="famille_id" id="famille_id" class="form-control mr-2">
                                                                    <option value="all">Toutes les Designation</option>
                                                                    @foreach($articleFamilys as $articleFamily)
                                                                        <option value="{{ $articleFamily->uuid }}">{{ Str::limit($articleFamily->libelle, 25, '...') }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary mb-2 mx-1">Filtrer</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                    {{-- <div class="col">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-white">Filtré par Model</button>
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button"
                                                    class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class='bx bx-slider'></i>
                                                </button>

                                                <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="btnGroupDrop1" style="min-width: 300px">
                                                    <li class="d-flex justify-content-between col-12 text-start mx-0 px-0">
                                                        <form action="{{ route('admin.article.index') }}" method="GET" class="form-inlne mx-0 px-0 w-100 row d-flex">
                                                            @csrf
                                                            <div class="form-group mx-0 px-2 col-7">
                                                                <select name="model_id" id="model_id" class="form-control mr-2">
                                                                    <option value="all">Tout les models</option>
                                                                    @foreach($articleModels as $articleModel)
                                                                        <option value="{{ $articleModel->uuid }}">{{ Str::limit($articleModel->libelle, 25, '...') }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary mb-2 mx-1 col-4">Filtrer</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </form>
                        </div>

                        <div class="col-sm-12 col-md-3 col-lg-2 col-xl-2 justify-content-end text-end float-lg-end">
                            <!-- Button trigger modal -->
                            @can('Create Articles')
                            <button type="button" class="btn btn-primary mb-3 mb-lg-0" data-bs-toggle="modal"
                                data-bs-target="#addnewproduct">
                                <i class='bx bxs-plus-square'></i>Nouveau Produit</button>
                            @endcan
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 product-grid mx-auto" id="articleList">
        @forelse ($articles as $article)
        <div class="col content-product d-flex gx-3">
            <a href="{{ route('admin.article.show', $article->uuid) }}" class="text-decoration-none">
                <div class="card">
                    <img src="{{ asset('files/' . $article->image) }}" class="card-img-top w-100 cover img-fluid" alt="article image" style="max-height: 200px; min-height: 200px; min-width: 280px">
                    <div class="position-absolute bg-info badge p-2 d-flex mt-1 end-0 text-uppercase">{{ $article->numero_serie }}</div>
                    <div class="card-body mt-2">
                        <h6 class="card-title cursor-pointer text-uppercase" style="min-height: 50px !important; max-width: 200px;">
                            @if ($article->familly)
                                {{ Str::limit($article->familly->libelle, 25, '...') }}
                            @else
                                N/A

                            @endif
                        </h6>

                        <div class="row pb-0 mb-0">
                            <p class="text-muted col-6 mb-0" style="font-size: 11px">Model de vente</p>
                            <p class="text-muted col-6 mb-0" style="font-size: 11px">Marque</p>
                        </div>
                        <div class="row py-0">
                            {{-- <p class="mb-0 col-6 text-uppercase fw-bold" style="font-size: 12px">{{ $article->model->libelle ?? "" }}</p> --}}
                            <p class="mb-0 col-6 text-uppercase fw-bold" style="font-size: 12px">
                                {{ $article->model_Materiel ?? "--" }}
                            </p>
                            <p class="mb-0 fw-bold col-6 text-uppercase" style="font-size: 12px">{{ $article->marque->libelle ?? "" }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        @empty
        <div class="container h-75 px-auto py-auto d-flex justify-content-between align-item-center align-self-center" style="min-height: 60vh">
            <div class="text-uppercase text-center text-primary my-auto mx-auto" style="font-size: 40px;">aucune marchandise sur la ligne de production</div>
        </div>
        @endforelse
    </div>

    {{-- modal ajout de produit --}}


    <div class="col">
        <!-- Modal -->
        <div class="modal fade " id="addnewproduct" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl" style="margin-top:0; margin-right: 0">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter nouveaux produits</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body p-4">

                                <div class="form-body mt-4">
                                    <form method="post" action="{{ route('admin.article.store') }}" class="submitForm"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="border border-3 p-4 rounded">

                                                    <div class="col-sm-12 col-md-12 mb-3">
                                                        <label for="famille_uuid" class="form-label">Designation de l' article</label>
                                                        <select name="famille_uuid" class="form-select"
                                                            id="famille_uuid" autocomplete="off">
                                                            @foreach ($articleFamilys as $articleFamily)
                                                            <option value="{{ $articleFamily->uuid }}">
                                                                {{ $articleFamily->libelle }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    {{-- <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                                        <label for="model_uuid" class="form-label">Model d'article</label>
                                                        <select name="model_uuid" class="form-select"
                                                            id="model_uuid" autocomplete="off">
                                                            @foreach ($articleModels as $articleModel)
                                                            <option value="{{ $articleModel->uuid }}">
                                                                {{ $articleModel->libelle }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div> --}}

                                                    <div class="row col-12 d-flex wrap mx-auto">
                                                        <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                                                            <label for="model_uuid" class="form-label">Model d'article</label>
                                                            <input type="text" class="form-control" id="model_Materiel" name="model_Materiel" autocomplete="off">
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                                                            <label for="num_billOfLading" class="form-label">N° Bill Of Lading</label>
                                                            <input type="text" class="form-control" id="num_billOfLading" name="num_billOfLading" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="row col-12 d-flex wrap mx-auto px-0">

                                                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-6">
                                                            <label id="numero_serie" class="form-label">N* de serie</label>
                                                            <input class="form-control" type="text" name="numero_serie"
                                                                id="numero_serie" placeholder="00XX0000" autocomplete="off" />
                                                        </div>

                                                        <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                                                            <label for="inputProductTitle" class="form-label">N* de bon de commande</label>
                                                            <input type="text" class="form-control" id="inputProductTitle"
                                                                placeholder="Numéro de bomn de commande" name="numero_bon_commande"
                                                                autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="row col-12 d-flex wrap mx-auto px-0 mt-2">

                                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                                            <label for="familyGroup" class="form-label">Family Group</label>
                                                            <select class="form-select" name="familyGroup" id="familyGroup">
                                                                <option value="JALO">JALO</option>
                                                                <option value="NEEMBA CI">NEEMBA CI</option>
                                                                <option value="NEEMBA INTERNATIONAL">NEEMBA INTERNATIONAL</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                                            <label for="source_uuid" class="form-label">Ship
                                                                Source</label>
                                                            <select name="source_uuid" class="form-select"
                                                                id="source_uuid" autocomplete="off">
                                                                @foreach ($sources as $source)
                                                                <option value="{{ $source->uuid }}">
                                                                    {{ $source->libelle }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="product_description"
                                                            class="form-label">Description</label>
                                                        <textarea class="form-control" rows="3" name="description"
                                                            autocomplete="off" id="product_description"></textarea>
                                                    </div>

                                                    <div class="file-upload">
                                                        <button class="file-upload-btn" type="button"
                                                            onclick="$('.file-upload-input').trigger( 'click' )">Ajouter
                                                            Image du produit</button>

                                                        <div class="image-upload-wrap">
                                                            <input class="file-upload-input" type='file'
                                                                onchange="readURL(this);" accept="image/*"
                                                                name="image" />
                                                            <div class="drag-text">
                                                                <h4>Faites glisser et déposez un fichier ou sélectionnez
                                                                    Ajouter une image</h4>
                                                            </div>
                                                        </div>
                                                        <div class="file-upload-content">
                                                            <img class="file-upload-image" src="#" alt="your image" />
                                                            <div class="image-title-wrap">
                                                                <button type="button" onclick="removeUpload()"
                                                                    class="remove-image">Remove <span
                                                                        class="image-title">Uploaded
                                                                        Image</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="border border-3 p-4 rounded">
                                                    <div class="row g-3 col-12">

                                                        <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                                                            <label id="hauteur" class="form-label">Hauteur(m)</label>
                                                            <input class="form-control" type="number" name="hauteur"
                                                                id="hauteur" placeholder="00.00" autocomplete="off" />
                                                        </div>
                                                        <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                                                            <label id="poid_tonne"
                                                                class="form-label">Poids/Tonnes</label>
                                                            <input class="form-control" type="number" name="poid_tonne"
                                                                id="poid_tonne" placeholder="00.00"
                                                                autocomplete="off" />
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6">
                                                            <label id="volume" class="form-label">Volume(m3)</label>
                                                            <input class="form-control" type="number" name="volume"
                                                                id="volume" placeholder="00.00" autocomplete="off" />
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6">
                                                            <label for="longueur" class="form-label">Longueur(m)</label>
                                                            <input type="number" class="form-control" id="longueur"
                                                                placeholder="00.00" name="longueur" autocomplete="off">
                                                        </div>
                                                        <div class="col-sm-12 col-md-12">
                                                            <label for="largeur" class="form-label">Largeur</label>
                                                            <input type="number" class="form-control" id="largeur"
                                                                placeholder="00.00" name="largeur" autocomplete="off">
                                                        </div>

                                                        <div class="col-sm-12 col-md-12">
                                                            <label for="price_unitaire" class="form-label">Prix (FCFA)</label>
                                                            <input type="number" class="form-control" id="price_unitaire"
                                                                placeholder="00.00" name="price_unitaire" autocomplete="off">
                                                        </div>
                                                        <div class="col-sm-12 col-md-12">
                                                            <label for="price_dollars" class="form-label">Prix (Dollars)</label>
                                                            <input type="number" class="form-control" id="price_dollars"
                                                                placeholder="00.00" name="price_dollars" autocomplete="off">
                                                        </div>
                                                        <div class="col-sm-12 col-md-12">
                                                            <label for="price_euro" class="form-label">Prix (Euro)</label>
                                                            <input type="number" class="form-control" id="price_euro"
                                                                placeholder="00.00" name="price_euro" autocomplete="off">
                                                        </div>


                                                        <div class="col-12">
                                                            <label for="inputProductMarque"
                                                                class="form-label">Marque</label>
                                                            <select class="form-select" id="inputProductMarque"
                                                                name="marque_uuid" autocomplete="off">
                                                                @foreach ($marques as $marque)
                                                                <option value="{{ $marque->uuid }}">
                                                                    {{ $marque->libelle }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-12">
                                                            <label for="inputCategory"
                                                                class="form-label">Categorie</label>
                                                            <select class="form-select" id="inputCategory"
                                                                name="categorie_uuid" autocomplete="off">
                                                                @foreach ($categories as $categorie)
                                                                <option value="{{ $categorie->uuid }}">
                                                                    {{ $categorie->libelle }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <input type="hidden" name="status" id="status" value="enFabrication">
                                                        <div class="col-12">
                                                            <div class="d-grid">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Sauvegarder</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 product-grid mx-auto" id="articleList">
        <!-- La liste des articles sera affichée ici -->
    </div>

<script>
    const searchInput = document.getElementById('Articlesearch');
    const articleListContainer = document.getElementById('articleList');
    const addedArticles = [];


    searchInput.addEventListener('input', function () {
    const searchQuery = searchInput.value.trim();
        fetch(`/articles/search?searchQuery=${searchQuery}`)
            .then(response => response.json())
            .then(data => {
                const articles = data.articles;
                updateArticleList(articles);
            })
            .catch(error => console.error('Error performing search:', error));
        });

    function updateArticleList(articles) {
        // Effacez le contenu actuel de la liste des articles
        articleListContainer.innerHTML = '';
        addedArticles.length = 0; // Réinitialiser le tableau des UUID ajoutés

        // Ajoutez les nouveaux articles à la liste
        articles.forEach(article => {
            // Vérifiez si l'article a déjà été ajouté
            if (!addedArticles.includes(article.uuid)) {
                const articleHtml = `
                    <div class="col content-product d-flex gx-3">
                        <a href="{{ route('admin.article.show', '') }}/${article.uuid}" class="text-decoration-none">
                            <div class="card">
                                <img src="{{ asset('files/') }}/${article.image}" class="card-img-top w-100 cover img-fluid" alt="article image" style="max-height: 200px; min-height: 200px; min-width: 280px">
                                <div class="position-absolute bg-info badge p-2 d-flex mt-1 end-0 text-uppercase">${article.numero_serie}</div>
                                <div class="card-body mt-2">
                                    <h6 class="card-title cursor-pointer text-uppercase" style="min-height: 50px !important; max-width: 200px;">
                                        ${article.familly ? article.familly.libelle : 'N/A'}
                                    </h6>

                                    <div class="row pb-0 mb-0">
                                        <p class="text-muted col-6 mb-0" style="font-size: 11px">Model de vente</p>
                                        <p class="text-muted col-6 mb-0" style="font-size: 11px">Marque</p>
                                    </div>
                                    <div class="row py-0">
                                        <p class="mb-0 col-6 text-uppercase fw-bold" style="font-size: 12px">${article.model ? article.model.libelle : ''}</p>
                                        <p class="mb-0 fw-bold col-6 text-uppercase" style="font-size: 12px">${article.marque ? article.marque.libelle : ''}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                `;

                // Ajoutez l'article à la liste
                articleListContainer.insertAdjacentHTML('beforeend', articleHtml);

                // Ajoutez l'UUID de l'article au tableau des articles ajoutés
                addedArticles.push(article.uuid);
            }
        });
    }
</script>

</div>


@endsection
