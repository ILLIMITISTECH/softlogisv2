<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Company;
use App\Models\Entrepot;
use App\Models\Sourcing;
use App\Mail\LogisticaMail;
use App\Models\OdLivraison;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\LivraisonFile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class OdLivraisonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transporteurs = Company::where(['type'=>'transporteur', 'etat'=>'actif'])->get();
        $oDLivraisons = OdLivraison::where(['etat'=>'actif'])->get();
        return view('admin.od_livraison.index', compact('transporteurs', 'oDLivraisons'));
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
    // public function store(Request $request)
    // {

    //     DB::beginTransaction();
    //     $user = auth()->user()->name . ' ' . auth()->user()->lastname;
    //     try {
    //         $saving= OdLivraison::create([
    //             'uuid'=>Str::uuid(),
    //             'transporteur_uuid' => $request->transporteur_uuid,
    //             'date_livraison' => $request->date_livraison,
    //             'lieu_livraison' => $request->lieu_livraison,
    //             'note' => $request->note,
    //             'user_uuid' => $user,
    //             'etat' => 'actif',
    //             'code' => Refgenerate(OdLivraison::class, 'ODL', 'code'),
    //         ]);

    //         if($request->has('files')){
    //             foreach($request->file('files') as $key => $file){
    //              $imageName = Str::uuid().'.'.$file->getClientOriginalExtension();

    //              $destinationPath = public_path('documents/files');
    //              $file->move($destinationPath, $imageName);
    //              $filePath = $destinationPath . '/' . $imageName;

    //              $livraison_file = LivraisonFile::create([
    //                 'uuid' => Str::uuid(),
    //                 'name' => $request->input('name')[$key],
    //                 'livraison_id' => $saving->id,
    //                 'files' => $imageName,
    //                 'filePath' => $filePath,
    //              ]);

    //             $livraison_file->filePath = $filePath;
    //             }
    //         }
    //         $saving->save();

    //         if ($saving) {

    //             $dataResponse =[
    //                 'type'=>'success',
    //                 'urlback'=>"back",
    //                 'message'=>"Enregistré avec succes!",
    //                 'code'=>200,
    //             ];
    //             DB::commit();
    //        } else {
    //             DB::rollback();
    //             $dataResponse =[
    //                 'type'=>'error',
    //                 'urlback'=>'',
    //                 'message'=>"Erreur lors de l'enregistrement!",
    //                 'code'=>500,
    //             ];
    //        }

    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         $dataResponse =[
    //             'type'=>'error',
    //             'urlback'=>'',
    //             'message'=>"Erreur systeme! $th",
    //             'code'=>500,
    //         ];
    //     }
    //     return response()->json($dataResponse);
    // }

    public function store(Request $request, $uuid)
    {
        DB::beginTransaction();
        try {
            $sourcingId = $request->input('sourcing_id');
            $sourcing = Sourcing::where(['uuid'=>$sourcingId])->first();

            $user = auth()->user()->name . ' ' . auth()->user()->lastname;

            $saving= OdLivraison::create([
                'uuid'=>Str::uuid(),
                'sourcing_id' => $sourcingId,
                'transporteur_uuid' => $request->transporteur_uuid,
                'date_livraison' => $request->date_livraison,
                'lieu_livraison' => $request->lieu_livraison,
                'note' => $request->note,
                'created_by' => $user,
                'numOt' => $request->numOt,
                'numFolder' => $request->numFolder,
                'numBl' => $request->numBl,
                'trajetStart_uuid' => $request->trajetStart_uuid,
                'trajetEnd_uuid' => $request->trajetEnd_uuid,
                'refCotation' => $request->refCotation,
                'nbrMachine' => $request->nbrMachine,
                'productUuid' => $request->productUuid,
                'etat' => 'actif',
                'code' => Refgenerate(OdLivraison::class, 'ODL', 'code'),
            ]);

            if($saving) {
                Sourcing::where(['uuid' => $request->input('sourcing_id')])->update([
                    "statut" => "odlivraison",
                ]);
            }

            // if ($request->has('product_ids')) {
            //     $saving->products()->attach($request->product_ids);
            // }

            $sourcingProducts = $sourcing->products;

            if($request->has('files')){
                foreach($request->file('files') as $key => $file){
                    $imageName = Str::uuid().'.'.$file->getClientOriginalExtension();

                    $destinationPath = public_path('documents/files');
                    $file->move($destinationPath, $imageName);
                    $filePath = $destinationPath . '/' . $imageName;

                    $livraison_file = LivraisonFile::create([
                    'uuid' => Str::uuid(),
                    'name' => $request->input('name')[$key],
                    'livraison_id' => $saving->id,
                    'files' => $imageName,
                    'filePath' => $filePath,
                    ]);

                $livraison_file->filePath = $filePath;
                }
            }
            $saving->save();


            if ($saving) {

                $transporteurName = Company::where('uuid', $request->transporteur_uuid)->first();

                $mailData = [
                    'title' => 'ORDRE DE TRANSPORT JALO LOGISTIQUE',
                    'body' => 'Bonjour Chers '.$transporteurName->raison_sociale.' Je vous transmet en P.J l\'ensemble des documents relatif  <br><br> En attente de votre retour , je reste disponible au besoin <br><br>
                     <strong>Date de livraison : </strong>'.$request->date_livraison.'
                     <br>',
                ];

                $emailSubject = 'Jalo Logistique - ORDRE DE TRANSPORT';

                // Mail::to($transporteurName->email)->send(new LogisticaMail($mailData,$emailSubject));

                $mail = new LogisticaMail($mailData, $emailSubject);

                // Attache les fichiers au message
                foreach ($saving->files as $file) {
                    $mail->attach($file->filePath);
                }

                Mail::to($transporteurName->email)->send($mail);

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
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $oDLivraison = OdLivraison::where(['uuid'=>$id, 'etat'=>'actif'])->first();

        $transporteurs = Company::where(['type'=>'transporteur', 'etat'=>'actif'])->get();

        $livraison_files = LivraisonFile::where(['livraison_id'=>$oDLivraison->id])->where('etat', 'actif')->get();

        $sourcing_demo = Sourcing::where(['uuid'=>$oDLivraison->sourcing_id])->first();

        $entrepots = Entrepot::where('etat', 'actif')->get();

        // dd($sourcing_demo->products);
        return view('admin.od_livraison.showLivraison',compact('livraison_files','oDLivraison','transporteurs', 'entrepots'));
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

        DB::beginTransaction();
        try {
            $saving= OdLivraison::where(['uuid'=>$id])->update([
                'transporteur_uuid' => $request->transporteur_uuid,
                'date_livraison' => $request->date_livraison,
                'lieu_livraison' => $request->lieu_livraison,
                'note' => $request->note,
            ]);

            if ($saving) {

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

            $saving= OdLivraison::where(['uuid'=>$id])->update(['etat'=>"inactif"]);

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

    public function delette_doc_livraison(string $id)
    {
        DB::beginTransaction();
        try {

            $saving = LivraisonFile::where(['uuid'=>$id])->update(['etat'=>"inactif"]);
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

    public function addLivraisonDoc(Request $request)
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

                    $odretransite_file = LivraisonFile::create([
                        'uuid' => Str::uuid(),
                        'name' => $request->input('name')[$key],
                        'livraison_id' => $request->livraison_id,
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
}
