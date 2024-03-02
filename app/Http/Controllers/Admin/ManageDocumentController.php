<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Comment;
use App\Models\Sourcing;
use App\Models\DocAssigned;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DocumentRequis;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ManageDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allAgents = User::where('etat', 'actif')->get();

        $sourcingByBl = Sourcing::where('etat', 'actif')->get();
        $folderAssign = DocAssigned::where('etat', 'actif');

            // dd($folderAssign->count());
        $countUserAssignFolder = DocAssigned::where('etat', 'actif')->distinct('userUuid')->count();

        $docs = DocumentRequis::where('etat', 'actif')->get();

        $totalDossiers = $sourcingByBl->count();

        // Compter le nombre de dossiers avec un agent assigné (userUuid non nul)
        $nombreDossiersAssignes = Sourcing::has('folderAssign')->count();
        $perCentdocAssign = ($nombreDossiersAssignes / $totalDossiers) * 100;

        // Calculer le nombre de dossiers en attente d'assignation
        $nombreDossiersEnAttente = $totalDossiers - $nombreDossiersAssignes;
        $perCentdocNotAssign = ($nombreDossiersEnAttente / $totalDossiers) * 100;

        // commentaire d'un docssier
        $allComments = Comment::where('etat', 'actif')->get();

        
    
        return view('admin.manageFolder.gestionDocument',
        compact('allAgents', 'sourcingByBl', 'docs', 'nombreDossiersAssignes', 'nombreDossiersEnAttente', 'perCentdocAssign','perCentdocNotAssign', 'folderAssign', 'allComments', 'countUserAssignFolder'));
    }

    public function apiFolderByUser($uuid)
    {
        $folderByAgentCount = DocAssigned::where('etat', 'actif')->where('userUuid', $uuid)->groupBy('userUuid')->count();


        $folderByBackupCount = DocAssigned::where('etat', 'actif')->where('backupUuid', $uuid)->groupBy('backupUuid')->count();

        $array = array(
            'count' => $folderByAgentCount,
            'count' => $folderByBackupCount,
        );


        return response()->json($array);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function assign(Request $request, string $id)
    {

        DB::beginTransaction();
        try {
            $userAssigned = Auth::user()->uuid;
            $saving= DocAssigned::create([
                'uuid'=>Str::uuid(),
                'folderUuid' => $request->folderUuid,
                'userUuid' => $request->userUuid,
                'backupUuid' => $request->backupUuid,
                'assignedByUuid' => $userAssigned,
                'etat' => 'actif',
                'code' => Refgenerate(DocAssigned::class, 'DA', 'code'),
            ])->save();

            if ($saving) {

                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"Assigné avec succes!",
                    'code'=>200,
                ];
                DB::commit();
           } else {
                DB::rollback();
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur lors de l'enregistrement!",
                    'code'=>500,
                ];
           }

        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur systeme! $th",
                'code'=>500,
            ];
        }
        return response()->json($dataResponse);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specifieflowchartAgentd resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
        DB::beginTransaction();
        try {

            $saving= DocAssigned::where('uuid', $id)->update([
                'folderUuid' => $request->folderUuid,
                'userUuid' => $request->userUuid,
                'backupUuid' => $request->backupUuid,
            ]);

            if ($saving) {

                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"Enregistré avec succes!",
                    'code'=>200,
                ];
                DB::commit();
           } else {
                DB::rollback();
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur lors de l'enregistrement!",
                    'code'=>500,
                ];
           }

        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur systeme! $th",
                'code'=>500,
            ];
        }
        return response()->json($dataResponse);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function flowchartAgent()
    {
        $agents = DocAssigned::where('etat', 'actif')->distinct('userUuid')->get();
        // ['Feb', 'Mar', 'Apr', 'May']

     // liste des agents ayant au moins un dossier
        foreach ($agents as $agent) {
            $array[]=$agent->user->name;
             //Nombre de dossier assigné par un agent
             $folderAssign[]= countFolderByAgent($agent->user->uuid);
        }
        $datas = [
            'liste'=>json_encode($array),
            'folderAssign'=>json_encode($folderAssign),
        ];
        return $datas;
      
    
       
        
    }
}
