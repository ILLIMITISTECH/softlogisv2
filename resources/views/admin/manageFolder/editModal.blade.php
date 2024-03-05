<div class="modal fade" id="editModal{{ $item->uuid }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.manage_folder.update', $item->uuid) }}" method="post" class="submitForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Modifié l'agent</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">

                        <input type="hidden" name="folderUuid" value="{{ $item->uuid }}">

                        <div class="input-group">
                            <div class="input-group-text text-light bg-success pe-3">Agent <span class="text-danger">*</span></div>
                            <select class="form-select" id="prepend-text-single-mainagent" data-placeholder="Choisir un agent" name="userUuid">
                                @if ($item->folderAssign)
                                    <option value="{{ $item->folderAssign->user->uuid }}">
                                        @if($item->folderAssign->user)
                                            {{$item->folderAssign->user->name.' '.$item->folderAssign->user->lastname}}
                                        @else
                                            Non Assigné
                                        @endif
                                    </option>
                                @endif

                                @foreach ($allAgents as $agent)
                                    @if (!empty($agent))
                                        <option value="{{ $agent->uuid }}">{{ $agent->name.' '. $agent->lastname }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group my-3">
                            <div class="input-group-text text-light bg-primary">Backup</div>
                            <select class="form-select" id="prepend-text-single-backup" data-placeholder="Choisir un agent" name="backupUuid">
                                @if (!empty($item->folderAssign->backup))
                                    <option value="{{ $item->folderAssign->backup->uuid }}">
                                        @if($item->folderAssign->backup)
                                            {{$item->folderAssign->backup->name.' '.$item->folderAssign->backup->lastname}}
                                        @else
                                            Non Assigné
                                        @endif
                                    </option>
                                @endif
                                @foreach ($allAgents as $agent)
                                    @if (!empty($agent))
                                        <option value="{{ $agent->uuid }}">{{ $agent->name.' '. $agent->lastname }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Modifier <i class="bx bx-arrow-from-left"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>