@extends('admin.layouts.admin')
@section('section')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Configuration</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Destination</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4 gap-3">
               
              <div class="ms-auto">
                <button type="button" class="btn btn-primary radius-30 mt-2 mt-lg-0" data-bs-toggle="modal" data-bs-target="#addDestinationModal"><i class="bx bxs-plus-square"></i>Nouvelle Destination</button>
              </div>

               <!-- Button trigger modal -->

            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Code</th>
                            <th>Libelle</th>
                            <th>Arrets</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($destinations as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="ms-2">
                                        <h6 class="mb-0 font-14">#{{ $item->code ?? '--'}}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->libelle ?? '--'}}</td>
                            <td class="">
                                <div class="row">
                                    @foreach ($item->arrets as $arretByDestination)
                                        <span class="badge bg-primary rounded-pill col-sm-3 me-1 mb-1">{{ $arretByDestination->libelle ?? '--'}}</span> 
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                {{ $item->description ?? '--'}}
                            </td>
                            <td>
                                <div class="d-flex order-actions">
                                    <a data-bs-toggle="modal" data-bs-target="#editDestinationModal{{ $item->uuid }}"  class="" style="cursor: pointer"><i class='bx bxs-edit'></i></a>

                                    {{-- <a href="javascript:;" class="ms-3"><i class='bx bxs-trash'></i></a> --}}

                                    <a class="ms-3 deleteConfirmation" data-uuid="{{$item->uuid}}"
                                        data-type="confirmation_redirect" data-placement="top"
                                        data-token="{{ csrf_token() }}"
                                        data-url="{{route('admin.destination.destroy',$item->uuid)}}"
                                        data-title="Vous êtes sur le point de supprimer {{$item->libelle}} "
                                        data-id="{{$item->uuid}}" data-param="0"
                                        data-route="{{route('admin.destination.destroy',$item->uuid)}}"><i
                                            class='bx bxs-trash' style="cursor: pointer"></i></a>
                                </div>
                            </td>
                        </tr>

                        {{-- Modal edit destination --}}
                        <!-- Modal -->
                        <div class="modal fade" id="editDestinationModal{{ $item->uuid }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modifier Destination</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.destination.update', $item->uuid) }}" method="post" class="submitForm">
                                        <div class="modal-body my-4">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col">
                                                    <label for="">Libelle</label>
                                                    <input class="form-control" type="text" name="libelle" value="{{ $item->libelle ?? '--'}}">
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <label for="arret_ids" class="form-label">
                                                    Associer Arrêts à cette destination</label>
                                                <select name="arret_ids[]" class="form-select" id="multiple-select-field" data-placeholder="Choisir Arrêts" multiple>
                                                    @foreach ($arrets as $arret)
                                                        @php
                                                            $selected = $item->arrets->contains($arret->id) ? 'selected' : '';
                                                        @endphp
                                                        <option value="{{ $arret->id }}" {{ $selected }}>{{ $arret->libelle ?? '--' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="form-group mt-3">
                                                <label for="description">Description <span class="text-muted">(facultatif)</span></label>
                                                <textarea class="form-control" name="description"  cols="30" rows="2" value="{{ $item->description }}">{{ $item->description ?? '--'}}</textarea>
                                            </div>
                                            <hr>

                                            <div class="modal-footer mt-2">
                                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-outline-info">Modifier</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        @empty

                            <center><span>Aucune destination</span></center>

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- Modal add new destination --}}

    <!-- Modal -->
    <div class="modal fade" id="addDestinationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouvelle Destination</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.destination.store') }}" method="post" class="submitForm">
                    <div class="modal-body my-4">
                        @csrf
                        <div class="">
                            <div class="form-group col-12">
                                <label for="">Libelle <span><span class="text-danger">*</span></span></label>
                                <input class="form-control" type="text" name="libelle" autocomplete="off" required>
                                @error('libelle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="arret_uuid" class="form-label">Associer Arrêts à cette destination</label>
                            <select name="arret_ids[]" class="form-select" id="multiple-select-field" data-placeholder="Choisir Arrêts" multiple>
                                @foreach ($arrets as $arret)
                                    <option value="{{ $arret->id }}">{{ $arret->libelle ?? '--'}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="description">Description <span class="text-muted">(facultatif)</span></label>
                            <textarea class="form-control" name="description" id="" cols="30" rows="2" autocomplete="off"></textarea>
                        </div>
                        <hr>

                        <div class="modal-footer mt-2">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-success">Ajouter</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>



</div>

@endsection
