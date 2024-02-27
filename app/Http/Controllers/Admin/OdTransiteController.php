<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Models\Od_files;
use App\Models\Sourcing;
use App\Models\OdTransite;
use App\Mail\LogisticaMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Sourcing_file;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OdTransiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $odretransites = OdTransite::where(['etat'=> 'actif'])->get();
        $transitaires = Company::where(['etat'=> 'actif', 'type' => 'transitaire'])->get();
        return view('admin.od_transite.index', compact('transitaires','odretransites'));
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
    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        $user = auth()->user()->name . ' ' . auth()->user()->lastname;
        try {

            if($request->has('sourcing_uuid')){
                $sourcing = Sourcing::where('uuid', $request->sourcing_uuid)->update([
                    'statut' => 'odTransit',
                ]);
            }

            $odretransite = OdTransite::create([
                'uuid' => Str::uuid(),
                'note' => $request->note,
                'transitaire_uuid' => $request->transitaire_uuid,
                'sourcing_uuid' => $request->sourcing_uuid,
                'user_uuid' => $user,
                'etat' => 'actif',
                'code' => Refgenerate(OdTransite::class, 'ODT', 'code'),
            ]);

            if($request->has('files')){
                foreach($request->file('files') as $key => $file){
                    $imageName = Str::uuid().'.'.$file->getClientOriginalExtension();
                    $destinationPath = public_path('documents/files');
                    $file->move($destinationPath, $imageName);
                    $filePath = $destinationPath . '/' . $imageName;

                    $odretransite_file = Od_files::create([
                        'uuid' => Str::uuid(),
                        'name' => $request->input('name')[$key],
                        'od_transite_id' => $odretransite->id,
                        'files' => $imageName,
                        'filePath' => $filePath,
                    ]);
                    $odretransite_file->filePath = $filePath;
                }
            }
            $odretransite->save();

            if ($odretransite) {
                $transitaireName = Company::where('uuid', $request->transitaire_uuid)->first();

                $mailData = [
                    'title' => 'ORDRE DE TRANSIT JALO LOGISTIQUE',
                    'body' => 'Bonjour Chers '.$transitaireName->raison_sociale.' Je vous transmet en P.J l\'ensemble des documents relatif  <br><br> En attente de votre retour , je reste disponible au besoin <br><br>
                        <strong>Date de creation : </strong>'.$odretransite->created_at.'<br>',
                ];

                $emailSubject = 'Jalo Logistique - ORDRE DE TRANSIT';

                $mail = new LogisticaMail($mailData, $emailSubject);

                // Attache les fichiers au message
                foreach ($odretransite->files as $file) {
                    $mail->attach($file->filePath);
                }

                Mail::to($transitaireName->email)->send($mail);

                $dataResponse = [
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Enregistré avec succès!",
                    'code' => 200,
                ];

                DB::commit();
            } else {
                DB::rollback();
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur lors de l'enregistrement!",
                    'code' => 500,
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

    public function addTransiteDoc(Request $request)
    {

        // dd($request->all());
        DB::beginTransaction();

        try {

            if($request->has('files')){

                foreach($request->file('files') as $key => $file){
                    $imageName = Str::uuid().'.'.$file->getClientOriginalExtension();
                    $destinationPath = public_path('documents/files');
                    $file->move($destinationPath, $imageName);
                    $filePath = $destinationPath . '/' . $imageName;

                    $odretransite_file = Od_files::create([
                        'uuid' => Str::uuid(),
                        'name' => $request->input('name')[$key],
                        'od_transite_id' => $request->od_transite_id,
                        'files' => $imageName,
                        'filePath' => $filePath,
                    ]);
                    $odretransite_file->filePath = $filePath;
                }

                if ($odretransite_file) {

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
        $odretransite = OdTransite::where(['uuid'=>$id])->firstOrFail();
        $transite_files = Od_files::where(['od_transite_id'=>$odretransite->id])->where('etat', 'actif')->get();
        return view('admin.od_transite.show', compact('odretransite', 'transite_files'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {

            $odretransite = OdTransite::where(['uuid'=>$id])->update([
                'note' => $request->note,
                'transitaire_uuid' => $request->transitaire_uuid,
            ]);

            if ($odretransite) {

                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"modification reussie!",
                    'code'=>200,
                ];
                DB::commit();

           } else {
                DB::rollback();
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur lors de la modification!",
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
    public function destroy(string $id)
    {

        DB::beginTransaction();
        try {

            $saving= OdTransite::where(['uuid'=>$id])->update(['etat'=>"inactif"]);

            if ($saving) {

                $dataResponse =[
                    'type'=>'success',
                    'urlback'=> route('admin.od_transite.index'),
                    'message'=>"Supprimé avec succes!",
                    'code'=>200,
                ];
                DB::commit();
            } else {
                DB::rollback();
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur lors de la suppression!",
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

    // delette document for od_transite
    public function delette_doc_transite(string $id)
    {
        DB::beginTransaction();
        try {

            $saving = Od_files::where(['uuid'=>$id])->update(['etat'=>"inactif"]);
            if ($saving) {
                $dataResponse =[
                    'type'=>'success',
                    'urlback'=> 'back',
                    'message'=>"Supprimé avec succes!",
                    'code'=>200,
                ];
                DB::commit();
            } else {
                DB::rollback();
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur lors de la suppression!",
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
    public function receive_doc_transite(request $request)
    {
        DB::beginTransaction();
        try {
            $saving = OdTransite::where(['uuid'=> $request->transite_uuid])->update(
                [
                    'receive_doc'=> $request->receive_doc,
                    'receive_date'=> now(),
                ]);
            if ($saving) {
                $dataResponse =[
                    'type'=>'success',
                    'urlback'=> 'back',
                    'message'=>"Supprimé avec succes!",
                    'code'=>200,
                ];
                DB::commit();
            } else {
                DB::rollback();
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur lors de la suppression!",
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
}
